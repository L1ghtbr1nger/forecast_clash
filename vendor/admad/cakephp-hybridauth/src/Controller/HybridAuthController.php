<?php
namespace ADmad\HybridAuth\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * HybridAuth Controller
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 */
class HybridAuthController extends AppController
{

    /**
     * Allow methods 'endpoint' and 'authenticated'.
     *
     * @param \Cake\Event\Event $event Before filter event.
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['endpoint', 'authenticated']);
    }

    /**
     * Endpoint method
     *
     * @return void
     */
    public function endpoint()
    {
        $this->request->session()->start();
        \Hybrid_Endpoint::process();
    }

    /**
     * This action exists just to ensure AuthComponent fetches user info from
     * hybridauth after successful login
     *
     * Hyridauth's `hauth_return_to` is set to this action.
     *
     * @return \Cake\Network\Response
     */
    public function authenticated()
    {
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);
            $session = $this->request->session();
            $userID = $session->read('Auth.User.id');
            $social = TableRegistry::get('social_profiles')->find()->where(['user_id' => $userID])->first();
            $user = TableRegistry::get('Users')->find()->where(['id' => $userID])->first();
            if ($user->toArray()) {
                if (is_null($user->meteorologist)) {
                    $redirect = '/users/meteorology';
                } else {
                    $redirect = '/';
                }
            } else {
                $redirect = '/users/meteorology';        
            }
            $user->first_name = $social->first_name;
            $user->last_name = $social->last_name;
            TableRegistry::get('Users')->save($user);
            return $this->redirect($redirect);
        }

        return $this->redirect($this->Auth->config('loginAction'));
    }
}
