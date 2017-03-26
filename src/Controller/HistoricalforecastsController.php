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
    }
    
    public function compares() {
        $date = new Date(); //date for today
        $datePrev = new Date('-1 day'); //date for yesterday
        $query = $this->HistoricalForecasts->find()->where(['forecast_date_end >=' => $datePrev, 'forecast_date_end <' => $date])->contain('WeatherEvents'); //find records where the forecast ended yesterday
        if ($query->toArray()) { //if record(s) found
            foreach ($query as $row) {
                $appID = 'zihaMoPWm6nYiFjubD6Ox'; //API key
                $appKey = 'Xj8hcr1gb9C1NVvEPALlZmvX38wXsjb9ArN8e7Pw'; //API secret
                $user = $row['user_id'];
                $weather = $row['weather_event_id'];
                $lat = $row['latitude'];
                $lon = $row['longitude'];
                $radius = $row['radius'];
                $begin = $row['forecast_date_start'];
                $end = $row['forecast_date_end'];
                $http = new Client();
                $params = 'client_id='.$appID.'&client_secret='.$appKey.'&p='.$lat.','.$lon.'&radius='.$radius.'mi&limit=1&from='.$begin.'$to='.$end; //params common to each event comparison
                if ($weather === 1) {
                    $responseTornado = $http->get('https://api.aerisapi.com/stormreports/within?filter=tornado&fields=place.state,report.timestamp,loc.lat,loc.long&'.$params);
                    $jsonResponse = $responseTornado->json;
                } else if ($weather === 2) {
                    $responseHail = $http->get('https://api.aerisapi.com/stormreports/within?filter=hail&fields=place.state,report.timestamp,loc.lat,loc.long&'.$params);
                    $jsonResponse = $responseHail->json;
                } else {
                    $responseWind = $http->get('https://api.aerisapi.com/observations/within?query=wind:50&fields=place.state,ob.dateTimeISO,loc.lat,loc.long&filter=allstations&'.$params);
                    $jsonResponse = $responseWind->json;
                }
                $correct = $this->HistoricalForecasts->get($row['id']); //grab the current record to mark it correct or incorrect
                $weatherStats = TableRegistry::get('WeatherStatistics');
                $weatherStat = $weatherStats->find()->where(['user_id' => $user, 'weather_event_id' => $weather]); //look for existing stats on selected weather event for selected user
                if ($jsonResponse['error']['code'] == 'warn_no_data') { //if no events were found, mark forecast as incorrect.
                    $message = 'Congratulations!!! You correctly forecast a '.$row['weather_event']['weather'].' event!  See how your abilities stack up against your fellow forecasters...'; 
                    $correct->correct = 0;
                    if ($statResult = $weatherStat->first()) { //if stats already logged, add to them
                        $statResult->attempts = $statResult['attempts'] + 1;
                        $statResult->radius = $statResult['radius'] + $radius;
                        $statResult->forecast_length = $statResult['forecast_length'] + $row['forecast_length'];
                    } else { //add new record of stats for User/WeatherEvent
                        $statResult = $weatherStats->newEntity();
                        $statResult->user_id = $user;
                        $statResult->weather_event_id = $weather;
                        $statResult->attempts = 1;
                        $statResult->valid_attempts = 0;
                        $statResult->radius = $radius;
                        $statResult->forecast_length = $row['forecast_length'];
                    }
                } else { //if any events were found, mark forecast as correct
                    $message = 'Better luck next time.  No '.$row['weather_event']['weather'].' events were located within your forecast.  See how your abilities stack up against your fellow forecasters...'; 
                    $correct->correct = 1;
                    if ($statResult = $weatherStat->first()) { //if stats already logged, add to them
                        $statResult->attempts = $statResult['attempts'] + 1;
                        $statResult->valid_attempts = $statResult['valid_attempts'] + 1;
                        $statResult->radius = $statResult['radius'] + $radius;
                        $statResult->forecast_length = $statResult['forecast_length'] + $row['forecast_length'];
                    } else { //add new record of stats for User/WeatherEvent
                        $statResult = $weatherStats->newEntity();
                        $statResult->user_id = $user;
                        $statResult->weather_event_id = $weather;
                        $statResult->attempts = 1;
                        $statResult->valid_attempts = 1;
                        $statResult->radius = $radius;
                        $statResult->forecast_length = $row['forecast_length'];
                    }
                    $radiusMult = 3 - ($radius / 5 / 10); //calculate multiplier 1.0 to 2.0 from radius
                    $adminMult = 1;//AdminEvent multiplier needed
                    $length = $row['forecast_length'];
                    $days = round($length / 24); //round hours into days
                    $timeMult = 1 + ($days / 10); //calculate time multiplier 1.0 to 1.8 from days out
                    $scoreboard = TableRegistry::get('Scores');
                    $score = $scoreboard->find()->where(['user_id' => $user]); //find user's score record
                    if ($result = $score->first()) { //if found
                        $newScore = $result['total_score'] + (10 * $radiusMult * $timeMult * $adminMult); //calculate score and add to existing
                    } else { //if not
                        $result = $scoreboard->newEntity(); //create new record
                        $result->user_id = $user; //for selected user
                        $newScore = 10 * $radiusMult * $timeMult * $adminMult; //calculate score
                    }
                    $result->total_score = $newScore;
                    $scoreboard->save($result);
                }
                $weatherStats->save($statResult);
                $this->HistoricalForecasts->save($correct);
                $notices = TableRegistry::get('Notifications');
                $notice = $notices->newEntity();
                $notice = $notices->patchEntity($notice, [
                    'user_id' => $user,
                    'message' => $message,
                    'link_address' => '/forecast_clash/weather-statistics/stats',
                    'link_image' => 'logo-mark.png'
                ]);
                $notices->save($notice);
            }
        }
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
            $heatmapStats = $this->HistoricalForecasts->find('all')->where(['weather_event_id IN' => $weather]);
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
