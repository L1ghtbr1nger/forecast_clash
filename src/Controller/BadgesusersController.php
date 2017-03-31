<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BadgesUsers Controller
 *
 * @property \App\Model\Table\BadgesUsersTable $BadgesUsers
 */
class BadgesUsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Badges']
        ];
        $badgesUsers = $this->paginate($this->BadgesUsers);

        $this->set(compact('badgesUsers'));
        $this->set('_serialize', ['badgesUsers']);
    }
}
