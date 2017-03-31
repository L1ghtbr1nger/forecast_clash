<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Error\Debugger;
use Cake\I18n\Date;
use Cake\ORM\TableRegistry;
use Cake\Network\Http\Client;
use Cake\I18n\Time;

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
                $begin = strtotime($row['forecast_date_start']);
                $end = strtotime($row['forecast_date_end']);
                $http = new Client();
                $params = 'client_id='.$appID.'&client_secret='.$appKey.'&p='.$lat.','.$lon.'&radius='.$radius.'mi&limit=1&from='.$begin.'&to='.$end; //params common to each event comparison
                if ($weather === 1) {
                    $responseTornado = $http->get('https://api.aerisapi.com/stormreports/within?filter=tornado&fields=place.state,report.timestamp,loc.lat,loc.long,report.detail,report.detail.text&'.$params);
                    $jsonResponse = $responseTornado->json;
                    debug($jsonResponse);
                } else if ($weather === 2) {
                    $responseHail = $http->get('https://api.aerisapi.com/stormreports/within?filter=hail&fields=place.state,report.timestamp,loc.lat,loc.long,report.detail,report.detail.text&'.$params);
                    $jsonResponse = $responseHail->json;
                    if ($jsonResponse['error']['code'] != 'warn_no_data') {
                        if ($jsonResponse['response'][0]['report']['detail']['hailIN'] < .75) {
                            $jsonResponse['error']['code'] = 'warn_no_data';     
                        }
                    }
                    debug($jsonResponse);
                } else {
                    $responseWind = $http->get('https://api.aerisapi.com/observations/within?query=wind:50&fields=place.state,ob.dateTimeISO,loc.lat,loc.long&filter=allstations&'.$params);
                    $jsonResponse = $responseWind->json;
                    debug($jsonResponse);
                }
                $correct = $this->HistoricalForecasts->get($row['id']); //grab the current record to mark it correct or incorrect
                $weatherStats = TableRegistry::get('WeatherStatistics');
                $weatherStat = $weatherStats->find()->where(['user_id' => $user, 'weather_event_id' => $weather]); //look for existing stats on selected weather event for selected user
                $scoreboard = TableRegistry::get('Scores');
                $score = $scoreboard->find()->where(['user_id' => $user]); //find user's score record
                if ($jsonResponse['error']['code'] == 'warn_no_data') { //if no events were found, mark forecast as incorrect.
                    $message = 'Better luck next time.  No '.$row['weather_event']['weather'].' events were located within your forecast.  See how your abilities stack up against your fellow forecasters...';
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
                    if (!($result = $score->first())) { //if not found
                        $result = $scoreboard->newEntity(); //create new record
                        $result->user_id = $user; //for selected user
                        $newScore = 0; //calculate score
                        $result->total_score = $newScore; //save score to entity
                        $scoreboard->save($result); //save results to Scores table
                    }
                } else { //if any events were found, mark forecast as correct
                    $message = 'Congratulations!!! You correctly forecast a '.$row['weather_event']['weather'].' event!  See how your abilities stack up against your fellow forecasters...'; 
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
        exit;
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
            if (isset($data['range'][0]) && !empty($data['range'][0])) {
                $rangeF = Time::parse($data['range'][0]);
                $heatmapStats = $heatmapStats->where(['forecast_date_end >=' => $rangeF]);
            }
            if (isset($data['range'][1]) && !empty($data['range'][1])) {
                $rangeT = Time::parse($data['range'][1]);
                $heatmapStats = $heatmapStats->where(['forecast_date_start <=' => $rangeT]);
            }
            if ($heatmapStats = $heatmapStats->toArray()) {
                $result = 1;
                foreach($heatmapStats as $heatmapStat) {
                    $heatmap[] = [$heatmapStat['latitude'], $heatmapStat['longitude'], 200];
                }
            } else {
                $result = 0;
                $heatmap = [];
            }
            echo json_encode(['result' => $result, 'heatmap' => $heatmap, 'user_id' => $userID]);
            die;
        }
    }
    
    public function charts() {
        if ($this->request->is('ajax')) {
            $result = 0;
            $data = $this->request->data;
            $exp = $data['experience'];
            $charts = $this->HistoricalForecasts->find('all')->where()->contain('WeatherEvents')->order('weather_event_id');
            if ($exp == 3) {
                $exp = null;
            }
            if ($exp != 2) {  
                $charts = $charts->contain([
                    'Users' => function($q) use($exp) {
                        return $q->where(['Users.meteorologist' => $exp]);
                    }
                ]);
            }
            $correct = ['Tornado' => 0, 'Hail' => 0, 'Wind' => 0, 'total' => 0];
            $attempts = ['Tornado' => 0, 'Hail' => 0, 'Wind' => 0, 'total' => 0];
            foreach ($charts as $chart) {
                $result = 1;
                $weather = $chart['weather_event']['weather'];
                if ($chart['correct']) {
                    $correct[$weather]++;
                    $correct['total']++;
                }
                $attempts[$weather]++;
                $attempts['total']++;
            }
            echo json_encode(['result' => $result, 'correct' => $correct, 'attempts' => $attempts]);
            die;
        }
    }
    
    public function beforeFilter(Event $event){
        $this->Auth->allow();
    }
}
