<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * States Controller
 *
 * @property \App\Model\Table\StatesTable $States
 */
class StatesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $states = $this->paginate($this->States);

        $this->set(compact('states'));
        $this->set('_serialize', ['states']);
    }
}
