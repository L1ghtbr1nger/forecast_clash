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
    
    public function joiner() {
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $session = $this->request->session();
            $user = $session->read('Auth.User.id');
            $teamID = $data['team_id'];
            $teams = TableRegistry::get('Teams');
            $team = $teams->get($teamID, ['contain' => ['Users']]);
            $teamName = $team->team_name;
            $address = $team->user->email;
            $first = $team->user->first_name;
            $last = $team->user->last_name;
            if ($team->privacy) { //if the selected team is private, send email to team captain with link to accept or reject request
                $link = Router::url(['controller' => 'Teamsusers', 'action' => 'freeAgent'], TRUE).'/'.$teamID.'_'.$teamName.'_'.$user.'_'.$first.'_'.$last;
                $email = new Email();
                $email->from('donotreply@forecastclash.com', 'Forecast Clash')
                    ->to($address, $first)
                    ->template('default', 'default')
                    ->subject('Forecast Clash Team Request')
                    ->send("Someone has requested to join your Forecast Clash team! Please follow the link for details on how to draft this person or prolong their free-agency.\r\n".$link);
                echo json_encode(['msg' => 'Request to join team was sent!', 'result' => 1]);
                die;
            } else {
                $teamUser = $this->TeamsUsers->newEntity();
                $teamUser = $this->TeamsUsers->patchEntity($teamUser, [
                    'user_id' => $user,
                    'team_id' => $teamID
                ]);
                if($teamUser->errors()){
                    $error_msg = [];
                    foreach( $user->errors() as $errors){
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
                    echo json_encode(['msg' => 'Joined team!', 'result' => 1]);
                    die;
                } else {
                    echo json_encode(['msg' => $error_msg, 'result' => 0]);
                    die;
                }
            }
        }
    }
    
    public function freeAgent() {
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $userID = $data['user_id'];
            $teamID = $data['team_id'];
            $first = $data['first_name'];
            if ($data['sign']) {
                $query = $this->TeamsUsers->find()->where(['user_id' => $userID]);
                if ($result = $query->toArray()) {
                    if ($result['team_id'] === $teamID) {
                        $word = 'your';
                    } else {
                        $word = 'a';
                    }
                    echo json_encode(['msg' => $first.' is already on '.$word.' team.', 'result' => 1]);
                    die;
                }
                $teamUser = $this->TeamsUsers->newEntity();
                $teamUser->user_id = $userID;
                $teamUser->team_id = $teamID;
                if ($this->TeamsUsers->save($teamUser)) {
                    echo json_encode(['msg' => $first.' was added to your roster!', 'result' => 1]);
                    die;
                } else {
                    echo json_encode(['msg' => "We're sorry, ".$first." was unable to be added to your roster at this time.", 'result' => 0]);
                    die;
                }
            } else {
                $users = TableRegistry::get('Users');
                $user = $users->get($userID);
                $link = Router::url(['controller' => 'Teamsusers', 'action' => 'dugout'], TRUE);
                $email = new Email();
                $email->from('donotreply@forecastclash.com', 'Forecast Clash')
                    ->to($user['email'], $first)
                    ->template('default', 'default')
                    ->subject('Forecast Clash Team Request')
                    ->send("We're sorry, but ".$data['team_name']." chose not to sign you this Storm Season. A forecaster of your calibur would be welcomed to any of Forecast Clash's public teams! Follow the link below to search for a different team with whom you can showcase your talents!\r\n".$link);
                echo json_encode(['msg' => 'User has been notified that they did not make the team.', 'result' => 1]);
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
    
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow();

    }
}
