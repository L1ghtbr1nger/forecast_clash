<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ],
                'ADmad/HybridAuth.HybridAuth' => [
                    // All keys shown below are defaults
                    'fields' => [
                        'provider' => 'provider',
                        'openid_identifier' => 'openid_identifier',
                        'email' => 'email'
                    ],

                    'profileModel' => 'ADmad/HybridAuth.SocialProfiles',
                    'profileModelFkField' => 'user_id',

                    'userModel' => 'Users',

                    // The URL Hybridauth lib should redirect to after authentication.
                    // If no value is specified you are redirect to this plugin's
                    // HybridAuthController::authenticated() which handles persisting
                    // user info to AuthComponent and redirection.
                    'hauth_return_to' => null
                ]
            ],
            'loginAction' => [
                'controller' => 'users',
                'action' => 'login',
                'plugin' => false
            ],
            'loginRedirect' => [
                'controller' => '/',
                'plugin' => false
            ],
            'logoutRedirect' => [
                'controller' => '/',
                'plugin' => false
            ]
        ]); 
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        $session = $this->request->session();
        $this->set('title', 'Forecast Clash');
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
        
        //success and error box checks
        if ($success = $session->read('successBox')) {
            $this->set('success', $success);
            $session->delete('successBox');
        }
        if ($error = $session->read('errorBox')) {
            $this->set('error', $error);
            $session->delete('errorBox');
        }
        
        // Login Check
        if ($userID = $session->read('Auth.User.id')) {
            $avatar = $session->read('Auth.User.avatar_id');
            $query = TableRegistry::get('Avatars')->find('all')->where(['id' => $avatar])->first();
            if ($avatar < 7) {
                $session->write(['User.avatar' => $query['avatar_img']]);
                $this->set('hasSocial', false);
            } else {
                $query2 = TableRegistry::get('SocialProfiles')->find('all')->where(['user_id' => $userID, 'provider' => $query['avatar_img']])->first();
                $session->write(['User.avatar' => $query2['photo_url']]);
                $this->set('hasSocial', true);
            }
            $notificationsUnread = TableRegistry::get('Notifications')->find('all')->where(['user_id' => $userID, 'seen' => 0])->order(['id' => 'DESC'])->toArray();
            $notificationsRead = TableRegistry::get('Notifications')->find('all')->where(['user_id' => $userID, 'seen' => 1])->toArray();
            $this->set('loggedIn', true);
            $this->set('notificationsRead', $notificationsRead);
        } else {
            $notificationsUnread[] = [
                'id' => 'guest',
                'user_id' => 0,
                'message' => '<big>Please Login!</big>',
                'seen' => false,
                'link_address' => '/forecast_clash/users/login',
                'link_image' => 'logo-mark.png'
            ]; 
            $this->set('loggedIn', false);
        }
        $this->set('notificationsUnread', $notificationsUnread);
    }
}
