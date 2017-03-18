<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Error\Debugger;
use Cake\I18n\Date;
use Cake\ORM\TableRegistry;
use Cake\Network\Http\Client;

/**
 * HistoricalForecasts Controller
 *
 * @property \App\Model\Table\HistoricalForecastsTable $HistoricalForecasts
 */
class HistoricalForecastsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'WeatherEvents', 'AdminEvents']
        ];
        $historicalForecasts = $this->paginate($this->HistoricalForecasts);

        $this->set(compact('historicalForecasts'));
        $this->set('_serialize', ['historicalForecasts']);
    }

    /**
     * View method
     *
     * @param string|null $id Historical Forecast id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $historicalForecast = $this->HistoricalForecasts->get($id, [
            'contain' => ['Users', 'WeatherEvents', 'AdminEvents']
        ]);

        $this->set('historicalForecast', $historicalForecast);
        $this->set('_serialize', ['historicalForecast']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $historicalForecast = $this->HistoricalForecasts->newEntity();
        if ($this->request->is('post')) {
            $historicalForecast = $this->HistoricalForecasts->patchEntity($historicalForecast, $this->request->data);
            if ($this->HistoricalForecasts->save($historicalForecast)) {
                $this->Flash->success(__('The historical forecast has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The historical forecast could not be saved. Please, try again.'));
            }
        }
        $users = $this->HistoricalForecasts->Users->find('list', ['limit' => 200]);
        $weatherEvents = $this->HistoricalForecasts->WeatherEvents->find('list', ['limit' => 200]);
        $adminEvents = $this->HistoricalForecasts->AdminEvents->find('list', ['limit' => 200]);
        $this->set(compact('historicalForecast', 'users', 'weatherEvents', 'adminEvents'));
        $this->set('_serialize', ['historicalForecast']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Historical Forecast id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $historicalForecast = $this->HistoricalForecasts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $historicalForecast = $this->HistoricalForecasts->patchEntity($historicalForecast, $this->request->data);
            if ($this->HistoricalForecasts->save($historicalForecast)) {
                $this->Flash->success(__('The historical forecast has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The historical forecast could not be saved. Please, try again.'));
            }
        }
        $users = $this->HistoricalForecasts->Users->find('list', ['limit' => 200]);
        $weatherEvents = $this->HistoricalForecasts->WeatherEvents->find('list', ['limit' => 200]);
        $adminEvents = $this->HistoricalForecasts->AdminEvents->find('list', ['limit' => 200]);
        $this->set(compact('historicalForecast', 'users', 'weatherEvents', 'adminEvents'));
        $this->set('_serialize', ['historicalForecast']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Historical Forecast id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $historicalForecast = $this->HistoricalForecasts->get($id);
        if ($this->HistoricalForecasts->delete($historicalForecast)) {
            $this->Flash->success(__('The historical forecast has been deleted.'));
        } else {
            $this->Flash->error(__('The historical forecast could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }-yers = intval($data['players']); //which player tab
            $weather = $data['events']; //which weather events or none
            $correct = $data['correct'];
            $heatmapStats = $this->Historicalforecasts->find('all')->where(['weather_event_id IN' => $weather]);
            if($players === 0) { //just the user's stats
                $heatmapStats = $heatmapStats->where(['user_id' => $userID]);
            } else if ($players === 1) { //just the user's team's stats
                $heatmapStats = $heatmapStats->matching('TeamsUsers', function($q) use($teamUser) {
                        return $q->where(['TeamsUsers.team_id' => $teamUser['team_id']]);
                    }
                );
            } //no WHERE clause needed for all users state
            if ($exp == 3) {
                $exp = null;
            }
            if ($exp != 2) {  
                $heatmapStats = $heatmapStats->contain([
                    'Users' => function($q) use($exp) {
                        return $q->where(['Users.meteorologist' => $exp]);
                    }
                ]);
            }
            if ($correct == 3) {
                $correct = null;
            }
            if ($correct != 2) {  
                $heatmapStats = $heatmapStats->where(['correct' => $correct]);
            }  
            if ($heatmapStats = $heatmapStats->toArray()) {
                $result = 1;
                foreach($heatmapStats as $heatmapStat) {
                    $heatmap[] = [$heatmapStat['latitude'], $heatmapStat['longitude'], 300];
                }
            } else {
                $result = 0;
                $heatmap = [];
            }
            echo json_encode(['result' => $result, 'heatmap' => $heatmap, 'user_id' => $userID]);
            die;
        }
    }
    
    public function beforeFilter(Event $event){
        $this->Auth->allow();
    }
}
