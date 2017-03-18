<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StatesUsers Controller
 *
 * @property \App\Model\Table\StatesUsersTable $StatesUsers
 */
class StatesUsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'States']
        ];
        $statesUsers = $this->paginate($this->StatesUsers);

        $this->set(compact('statesUsers'));
        $this->set('_serialize', ['statesUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id States User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $statesUser = $this->StatesUsers->get($id, [
            'contain' => ['Users', 'States']
        ]);

        $this->set('statesUser', $statesUser);
        $this->set('_serialize', ['statesUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $statesUser = $this->StatesUsers->newEntity();
        if ($this->request->is('post')) {
            $statesUser = $this->StatesUsers->patchEntity($statesUser, $this->request->data);
            if ($this->StatesUsers->save($statesUser)) {
                $this->Flash->success(__('The states user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The states user could not be saved. Please, try again.'));
            }
        }
        $users = $this->StatesUsers->Users->find('list', ['limit' => 200]);
        $states = $this->StatesUsers->States->find('list', ['limit' => 200]);
        $this->set(compact('statesUser', 'users', 'states'));
        $this->set('_serialize', ['statesUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id States User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $statesUser = $this->StatesUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $statesUser = $this->StatesUsers->patchEntity($statesUser, $this->request->data);
            if ($this->StatesUsers->save($statesUser)) {
                $this->Flash->success(__('The states user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The states user could not be saved. Please, try again.'));
            }
        }
        $users = $this->StatesUsers->Users->find('list', ['limit' => 200]);
        $states = $this->StatesUsers->States->find('list', ['limit' => 200]);
        $this->set(compact('statesUser', 'users', 'states'));
        $this->set('_serialize', ['statesUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id States User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $statesUser = $this->StatesUsers->get($id);
        if ($this->StatesUsers->delete($statesUser)) {
            $this->Flash->success(__('The states user has been deleted.'));
        } else {
            $this->Flash->error(__('The states user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
