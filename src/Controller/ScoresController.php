<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Scores Controller
 *
 * @property \App\Model\Table\ScoresTable $Scores
 */
class ScoresController extends AppController
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
        $scores = $this->paginate($this->Scores);

        $this->set(compact('scores'));
        $this->set('_serialize', ['scores']);
    }
}
