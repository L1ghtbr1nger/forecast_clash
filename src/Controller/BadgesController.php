<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Badges Controller
 *
 * @property \App\Model\Table\BadgesTable $Badges
 */
class BadgesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $badges = $this->paginate($this->Badges);

        $this->set(compact('badges'));
        $this->set('_serialize', ['badges']);
    }

    /**
     * View method
     *
     * @param string|null $id Badge id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $badge = $this->Badges->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('badge', $badge);
        $this->set('_serialize', ['badge']);
    }
}
