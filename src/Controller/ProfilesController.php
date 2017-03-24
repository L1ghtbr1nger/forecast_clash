<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

/**
 * Profiles Controller
 *
 * @property \App\Model\Table\ProfilesTable $Profiles
 */
class ProfilesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'EducationLevels', 'States', 'Ages']
        ];
        $profiles = $this->paginate($this->Profiles);

        $this->set(compact('profiles'));
        $this->set('_serialize', ['profiles']);
    }

    /**
     * View method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $profile = $this->Profiles->get($id, [
            'contain' => ['Users', 'EducationLevels', 'States', 'Ages']
        ]);

        $this->set('profile', $profile);
        $this->set('_serialize', ['profile']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $profile = $this->Profiles->newEntity();
        if ($this->request->is('post')) {
            $profile = $this->Profiles->patchEntity($profile, $this->request->data);
            if ($this->Profiles->save($profile)) {
                $this->Flash->success(__('The profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The profile could not be saved. Please, try again.'));
            }
        }
        $users = $this->Profiles->Users->find('list', ['limit' => 200]);
        $educationLevels = $this->Profiles->EducationLevels->find('list', ['limit' => 200]);
        $states = $this->Profiles->States->find('list', ['limit' => 200]);
        $ages = $this->Profiles->Ages->find('list', ['limit' => 200]);
        $this->set(compact('profile', 'users', 'educationLevels', 'states', 'ages'));
        $this->set('_serialize', ['profile']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $profile = $this->Profiles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $profile = $this->Profiles->patchEntity($profile, $this->request->data);
            if ($this->Profiles->save($profile)) {
                $this->Flash->success(__('The profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The profile could not be saved. Please, try again.'));
            }
        }
        $users = $this->Profiles->Users->find('list', ['limit' => 200]);
        $educationLevels = $this->Profiles->EducationLevels->find('list', ['limit' => 200]);
        $states = $this->Profiles->States->find('list', ['limit' => 200]);
        $ages = $this->Profiles->Ages->find('list', ['limit' => 200]);
        $this->set(compact('profile', 'users', 'educationLevels', 'states', 'ages'));
        $this->set('_serialize', ['profile']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $profile = $this->Profiles->get($id);
        if ($this->Profiles->delete($profile)) {
            $this->Flash->success(__('The profile has been deleted.'));
        } else {
            $this->Flash->error(__('The profile could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
        
    public function profile() {
        $session = $this->request->session();
        $userID = $session->read('Auth.User.id');
        if ($profile = $this->Profiles->find('all')->where(['user_id' => $userID])->contain('States')->first()) {
            $this->set('update', $profile);
        }
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $data['user_id'] = $userID;
            if (!$profile) {
                $profile = $this->Profiles->newEntity();
            }
            $profile = $this->Profiles->patchEntity($profile, $data);
            if($profile->errors()){
                $error_msg = [];
                foreach( $profile->errors() as $errors){
                    if(is_array($errors)){
                        foreach($errors as $error){
                            $error_msg[] = $error;
                        }
                    }else{
                        $error_msg[] = $errors;
                    }
                }
            }
            if ($this->Profiles->save($profile)) {
                $notices = TableRegistry::get('Notifications');
                $notice = $notices->newEntity();
                $notice = $notices->patchEntity($notice, [
                    'user_id' => $userID,
                    'message' => 'We are happy to get to know you! Looks like you&#39;re ready to make a forecast...',
                    'link_address' => '/forecast_clash/profiles/profile',
                    'link_image' => 'logo-mark.png'
                ]);
                $notices->save($notice);
                $session->write('successBox', 'Profile completed!');
                $url = Router::url(['controller' => 'Profiles', 'action' => 'profile'], TRUE);
                echo json_encode(['msg' => 'Thank you!', 'result' => 1, 'regLog' => 0, 'url' => $url]);
            } else {
                echo json_encode(['msg' => $error_msg, 'result' => 0, 'regLog' => 0]);
            }
            die;
        }
        $tables = ['States' => 'state_name', 'EducationLevels' => 'education', 'Ages' => 'age_range'];
        foreach ($tables as $table => $field) {
            $tableDB = TableRegistry::get($table);
            $query = $tableDB->find();
            $result = [];
            foreach ($query as $row) {
                $result[$row['id']] = $row[$field];
            }
            $this->set(lcfirst($table), $result);
        }
        $this->set('user_id', $session->read('Auth.User.id'));
    }
}
