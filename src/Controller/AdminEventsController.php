<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AdminEvents Controller
 *
 * @property \App\Model\Table\AdminEventsTable $AdminEvents
 */
class AdminEventsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $adminEvents = $this->paginate($this->AdminEvents);

        $this->set(compact('adminEvents'));
        $this->set('_serialize', ['adminEvents']);
    }
}
