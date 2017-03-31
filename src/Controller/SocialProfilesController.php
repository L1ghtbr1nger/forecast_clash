<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SocialProfiles Controller
 *
 * @property \App\Model\Table\SocialProfilesTable $SocialProfiles
 */
class SocialProfilesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $socialProfiles = $this->paginate($this->SocialProfiles);

        $this->set(compact('socialProfiles'));
        $this->set('_serialize', ['socialProfiles']);
    }
}
