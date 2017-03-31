<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Avatars Controller
 *
 * @property \App\Model\Table\AvatarsTable $Avatars
 */
class AvatarsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $avatars = $this->paginate($this->Avatars);

        $this->set(compact('avatars'));
        $this->set('_serialize', ['avatars']);
    }
}
