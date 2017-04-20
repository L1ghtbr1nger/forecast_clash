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
        
    public function profile() {
        $session = $this->request->session();
        $userID = $session->read('Auth.User.id');
        if ($profile = $this->Profiles->find('all')->where(['user_id' => $userID])->contain('States')->first()) {
            $this->set('updateProfile', $profile);
        }
        if ($user = TableRegistry::get('Users')->get($userID)) {
            $this->set('updateUser', $user);
        }
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            if (empty($data['gender'])) {
                $data['gender'] = 0;
            }
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
                    'message' => 'We are happy to get to know you! Looks like you&#39;re ready to make a forecast.',
                    'link_address' => '/forecast_clash/',
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
