<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Weatherstatistics Controller
 *
 * @property \App\Model\Table\WeatherstatisticsTable $Weatherstatistics
 */
class WeatherstatisticsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'WeatherEvents']
        ];
        $weatherstatistics = $this->paginate($this->Weatherstatistics);

        $this->set(compact('weatherstatistics'));
        $this->set('_serialize', ['weatherstatistics']);
    }

    /**
     * View method
     *
     * @param string|null $id Weatherstatistic id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $weatherstatistic = $this->Weatherstatistics->get($id, [
            'contain' => ['Users', 'WeatherEvents']
        ]);

        $this->set('weatherstatistic', $weatherstatistic);
        $this->set('_serialize', ['weatherstatistic']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $weatherstatistic = $this->Weatherstatistics->newEntity();
        if ($this->request->is('post')) {
            $weatherstatistic = $this->Weatherstatistics->patchEntity($weatherstatistic, $this->request->data);
            if ($this->Weatherstatistics->save($weatherstatistic)) {
                $this->Flash->success(__('The weatherstatistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The weatherstatistic could not be saved. Please, try again.'));
            }
        }
        $users = $this->Weatherstatistics->Users->find('list', ['limit' => 200]);
        $weatherEvents = $this->Weatherstatistics->WeatherEvents->find('list', ['limit' => 200]);
        $this->set(compact('weatherstatistic', 'users', 'weatherEvents'));
        $this->set('_serialize', ['weatherstatistic']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Weatherstatistic id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $weatherstatistic = $this->Weatherstatistics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $weatherstatistic = $this->Weatherstatistics->patchEntity($weatherstatistic, $this->request->data);
            if ($this->Weatherstatistics->save($weatherstatistic)) {
                $this->Flash->success(__('The weatherstatistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The weatherstatistic could not be saved. Please, try again.'));
            }
        }
        $users = $this->Weatherstatistics->Users->find('list', ['limit' => 200]);
        $weatherEvents = $this->Weatherstatistics->WeatherEvents->find('list', ['limit' => 200]);
        $this->set(compact('weatherstatistic', 'users', 'weatherEvents'));
        $this->set('_serialize', ['weatherstatistic']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Weatherstatistic id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $weatherstatistic = $this->Weatherstatistics->get($id);
        if ($this->Weatherstatistics->delete($weatherstatistic)) {
            $this->Flash->success(__('The weatherstatistic has been deleted.'));
        } else {
            $this->Flash->error(__('The weatherstatistic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function scores($scores) {
        $rank = 0;
        foreach($scores as $score) {
            $rank++;
            $user = $score['user'];
            $weatherStats = $score['weather_statistics'];
            if (isset($score['scores'])) {
                $score = $score['scores'][0];
            }
            $entry = ['rank' => $rank, 'first_name' => $user['first_name'], 'last_name' => $user['last_name'], 'score' => $score['total_score']];
            $totalAttempts = 0;
            $totalValid = 0;
            foreach ($weatherStats as $stat) {
                $attempts = $stat['attempts'];
                $valid = $stat['valid_attempts'];
                $totalAttempts += $attempts;
                $totalValid += $valid;
                $percent = $valid / $attempts * 100;
                $entry[$stat['weather_event']['weather']] = (float) $percent;
            }
            $percent = $totalValid / $totalAttempts;
            $entry['total'] = $percent;
            $data[] = $entry;
        }
        if ($rank === 0) {
            $result = 0;
            return [$result];
        } else {
            $result = 1;
            return [$result, $data];
        }
    }
    
    public function stats() {
        $session = $this->request->session();
        $userID = $session->read('Auth.User.id');
        $teamsUsers = TableRegistry::get('TeamsUsers');
        $teamUser = $teamsUsers->find()->where(['TeamsUsers.user_id' => $userID])->contain('Teams'); //look for user's team
        $teamUserArray = $teamUser->toArray();
        $scoreboard = TableRegistry::get('Scores');
        $scores = $scoreboard->find('all')->order(['Scores.total_score' => 'DESC'])->limit(20)->contain(['WeatherStatistics' => ['WeatherEvents']]);
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $exp = intval($data['experience']);
            $players = intval($data['players']);
            if (!$players) {
                $scores = $teamsUsers->find()->where(['team_id' => $teamUserArray[0]['team_id']])->contain([
                    'Scores' => function($u) {
                        return $u->order(['Scores.total_score' => 'DESC']);
                    }
                ])->limit(20)->contain(['WeatherStatistics' => ['WeatherEvents']]);
            }
            $scores = $scores->contain([
                'Users' => function($q) use($exp) {
                    switch($exp) {
                        case 3: //amateur:deselected meteorologist:deselected
                            $q = $q->where(['Users.meteorologist' => null]);
                            break;
                        case 2: //amateur:selected meteorologist:selected
                            break;
                        case 1: //amateur:unselected meteorologist:selected
                            $q = $q->where(['Users.meteorologist' => 1]);
                            break;
                        case 0: //amateur:selected meteorologist:unselected
                            $q = $q->where(['Users.meteorologist' => 0]);
                            break;
                    }
                    return $q;
                }
            ]);
            $results = $this->scores($scores);
            $result = $results[0];
            if ($result) {
                $board = $results[1];  
            } else {
                $board = [0];
            }
            echo json_encode(['result' => $result, 'leaderboard' => $board]);
            die;
        } else {
            if ($teamUserArray) { //check if team was found
                $this->set('teamResult', 1); //user has team
                $this->set('teamUser', $teamUserArray[0]); //save user's team info for view
            } else {
                $this->set('teamResult', 0); //user does not have team
            }
            $users = TableRegistry::get('Users'); //get info about logged user
            if ($currentUser = $users->find()->where(['id' => $userID])->toArray()) { //if logged in user
                $this->set('user', $currentUser[0]); //save user info for view
            };
            $scores = $scores->contain(['Users']); //get top 20 scores with default filters
            $results = $this->scores($scores); //save results of scores function which grabs the data from each found row
            $result = $results[0]; //were any rows found
            $this->set('result', $result); //tell the view
            if ($result) { //if yes
                $board = $results[1]; //grab the result data
                $this->set('leaderboard', $board); //share with view
            }
        }   
    }      
    
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow();

    }
}
