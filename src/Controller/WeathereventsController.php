<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WeatherEvents Controller
 *
 * @property \App\Model\Table\WeatherEventsTable $WeatherEvents
 */
class WeatherEventsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $weatherEvents = $this->paginate($this->WeatherEvents);

        $this->set(compact('weatherEvents'));
        $this->set('_serialize', ['weatherEvents']);
    }

    /**
     * View method
     *
     * @param string|null $id Weather Event id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $weatherEvent = $this->WeatherEvents->get($id, [
            'contain' => ['Forecasts', 'HistoricalForecasts', 'WeatherStatistics']
        ]);

        $this->set('weatherEvent', $weatherEvent);
        $this->set('_serialize', ['weatherEvent']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $weatherEvent = $this->WeatherEvents->newEntity();
        if ($this->request->is('post')) {
            $weatherEvent = $this->WeatherEvents->patchEntity($weatherEvent, $this->request->data);
            if ($this->WeatherEvents->save($weatherEvent)) {
                $this->Flash->success(__('The weather event has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The weather event could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('weatherEvent'));
        $this->set('_serialize', ['weatherEvent']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Weather Event id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $weatherEvent = $this->WeatherEvents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $weatherEvent = $this->WeatherEvents->patchEntity($weatherEvent, $this->request->data);
            if ($this->WeatherEvents->save($weatherEvent)) {
                $this->Flash->success(__('The weather event has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The weather event could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('weatherEvent'));
        $this->set('_serialize', ['weatherEvent']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Weather Event id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $weatherEvent = $this->WeatherEvents->get($id);
        if ($this->WeatherEvents->delete($weatherEvent)) {
            $this->Flash->success(__('The weather event has been deleted.'));
        } else {
            $this->Flash->error(__('The weather event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
