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

    /**
     * View method
     *
     * @param string|null $id Education Level id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $educationLevel = $this->EducationLevels->get($id, [
            'contain' => ['Profiles']
        ]);

        $this->set('educationLevel', $educationLevel);
        $this->set('_serialize', ['educationLevel']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $educationLevel = $this->EducationLevels->newEntity();
        if ($this->request->is('post')) {
            $educationLevel = $this->EducationLevels->patchEntity($educationLevel, $this->request->data);
            if ($this->EducationLevels->save($educationLevel)) {
                $this->Flash->success(__('The education level has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The education level could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('educationLevel'));
        $this->set('_serialize', ['educationLevel']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Education Level id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $educationLevel = $this->EducationLevels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $educationLevel = $this->EducationLevels->patchEntity($educationLevel, $this->request->data);
            if ($this->EducationLevels->save($educationLevel)) {
                $this->Flash->success(__('The education level has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The education level could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('educationLevel'));
        $this->set('_serialize', ['educationLevel']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Education Level id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $educationLevel = $this->EducationLevels->get($id);
        if ($this->EducationLevels->delete($educationLevel)) {
            $this->Flash->success(__('The education level has been deleted.'));
        } else {
            $this->Flash->error(__('The education level could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
