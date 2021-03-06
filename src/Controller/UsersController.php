<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\ContactForm;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Utility\Text;
use Cake\Utility\Security;
use Cake\Routing\Router;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Avatars']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }
    
    // Login
    public function login() {
        $session = $this->request->session();
        if (null !== $session->read('Auth.User')) {
            $this->redirect('/');
        }
        if ($this->request->is('ajax') || $this->request->query('provider')) {
            $referer = $session->read('referer');
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if ($referer == '/' || !isset($referer)) { $referer = '/forecast_clash/'; }
                $session->write('successBox', 'Logged in!');
                echo json_encode(['result' => 1, 'regLog' => 1, 'url' => $referer]);
                die;
            } else {
                echo json_encode(['msg' => 'Invalid login. Please enter an email and password associated with Forecast Clash or sign up now.', 'result' => 0, 'regLog' => 1]);
                die;
            } 
        } else {
            $refer_url = $this->referer('/', true); //get url path minus base path
            $url_array = Router::parse($refer_url); //explode path into array
            $action = $url_array['action'];
            if ($action === 'register' || $action === 'resetPassword' || $action === 'forgotPassword' || $refer_url == '/') {
                if ($session->read('referer') !== null) {
                    $referer = $session->read('referer');
                } else {
                    $referer = '/forecast_clash/';
                }
            } else {
                $referer = $this->referer();
                $session->write('referer', $referer);
            }
        }
    }
 
    // Logout
    public function logout() {
        $this->Auth->logout();
        $this->request->session()->destroy();
        $this->redirect('/');
    }
    
    // Registration
    public function register() {
        $session = $this->request->session();
        if (null !== $session->read('Auth.User')) {
            $this->redirect('/');
        }
        if ($this->request->is('ajax')) {
            $user = $this->Users->newEntity($this->request->data, ['validate' => 'register']);
            if($user->errors()){
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
            if ($result = $this->Users->save($user)) {
                $notices = TableRegistry::get('Notifications');
                $notice = $notices->newEntity();
                $notice = $notices->patchEntity($notice, [
                    'user_id' => $result['id'],
                    'message' => 'Thank you for registering with Forecast Clash! Visit your profile page to tell us more about yourself.',
                    'link_address' => '/forecast_clash/profiles/profile',
                    'link_image' => 'logo-mark.png'
                ]);
                $notices->save($notice);
                $session->write('successBox', 'Successfully registered!');
                $url = Router::url(['controller' => 'Users', 'action' => 'login'], TRUE);
                echo json_encode(['result' => 1, 'regLog' => 0, 'url' => $url]);
            } else {
                echo json_encode(['msg' => $error_msg, 'result' => 0, 'regLog' => 0]);
            }
            $this->set(compact('user'));
            $this->set('_serialize', ['user']);
            die;
        }
    }
    
    public function meteorology() {
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $session = $this->request->session();
            $userID = $session->read('Auth.User.id');
            $met = $this->Users->find()->where(['id' => $userID])->first();
            $met['meteorologist'] = $data['experience'];
            $this->Users->save($met);
        }
    }
    
    
    //Function to send email to provided address with link to reset password.
    public function forgotPassword() {
        $session = $this->request->session();
        if ($this->request->is('ajax')) {
            if (!empty($this->request->data)) {
                $email = $this->request->data['email'];
                $user = $this->Users->findByEmail($email)->first();
                if (!empty($user)) {
                    $password = sha1(Text::uuid());
                    $password_token = Security::hash($password, 'sha256', true);
                    $hashval = sha1($user->username . rand(0, 100));
                    $user->password_reset_token = $password_token;
                    $user->hashval = $hashval;
                    $address = $user->email;
                    $name = $user->first_name;
                    $reset_token_link = Router::url(['controller' => 'Users', 'action' => 'resetPassword'], TRUE) . '/' . $password_token . '#' . $hashval;
                    $email = new Email();
                    $email->from('info@forecastclash.com', 'Forecast Clash')
                        ->to($address, $name)
                        ->template('default', 'default')
                        ->subject('Reset your Forecast Clash password')
                        ->send("Follow the link provided to reset your password:\r\n".$reset_token_link);
                    $this->Users->save($user);
                    $session->write('successBox', 'Email sent with password reset instructions!');
                    $url = Router::url(['controller' => 'Users', 'action' => 'login'], TRUE);
                    echo json_encode(['result' => 1, 'regLog' => 0, 'url' => $url]);
                    die;
                } else {
                    echo json_encode(['msg' => 'Provided email not associated with an active Forecast Clash account.', 'result' => 0, 'regLog' => 1]);
                    die;
                }
            }
        }
    }
    
    public function resetPassword() {
        $session = $this->request->session();
        if ($this->request->is('ajax')) {
            if (!empty($this->request->data)) {
                $data = $this->request->data;
                $token = $data['token'];
                $user = $this->Users->findByPasswordResetToken($token)->first();
                if ($user) {
                    $user = $this->Users->patchEntity($user, [
                        'password' => $data['new_password'],
                        'confirm_password' => $data['confirm_password']
                    ], ['validate' => 'register']);
                    if($user->errors()){
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
                    $hashval_new = sha1($user->first_name . rand(0, 100));
                    $user->password_reset_token = $hashval_new;
                    if ($this->Users->save($user)) {
                        $session->write('successBox', 'Your password has been changed successfully.');
                        $url = Router::url(['controller' => 'Users', 'action' => 'login'], TRUE);
                        echo json_encode(['result' => 1, 'regLog' => 0, 'url' => $url]);
                    } else {
                        echo json_encode(['msg' => $error_msg, 'result' => 0, 'regLog' => 0]);
                    }
                } else {
                    $url = Router::url(['controller' => 'Users', 'action' => 'forgot_password'], TRUE);
                    echo json_encode(['msg' => 'Sorry your password token has expired.', 'result' => 0, 'regLog' => 1, 'url' => $url]);
                }
            } else {
                echo json_encode(['msg' => 'Error loading password reset.', 'result' => 0, 'regLog' => 1]);
            }
            $this->set(compact('user'));
            $this->set('_serialize', ['user']);
            die;
        } else {
            $url = Router::url("",true);
            $toke = explode('reset-password/', $url);
            $token = $toke[1];
            $this->set('token', $token);
        }
    }
    
    public function contact() {
        $contact = new ContactForm();
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $err = [];
            if (!$contact->validate($this->request->data())) {
                $err[] = 'Please include a valid email address';
            }
            if (empty($data['name']) || !isset($data['name'])) {
                $err[] = 'Please include your name';
            }
            if (empty($data['message']) || !isset($data['message'])) {
                $err[] = 'Please include a message';
            }
            if (empty($err)) {
                $session = $this->request->session();
                $email = new Email();
                $email->from('info@forecastclash.com')
                    ->to('info@forecastclash.com') //'info@forecastclash.com'
                    ->template('default', 'default')
                    ->subject($data['name'].' Contact')
                    ->send($data['name']." at ".$data['email']." says: \r\n\r\n".$data['message']);
                $session->write('successBox', 'Message succesfully sent.  Thank you for your comments or concerns!');
                echo json_encode(['result' => 1]);
            } else {
                echo json_encode(['result' => 0, 'msg' => $err]);
            }
            die;
        }
    }
    
//    public function notice() {
//        $users = $this->Users->find();
//        foreach ($users as $user) {
//            $notices = TableRegistry::get('Notifications');
//            $notice = $notices->newEntity();
//            $notice = $notices->patchEntity($notice, [
//                'user_id' => $user['id'],
//                'message' => 'Thank you for helping us make Forecast Clash even better! You might have noticed an update to scores and stats as weather data was updated to fit our needs. We also listened to you, and updated our forecast system to take forecasts in UTC, among many little updates to the quality and ease of your experience. Find out who the real leading experts are now!!!',
//                'link_address' => '/forecast_clash/weather-statistics/stats',
//                'link_image' => 'logo-mark.png'
//            ]);
//            $notices->save($notice);
//            
//        }
//    }
    
    public function beforeFilter(Event $event){
        $this->Auth->allow();
    }
    
}
