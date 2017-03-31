<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EducationLevels Controller
 *
 * @property \App\Model\Table\EducationLevelsTable $EducationLevels
 */
class EducationLevelsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $educationLevels = $this->paginate($this->EducationLevels);

        $this->set(compact('educationLevels'));
        $this->set('_serialize', ['educationLevels']);
    }
}
