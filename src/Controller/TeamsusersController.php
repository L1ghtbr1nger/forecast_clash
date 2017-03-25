<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Utility\Text;
use Cake\Utility\Security;
use Cake\Routing\Router;

/**
 * TeamsUsers Controller
 *
 * @property \App\Model\Table\TeamsUsersTable $TeamsUsers
 */
class TeamsUsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Teams']
        ];
        $teamsUsers = $this->paginate($this->TeamsUsers);

        $this->set(compact('teamsUsers'));
        $this->set('_serialize', ['teamsUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Teams User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $teamsUser = $this->TeamsUsers->get($id, [
            'contain' => ['Users', 'Teams']
        ]);

        $this->set('teamsUser', $teamsUser);
        $this->set('_serialize', ['teamsUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $teamsUser = $this->TeamsUsers->newEntity();
        if ($this->request->is('post')) {
            $teamsUser = $this->TeamsUsers->patchEntity($teamsUser, $this->request->data);
            if ($this->TeamsUsers->save($teamsUser)) {
                $this->Flash->success(__('The teams user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The teams user could not be saved. Please, try again.'));
            }
        }
        $users = $this->TeamsUsers->Users->find('list', ['limit' => 200]);
        $teams = $this->TeamsUsers->Teams->find('list', ['limit' => 200]);
        $this->set(compact('teamsUser', 'users', 'teams'));
        $this->set('_serialize', ['teamsUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Teams User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $teamsUser = $this->TeamsUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $teamsUser = $this->TeamsUsers->patchEntity($teamsUser, $this->request->data);
            if ($this->TeamsUsers->save($teamsUser)) {
                $this->Flash->success(__('The teams user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The teams user could not be saved. Please, try again.'));
            }
        }
        $users = $this->TeamsUsers->Users->find('list', ['limit' => 200]);
        $teams = $this->TeamsUsers->Teams->find('list', ['limit' => 200]);
        $this->set(compact('teamsUser', 'users', 'teams'));
        $this->set('_serialize', ['teamsUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Teams User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $teamsUser = $this->TeamsUsers->get($id);
        if ($this->TeamsUsers->delete($teamsUser)) {
            $this->Flash->success(__('The teams user has been deleted.'));
        } else {
            $this->Flash->error(__('The teams user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function joining($session, $team, $user, $addressC, $firstC, $captain) {
        if ($team['privacy'] && !$captain) { //if selected team is private and user not invited by captain, send email to team captain with link to accept or reject request
            $link = Router::url(['controller' => 'TeamsUsers', 'action' => 'freeAgent'], TRUE).'/'.$team['id'].'_'.h($team['team_name']).'_'.$user['id'].'_'.$user['first_name'].'_'.$user['last_name'];
            $email = new Email();
            $email->from('donotreply@forecastclash.com', 'Forecast Clash')
                ->to($addressC, $firstC)
                ->template('default', 'default')
                ->subject('Forecast Clash Team Request')
                ->send("Someone has requested to join your Forecast Clash team! Please follow the link for details on how to draft this person or prolong their free-agency.\r\n".$link);
            $session->write('successBox', 'Request to join '.h($team['team_name']).' was sent!');
            $session->delete('errorBox');
            return;
        } else {
            $query = $this->TeamsUsers->find()->where(['user_id' => $user['id']]); //check if user already has team
            if ($result = $query->first()) { //if user has a team
                if ($result['team_id'] === $team['id']) { //english selector for whether user is on potential team or different team
                    $word = 'You are already a member of '.$team['team_name'];
                } else {
                    $word = 'You have already joined a team.';
                }
                $session->write('errorBox', $word);
            }
            $teamUser = $this->TeamsUsers->newEntity();
            $teamUser = $this->TeamsUsers->patchEntity($teamUser, [
                'user_id' => $user['id'],
                'team_id' => $team['id']
            ]);
            if($teamUser->errors()){
                $error_msg = [];
                foreach( $teamUser->errors() as $errors){
                    if(is_array($errors)){
                        foreach($errors as $error){
                            $error_msg[] = $error;
                        }
                    }else{
                        $error_msg[] = $errors;
                    }
                }
            }
            if ($this->TeamsUsers->save($teamUser)) {
                $notices = TableRegistry::get('Notifications');
                $notice = $notices->newEntity();
                $notice = $notices->patchEntity($notice, [
                    'user_id' => $user['id'],
                    'message' => 'Take a trip to the podium, you have been selected! Visit the '.$team['team_name'].' Dugout...',
                    'link_address' => '/forecast_clash/teams/dugout',
                    'link_image' => 'teams/users/'.($team['team_logo'] ? $team['team_logo'] : 'logo-mark.png')
                ]);
                $notices->save($notice);
                $session->write('successBox', 'Successfully joined team!');
                $session->delete('errorBox');
                return;
            } else {
                $session->write('errorBox', $error_msg);
                return;
            }
        }
    }
    
    public function joiner() {
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $session = $this->request->session();
            $userID = $session->read('Auth.User.id');
            $teamID = $data['team_id'];
            $teams = TableRegistry::get('Teams');
            $team = $teams->get($teamID);
            $captain = $team['user_id'];
            $userC = TableRegistry::get('Users')->get($captain);
            $addressC = $userC['email'];
            $firstC = $userC['first_name'];
            $user = TableRegistry::get('Users')->get($userID);
            $this->joining($session, $team, $user, $addressC, $firstC, false);
            $url = Router::url(['controller' => 'Teams', 'action' => 'dugout'], TRUE);
            echo json_encode(['url' => $url]);
            die;
        }
    }
    
    public function freeAgent() {
        $session = $this->request->session();
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $teamID = $data['team_id'];
            $team = TableRegistry::get('Teams')->get($teamID);
            $userID = $data['user_id']; //potential member's user_id
            $teamID = $data['team_id'];
            $first = $data['first_name']; //potential member's first name
            if ($data['sign']) { //if user chose to add potential member to team
                $query = $this->TeamsUsers->find()->where(['user_id' => $userID]); //check if potential member already has team
                if ($result = $query->toArray()) { //if potential member has a team
                    if ($result['team_id'] === $teamID) { //english selector for whether potential member is on user's team or different team
                        $word = 'your';
                    } else {
                        $word = 'a';
                    }
                    $session->write('errorBox', $first.' is already on '.$word.' team.');
                    $url = Router::url(['controller' => 'Teams', 'action' => 'dugout'], TRUE);
                    echo json_encode(['url' => $url]);
                    die;
                }
                $teamUser = $this->TeamsUsers->newEntity();
                $teamUser->user_id = $userID;
                $teamUser->team_id = $teamID;
                if ($this->TeamsUsers->save($teamUser)) {
                    $notices = TableRegistry::get('Notifications');
                    $notice = $notices->newEntity();
                    $notice = $notices->patchEntity($notice, [
                        'user_id' => $userID,
                        'message' => 'Take a trip to the podium, you have been selected! Visit the '.$team['team_name'].' Dugout...',
                        'link_address' => '/forecast_clash/teams/dugout',
                        'link_image' => 'teams/users/'.($team['team_logo'] ? $team['team_logo'] : 'logo-mark.png')
                    ]);
                    $notices->save($notice);
                    $session->write('successBox', $first.' was added to your roster!');
                    $session->delete('errorBox');
                    $url = Router::url(['controller' => 'Teams', 'action' => 'dugout'], TRUE);
                    echo json_encode(['url' => $url]);
                    die;
                } else {
                    $session->write('errorBox', "We're sorry, ".$first." was unable to be added to your roster at this time.");
                    $url = Router::url(['controller' => 'Teams', 'action' => 'dugout'], TRUE);
                    echo json_encode(['url' => $url]);
                    die;
                }
            } else {
                $users = TableRegistry::get('Users');
                $user = $users->get($userID);
                $notices = TableRegistry::get('Notifications');
                $notice = $notices->newEntity();
                $notice = $notices->patchEntity($notice, [
                    'user_id' => $userID,
                    'message' => 'Take a trip to the podium, you have been selected! Visit the '.$team['team_name'].' Dugout...',
                    'link_address' => '/forecast_clash/teams/dugout',
                    'link_image' => 'teams/users/'.($team['team_logo'] ? $team['team_logo'] : 'logo-mark.png')
                ]);
                $notices->save($notice);
                $link = Router::url(['controller' => 'TeamsUsers', 'action' => 'dugout'], TRUE);
                $email = new Email();
                $email->from('donotreply@forecastclash.com', 'Forecast Clash')
                    ->to($user['email'], $first)
                    ->template('default', 'default')
                    ->subject('Forecast Clash Team Request')
                    ->send("We're sorry, but ".$data['team_name']." chose not to sign you this Storm Season. A forecaster of your calibur would be welcomed to any of Forecast Clash's public teams! Follow the link below to search for a different team with whom you can showcase your talents!\r\n".$link);
                $session->write('successBox', $first.' has been removed from the scouting report.');
                $session->delete('errorBox');
                $url = Router::url(['controller' => 'Teams', 'action' => 'dugout'], TRUE);
                echo json_encode(['url' => $url]);
                die;
            }
        } else {
            $url = Router::url("",true);
            $params = explode('agent/', $url);
            $param = explode('_', $params[1]);
            $data = ['teamID' => $param[0], 'teamName' => $param[1], 'userID' => $param[2], 'first' => $param[3], 'last' => $param[4]];
            $this->set($data);
        }
    }
    
    public function waiver() {
        $session = $this->request->session();
        if ($currentUserID = $session->read('Auth.User.id')) {
            if ($teamID = $this->request->query('q')) { //if url includes invite queries
                $userID = $this->request->query('z');
                $session->write('User.Linker.team', $teamID); //save those values to the session in case user leaves page and comes back
                $session->write('User.Linker.user', $userID);
            } else {
                $teamID = $session->read('User.Linker.team'); //if user came with queries, left, and came back, retrieve those values
                $userID = $session->read('User.Linker.user');
            }        
            $teams = TableRegistry::get('Teams');
            $team = $teams->get($teamID);
            $userC = TableRegistry::get('Users')->get($team['user_id']);
            $address = $userC['email'];
            $first = $userC['first_name'];
            $user = TableRegistry::get('Users')->get($currentUserID);
            ($userID == $team['user_id']) ? $captain = true : $captain = false;
            $result = $this->joining($session, $team, $user, $address, $first, $captain);
            if ($result['result']) {
                $session->write('successBox', $result['msg']); //display success box
                $session->delete('errorBox');
                if ($result['joined']){
                    return $this->redirect(['controller' => 'teams', 'action' => 'dugout']);
                } else {
                    return $this->redirect(['controller' => '/']);
                }
            } else {
                $session->write('errorBox', $result['msg']);
                return $this->redirect(['controller' => '/']);
            }
        }
    }
    
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow();

    }
}
