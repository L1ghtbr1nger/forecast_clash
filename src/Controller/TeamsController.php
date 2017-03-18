<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;

/**
 * Teams Controller
 *
 * @property \App\Model\Table\TeamsTable $Teams
 */
class TeamsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $teams = $this->paginate($this->Teams);

        $this->set(compact('teams'));
        $this->set('_serialize', ['teams']);
    }

    /**
     * View method
     *
     * @param string|null $id Team id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $team = $this->Teams->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('team', $team);
        $this->set('_serialize', ['team']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $team = $this->Teams->newEntity();
        if ($this->request->is('post')) {
            $team = $this->Teams->patchEntity($team, $this->request->data);
            if ($this->Teams->save($team)) {
                $this->Flash->success(__('The team has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The team could not be saved. Please, try again.'));
            }
        }
        $users = $this->Teams->Users->find('list', ['limit' => 200]);
        $this->set(compact('team', 'users'));
        $this->set('_serialize', ['team']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Team id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $team = $this->Teams->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $team = $this->Teams->patchEntity($team, $this->request->data);
            if ($this->Teams->save($team)) {
                $this->Flash->success(__('The team has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The team could not be saved. Please, try again.'));
            }
        }
        $users = $this->Teams->Users->find('list', ['limit' => 200]);
        $this->set(compact('team', 'users'));
        $this->set('_serialize', ['team']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Team id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $team = $this->Teams->get($id);
        if ($this->Teams->delete($team)) {
            $this->Flash->success(__('The team has been deleted.'));
        } else {
            $this->Flash->error(__('The team could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function dugout() { //view creator for the team index page dugout
        $session = $this->request->session();
        $user = $session->read('Auth.User.id');
        $teamsUsers = TableRegistry::get('TeamsUsers');
        $teamUser = $teamsUsers->find('all')->where(['TeamsUsers.user_id' => $user])->contain(['Teams', 'Users']);
        $teamRankings = TableRegistry::get('Scores')->find('all')->contain(['TeamsUsers' => ['Teams']])->order('Teams.id');
        if($teamRanking = $teamRankings->toArray()) {
            $teamScore = [];
            $tempID = 0;
            foreach ($teamRanking as $teamRank) {
                $team_id = $teamRank['teams_user']['team_id'];
                $team_name = $teamRank['teams_user']['team']['team_name'];
                $score = $teamRank['total_score'];
                if ($team_id === $tempID) {
                    $teamScore[$team_id]['team_score'] += $score;
                } else {
                    $tempID = $team_id;
                    $teamScore[$team_id] = ['team_id' => $team_id, 'team_name' => $team_name, 'team_score' => $score];
                }
            }
            $collection = new Collection($teamScore);
            $rankedScores = $collection->sortBy('team_score')->toArray();
            $rank = 0;
            $count = 0;
            $tempScore = -1;
            foreach ($rankedScores as $rs) {
                $rank++;
                if ($rs['team_score'] === $tempScore) {
                    $rank--;
                    $count++;
                } else {
                    $rank += $count;
                    $count = 0;
                    $tempScore = $rs['team_score'];
                }
                $rs['rank'] = $rank;
                $rankScore[] = $rs;
            }
            $this->set('rankResult', true);
            $this->set('rankings', $rankScore);
        } else {
            $this->set('rankResult', false);
        }
        if ($teamUser = $teamUser->toArray()) {
            $teamID = $teamUser[0]['team_id'];
            $teammates = $teamsUsers->find('all')->where(['team_id' => $teamID])->contain(['Users', 'Scores'])->order('Users.first_name')->toArray();
            $this->set('teammates', $teammates);
            $total = 0;
            foreach ($teammates as $teammate) {
                $total += $teammate['score']['total_score'];
            }
            $this->set('total', $total);
            if ($user === $teamUser[0]['team']['user_id']) {
                $this->set('captain', true);
            } else {
                $this->set('captain', false);
            }
            $this->set('hasTeam', true);
            $this->set('data', $teamUser[0]);
        } else {
            $this->set('hasTeam', false);
        }
    }
    
    public function typer() { //predictive list from search box
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $teams = $this->Teams->find()->where(['team_name LIKE' => $data['letters'].'%'])->limit(10)->order('team_name');
            if ($team = $teams->toArray()) {
                foreach ($team as $t) {
                   $t['team_name'] = h($t['team_name']); 
                }
                echo json_encode(['result' => 1, 'team_data' => $team]);
                die;
            } else {
                echo json_encode(['result' => 0]);
                die;
            }
        }
    }
    
    public function creator() { //function to save new row to Teams
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $session = $this->request->session();
            $user = $session->read('Auth.User.id');
            $team = $this->Teams->newEntity();
            $team->team_name = $data['team_name'];
            $team->privacy = $data['privacy'];
            $team->user_id = $user;
            //check for valid file, move file to server, save file name with extension to DB
            if (!empty($data['team_logo'])) {
                $file = $data['team_logo']; //put the data into a var for easy use
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions
                $setNewFileName = time() . "_" . rand(000000, 999999);
                if (in_array($ext, $arr_ext)) { //only process if the extension is valid
                    //do the actual uploading of the file. First arg is the tmp name, second arg is where we are putting it
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . '/img/teams/users/' . $setNewFileName . '.' . $ext);
                    $imageFileName = $setNewFileName . '.' . $ext; //prepare the filename for database entry
                }
            }
            $team->team_logo = $imageFileName;
            if ($teamID = $this->Teams->save($team)) { //if new team saved successfully, assign creating user to the team in TeamsUsers
                $teamUsers = TableRegistry::get('TeamsUsers');
                $teamUser = $teamUsers->newEntity();
                $teamUser->user_id = $user;
                $teamUser->team_id = $teamID->id;
                if ($teamUsers->save($teamUser)) {
                    echo json_encode(['result' => 1, 'msg' => 'Team created!']);
                    die;
                } else {
                    echo json_encode(['result' => 0, 'msg' => 'No save TeamUser...']);
                    die;
                }
            } else {
                echo json_encode(['result' => 0, 'msg' => 'No save Team...']);
                die;
            }
        }
    }
    
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow();

    }
}
