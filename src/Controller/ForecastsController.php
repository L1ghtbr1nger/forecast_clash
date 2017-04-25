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
                $dateStart = strtotime($data['forecast_date']); //convert Month, #Day #Year format to unix time 
                $dateEnd = $dateStart + 43199; //add 12 hours in seconds to unix representation of forecast start
                $data['forecast_date_start'] = Time::parse($dateStart)->i18nFormat('yyyy-MM-dd HH:mm:ss');
                $data['forecast_date_end'] = Time::parse($dateEnd)->i18nFormat('yyyy-MM-dd HH:mm:ss');
                $data['submit_date'] = Time::now();
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
        } else {
            $pendingLocations = [];
            $pendingRadius = [];
            $pendingEvents = [];
            $pendingDates = [];
            $activeLocations = [];
            $activeRadius = [];
            $activeEvents = [];
            $activeDates = [];
            if ($userID = $session->read('Auth.User.id')) {
                if($forecasts = $this->Forecasts->find('all')->where(['user_id' => $userID])->contain('WeatherEvents')) {
                    foreach ($forecasts as $forecast) {
                        $pendingLocations[] = [$forecast['latitude'], $forecast['longitude']];
                        $pendingRadius[] = $forecast['radius'];
                        $pendingEvents[] = $forecast['weather_event']['weather'];
                        $pendingDates[] = $forecast['forecast_date_start']->i18nFormat('MMMM d, H:mm');
                    }
                }
                if($historical = TableRegistry::get('HistoricalForecasts')->find('all')->where(['user_id' => $userID, 'correct IS NULL'])->contain('WeatherEvents')) {
                    foreach ($historical as $history) {
                        $activeLocations[] = [$history['latitude'], $history['longitude']];
                        $activeRadius[] = $history['radius'];
                        $activeEvents[] = $history['weather_event']['weather'];
                        $activeDates[] = $history['forecast_date_start']->i18nFormat('MMMM d, H:mm');
                    }
                }
            }
            $this->set('pendingLocations', $pendingLocations);
            $this->set('pendingRadius', $pendingRadius);
            $this->set('pendingEvents', $pendingEvents);
            $this->set('pendingDates', $pendingDates);
            $this->set('activeLocations', $activeLocations);
            $this->set('activeRadius', $activeRadius);
            $this->set('activeEvents', $activeEvents);
            $this->set('activeDates', $activeDates);
        }
    }
    
    public function locker() { //Takes Forecasts that have locked in and moves them to HistoricalForecasts
        $deleter = 1;
        $lock = Time::now(); //Get an instance of the current time
        $query = $this->Forecasts->find()->where(['forecast_date_start <=' => $lock]); //find all forecasts that just started
        $forecastHistory = TableRegistry::get('HistoricalForecasts');
        if ($query->toArray()) {
            foreach ($query as $row) {
                $submitted = $row['submit_date'];
                $interval = $submitted->diffInHours($row['forecast_date_start']);
                $row['forecast_length'] = $interval;
                $history = $forecastHistory->newEntity($row->toArray());
                if ($result = $forecastHistory->save($history)) {
                    $entity = $this->Forecasts->get($row['id']);
                    $this->Forecasts->delete($entity);
                }
            }
        }
    }
    
    public function beforeFilter(Event $event){
        $this->Auth->allow();
    }
}
