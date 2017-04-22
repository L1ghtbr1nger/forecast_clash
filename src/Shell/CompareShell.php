<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\Network\Http\Client;
use Cake\I18n\Date;

class CompareShell extends Shell
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('HistoricalForecasts');
    }
    
    public function main() {
        $date = new Date(); //date for today
        $datePrev = new Date('-1 day'); //date for yesterday
        $query = $this->HistoricalForecasts->find()->where(['correct IS' => NULL, 'forecast_date_end <' => $date])->contain('WeatherEvents'); //find records where the forecast ended yesterday
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
                $niceDate = new Date($row['forecast_date_start']);
                $niceDate->nice();
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
                    $message = 'Better luck next time.  No '.$row['weather_event']['weather'].' events were located within your forecast for '.$niceDate.'. See how your abilities stack up against your fellow forecasters...';
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
                    $message = 'Congratulations!!! You correctly forecasted a '.$row['weather_event']['weather'].' event for '.$niceDate.'!  See how your abilities stack up against your fellow forecasters...'; 
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
    }
}
?>