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
                $http = new Client();
                $correct = $this->Historicalforecasts->get($row['id']);
                $params = 'client_id='.$appID.'&client_secret='.$appKey.'&p='.$lat.','.$lon.'&radius='.$radius.'mi&limit=1&from='.$begin.'$to='.$end;
                if ($weather === 1) {
                    $responseTornado = $http->get('https://api.aerisapi.com/stormreports/within?filter=tornado&fields=place.state,report.timestamp,loc.lat,loc.long&'.$params);
                    $jsonResponse = $responseTornado->json;
                } else if ($weather === 2) {
                    $responseHail = $http->get('https://api.aerisapi.com/stormreports/within?filter=hail&fields=place.state,report.timestamp,loc.lat,loc.long&'.$params);
                    $jsonResponse = $responseHail->json;
                } else {
                    $responseWind = $http->get('https://api.aerisapi.com/observations/within?query=wind:21.7&fields=place.state,ob.dateTimeISO,loc.lat,loc.long&filter=allstations&'.$params);
                    $jsonResponse = $responseWind->json;
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
    
    public function heatmap() {
        if ($this->request->is('ajax')) {
            $session = $this->request->session();
            $userID = $session->read('Auth.User.id');
            $teamsUsers = TableRegistry::get('TeamsUsers');
            $teamUser = $teamsUsers->find()->where(['TeamsUsers.user_id' => $userID])->first(); //look for user's team
            $data = $this->request->data;
            $exp = $data['experience']; //meteorologist and/or weather enthusiast or neither
            $players = intval($data['players']); //which player tab
            $weather = $data['events']; //which weather events or none
            $correct = $data['correct'];
            $heatmapStats = $this->Historicalforecasts->find('all')->where(['weather_event_id IN' => $weather]);
            if($players === 0) { //just the user's stats
                $heatmapStats = $heatmapStats->where(['$user_id' => $userID]);
            } else if ($players === 1) { //just the user's team's stats
                $heatmapStats = $heatmapStats->contain([
                    'TeamsUsers' => function($q) use($teamUser) {
                        return $q->where(['TeamsUsers.team_id' => $teamUser['team_id']]);
                    }
                ]);
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
