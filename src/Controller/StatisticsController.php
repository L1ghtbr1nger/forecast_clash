<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Statistics Controller
 *
 * @property \App\Model\Table\StatisticsTable $Statistics
 */
class StatisticsController extends AppController
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
        $statistics = $this->paginate($this->Statistics);

        $this->set(compact('statistics'));
        $this->set('_serialize', ['statistics']);
    }

    /**
     * View method
     *
     * @param string|null $id Statistic id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $statistic = $this->Statistics->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('statistic', $statistic);
        $this->set('_serialize', ['statistic']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $statistic = $this->Statistics->newEntity();
        if ($this->request->is('post')) {
            $statistic = $this->Statistics->patchEntity($statistic, $this->request->data);
            if ($this->Statistics->save($statistic)) {
                $this->Flash->success(__('The statistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The statistic could not be saved. Please, try again.'));
            }
        }
        $users = $this->Statistics->Users->find('list', ['limit' => 200]);
        $this->set(compact('statistic', 'users'));
        $this->set('_serialize', ['statistic']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Statistic id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $statistic = $this->Statistics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $statistic = $this->Statistics->patchEntity($statistic, $this->request->data);
            if ($this->Statistics->save($statistic)) {
                $this->Flash->success(__('The statistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The statistic could not be saved. Please, try again.'));
            }
        }
        $users = $this->Statistics->Users->find('list', ['limit' => 200]);
        $this->set(compact('statistic', 'users'));
        $this->set('_serialize', ['statistic']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Statistic id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $statistic = $this->Statistics->get($id);
        if ($this->Statistics->delete($statistic)) {
            $this->Flash->success(__('The statistic has been deleted.'));
        } else {
            $this->Flash->error(__('The statistic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
//    public function stats() {
//        $query = $this->Statistics->find('all');
//        foreach ($query as $row) {
//            if($row['active']) {
//                $currentStreak = $row['current_streak'] + 1;
//                $row->current_streak = $currentStreak;
//                $highStreak = $row['highest_streak'];
//                if ($currentStreak > $highStreak) {
//                    $row->highest_streak = $currentStreak;
//                }
//                $row->active = 0;
//            } else {
//                $row->current_streak = 0;
//            }
//            $this->Statistics->save($row);
//        }
//    }
}
