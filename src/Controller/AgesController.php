<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ages Controller
 *
 * @property \App\Model\Table\AgesTable $Ages
 */
class AgesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $ages = $this->paginate($this->Ages);

        $this->set(compact('ages'));
        $this->set('_serialize', ['ages']);
    }
}
