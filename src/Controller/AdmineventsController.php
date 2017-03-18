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

    /**
     * View method
     *
     * @param string|null $id Admin Event id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $adminEvent = $this->AdminEvents->get($id, [
            'contain' => ['HistoricalForecasts']
        ]);

        $this->set('adminEvent', $adminEvent);
        $this->set('_serialize', ['adminEvent']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $adminEvent = $this->AdminEvents->newEntity();
        if ($this->request->is('post')) {
            $adminEvent = $this->AdminEvents->patchEntity($adminEvent, $this->request->data);
            if ($this->AdminEvents->save($adminEvent)) {
                $this->Flash->success(__('The admin event has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The admin event could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('adminEvent'));
        $this->set('_serialize', ['adminEvent']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Admin Event id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $adminEvent = $this->AdminEvents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $adminEvent = $this->AdminEvents->patchEntity($adminEvent, $this->request->data);
            if ($this->AdminEvents->save($adminEvent)) {
                $this->Flash->success(__('The admin event has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The admin event could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('adminEvent'));
        $this->set('_serialize', ['adminEvent']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin Event id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $adminEvent = $this->AdminEvents->get($id);
        if ($this->AdminEvents->delete($adminEvent)) {
            $this->Flash->success(__('The admin event has been deleted.'));
        } else {
            $this->Flash->error(__('The admin event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
