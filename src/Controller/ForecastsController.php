<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Error\Debugger;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;


/**
 * Forecasts Controller
 *
 * @property \App\Model\Table\ForecastsTable $Forecasts
 */
class ForecastsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'WeatherEvents']
        ];
        $forecasts = $this->paginate($this->Forecasts);

        $this->set(compact('forecasts'));
        $this->set('_serialize', ['forecasts']);
    }
    
    public function forecast() {
        $session = $this->request->session();
        if ($this->request->is('ajax')) {
            $userID = $session->read('Auth.User.id');
            $data = $this->request->data;
            if (!empty($data['location'])) {
                $location = explode(',', $data['location']);
                $data['latitude'] = floatval($location[0]);
                $data['longitude'] = floatval($location[1]);
            } 
            if (isset($data['weather_event_id'])) {
                $weatherEventID = $data['weather_event_id'];
            } else {
                $weatherEventID = null;
            }
            if (!empty($data['forecast_date'])) {
                if (isset($data['am_pm'])) {
                    $dateStart = strtotime($data['forecast_date']); //conver Month, #Day #Year format to unix time 
                    if ($data['am_pm']) {
                        $dateStart = $dateStart + 43200; //if PM then move start time to noon
                    }
                    $dateEnd = $dateStart + 43200; //add 12 hours in seconds to unix representation of forecast start
                    $data['forecast_date_start'] = $forecastDateStart;
                    $data['forecast_date_end'] = $forecastDateEnd;
                    $data['submit_date'] = Time::now();
                }
            }
            $table = $this->Forecasts;
            //Look if user and weather event combo already exists in Forecasts
            if ($query = $table->find('all')->where(['user_id' => $userID, 'weather_event_id' => $weatherEventID])->first()) {
                $result = $query;            
            } else { //If doesn't exist, create new   
                $result = $table->newEntity();
                $result->user_id = $userID;
            }
            $table->patchEntity($result, $data);
            if($result->errors()){
                $error_msg = [];
                foreach( $result->errors() as $errors){
                    if(is_array($errors)){
                        foreach($errors as $error){
                            $error_msg[] = $error;
                        }
                    }else{
                        $error_msg[] = $errors;
                    }
                }
            }
            if ($this->Forecasts->save($result)) {
                $statistics = TableRegistry::get('Statistics');
                if ($statistic = $statistics->find()->where(['user_id' => $userID])->first()) {
                    $statistic->active = 1;
                } else {
                    $statistic = $statistics->newEntity();
                    $statistic->user_id = $userID;
                    $statistic->current_streak = 0;
                    $statistic->highest_streak = 0;
                    $statistic->active = 1;
                }
                $statistics->save($statistic);
                $url = Router::url(['controller' => '/'], TRUE);
                $session->write('successBox', 'Forecast saved!');
                echo json_encode(['msg' => 'Forecast saved!', 'result' => 1, 'regLog' => 1, 'url' => $url]);
            } else {
                echo json_encode(['msg' => $error_msg, 'result' => 0, 'regLog' => 0]);
            }
            die;
        }
    }
    
    public function locker() { //Takes Forecasts that have locked in and moves them to HistoricalForecasts
        $deleter = 1;
        $lock = Time::now('+12 hours'); //Get an instance of the current time + 12 hours
        $query = $this->Forecasts->find()->where(['forecast_date_start <=' => $lock]); //find all forecasts starting in the next 12 hours
        $forecastHistory = TableRegistry::get('HistoricalForecasts');
        if ($query->toArray()) {
            foreach ($query as $row) {
                $submitted = $row['submit_date'];
                $interval = $submitted->diffInHours($row['forecast_date_start']);
                ($interval < 12) ? $interval = 12 : '';
                $row['forecast_length'] = $interval;
                $history = $forecastHistory->newEntity($row->toArray());
                if (!$result = $forecastHistory->save($history)) {
                    $deleter = 0;   
                }
            }
        }
        if ($deleter) {
            $this->Forecasts->deleteAll(['forecast_date_start <=' => $lock]); //delete all transferred forecasts
        }
    }
    
    public function beforeFilter(Event $event){
        $this->Auth->allow();
    }
}
