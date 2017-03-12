<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Error\Debugger;
use Cake\I18n\Date;
use Cake\ORM\TableRegistry;
use Cake\Network\Http\Client;

/**
 * Historicalforecasts Controller
 *
 * @property \App\Model\Table\HistoricalforecastsTable $Historicalforecasts
 */
class HistoricalforecastsController extends AppController
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
        $historicalforecasts = $this->paginate($this->Historicalforecasts);

        $this->set(compact('historicalforecasts'));
        $this->set('_serialize', ['historicalforecasts']);
    }

    /**
     * View method
     *
     * @param string|null $id Historicalforecast id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $historicalforecast = $this->Historicalforecasts->get($id, [
            'contain' => ['Users', 'WeatherEvents', 'AdminEvents']
        ]);

        $this->set('historicalforecast', $historicalforecast);
        $this->set('_serialize', ['historicalforecast']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $historicalforecast = $this->Historicalforecasts->newEntity();
        if ($this->request->is('post')) {
            $historicalforecast = $this->Historicalforecasts->patchEntity($historicalforecast, $this->request->data);
            if ($this->Historicalforecasts->save($historicalforecast)) {
                $this->Flash->success(__('The historicalforecast has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The historicalforecast could not be saved. Please, try again.'));
            }
        }
        $users = $this->Historicalforecasts->Users->find('list', ['limit' => 200]);
        $weatherEvents = $this->Historicalforecasts->WeatherEvents->find('list', ['limit' => 200]);
        $adminEvents = $this->Historicalforecasts->AdminEvents->find('list', ['limit' => 200]);
        $this->set(compact('historicalforecast', 'users', 'weatherEvents', 'adminEvents'));
        $this->set('_serialize', ['historicalforecast']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Historicalforecast id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $historicalforecast = $this->Historicalforecasts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $historicalforecast = $this->Historicalforecasts->patchEntity($historicalforecast, $this->request->data);
            if ($this->Historicalforecasts->save($historicalforecast)) {
                $this->Flash->success(__('The historicalforecast has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The historicalforecast could not be saved. Please, try again.'));
            }
        }
        $users = $this->Historicalforecasts->Users->find('list', ['limit' => 200]);
        $weatherEvents = $this->Historicalforecasts->WeatherEvents->find('list', ['limit' => 200]);
        $adminEvents = $this->Historicalforecasts->AdminEvents->find('list', ['limit' => 200]);
        $this->set(compact('historicalforecast', 'users', 'weatherEvents', 'adminEvents'));
        $this->set('_serialize', ['historicalforecast']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Historicalforecast id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $historicalforecast = $this->Historicalforecasts->get($id);
        if ($this->Historicalforecasts->delete($historicalforecast)) {
            $this->Flash->success(__('The historicalforecast has been deleted.'));
        } else {
            $this->Flash->error(__('The historicalforecast could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function compares() {
        $datePrev = new Date();
        $datePrev->modify('-3 days');
        $query = $this->Historicalforecasts->find()->where(['forecast_date' => $datePrev]);
        if ($query->toArray()) {
            debug($query);
            foreach ($query as $row) {
                $appID = 'zihaMoPWm6nYiFjubD6Ox';
                $appKey = 'Xj8hcr1gb9C1NVvEPALlZmvX38wXsjb9ArN8e7Pw';
                $user = $row['user_id'];
                $weather = $row['weather_event_id'];
                $lat = $row['latitude'];
                $lon = $row['longitude'];
                $am_pm = $row['am_pm'];
                debug($am_pm);
                $radius = $row['radius'];
                if (!$am_pm) {
                    $begin = $datePrev->format('Y-m-d').'T00:00:00Z';
                    $end = $datePrev->format('Y-m-d').'T11:59:59Z';
                } else {
                    $begin = $datePrev->format('Y-m-d').'T12:00:00Z';
                    $end = $datePrev->format('Y-m-d').'T23:59:59Z';
                }
                $begin = strtotime($begin);
                $end = strtotime($end);
                debug(date('Y-m-d H:i:s', $begin));
                debug(date('Y-m-d H:i:s', $end));
                $http = new Client();
                $correct = $this->Historicalforecasts->get($row['id']);
                debug($correct);
                $params = 'client_id='.$appID.'&client_secret='.$appKey.'&p='.$lat.','.$lon.'&radius='.$radius.'mi&limit=1&from='.$begin.'$to='.$end;
                debug($params);
                if ($weather === 1) {
                    $responseTornado = $http->get('https://api.aerisapi.com/stormreports/within?filter=tornado&fields=place.state,report.timestamp,loc.lat,loc.long&'.$params);
                    $jsonResponse = $responseTornado->json;
                    debug($jsonResponse);
                } else if ($weather === 2) {
                    $responseHail = $http->get('https://api.aerisapi.com/stormreports/within?filter=hail&fields=place.state,report.timestamp,loc.lat,loc.long&'.$params);
                    $jsonResponse = $responseHail->json;
                    debug($jsonResponse);
                } else {
                    $responseWind = $http->get('https://api.aerisapi.com/observations/within?query=wind:21.7&fields=place.state,ob.dateTimeISO,loc.lat,loc.long&filter=allstations&'.$params);
                    $jsonResponse = $responseWind->json;
                    debug($jsonResponse);
                }
                $weatherStats = TableRegistry::get('WeatherStatistics');
                $weatherStat = $weatherStats->find()->where(['user_id' => $user, 'weather_event_id' => $weather]);
                if ($jsonResponse['error']['code'] == 'warn_no_data') { //if no events were found, mark forecast as incorrect.
                    $correct->correct = 0;
                    if ($statResult = $weatherStat->first()) {
                        $statResult->attempts = $statResult['attempts'] + 1;
                        $statResult->radius = $statResult['radius'] + $radius;
                        $statResult->forecast_length = $statResult['forecast_length'] + $row['forecast_length'];
                    } else {
                        $statResult = $weatherStats->newEntity();
                        $statResult->user_id = $user;
                        $statResult->weather_event_id = $weather;
                        $statResult->attempts = 1;
                        $statResult->valid_attempts = 0;
                        $statResult->radius = $radius;
                        $statResult->forecast_length = $row['forecast_length'];
                    }
                } else { //if any events were found, mark forecast as correct and add to user's score and weatherstats.
                    $correct->correct = 1;
                    if ($statResult = $weatherStat->first()) {
                        $statResult->attempts = $statResult['attempts'] + 1;
                        $statResult->valid_attempts = $statResult['valid_attempts'] + 1;
                        $statResult->radius = $statResult['radius'] + $radius;
                        $statResult->forecast_length = $statResult['forecast_length'] + $row['forecast_length'];
                    } else {
                        $statResult = $weatherStats->newEntity();
                        $statResult->user_id = $user;
                        $statResult->weather_event_id = $weather;
                        $statResult->attempts = 1;
                        $statResult->valid_attempts = 1;
                        $statResult->radius = $radius;
                        $statResult->forecast_length = $row['forecast_length'];
                    }
                    $radiusMult = 2.1 - ($radius * 2 / 100);
                    $adminMult = 1;//AdminEvent multiplier needed
                    $length = $row['forecast_length'];
                    $days = round($length / 24);
                    $timeMult = 1 + ($days / 10);
                    $scoreboard = TableRegistry::get('Scores');
                    $score = $scoreboard->find()->where(['user_id' => $user]);
                    if ($result = $score->first()) {
                        $newScore = $result['total_score'] + (10 * $radiusMult * $timeMult * $adminMult);                        
                    } else {
                        $result = $scoreboard->newEntity();
                        $result->user_id = $user;
                        $newScore = 10 * $radiusMult * $timeMult * $adminMult;
                    }
                    $result->total_score = $newScore;
                    $scoreboard->save($result);
                }
                $weatherStats->save($statResult);
                $this->Historicalforecasts->save($correct);
            }
        }
        die;
    }
    
    public function beforeFilter(Event $event){
        $this->Auth->allow();
    }
}
