<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StatesUsers Controller
 *
 * @property \App\Model\Table\StatesUsersTable $StatesUsers
 */
class StatesUsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'States']
        ];
        $statesUsers = $this->paginate($this->StatesUsers);

        $this->set(compact('statesUsers'));
        $this->set('_serialize', ['statesUsers']);
    }
}
