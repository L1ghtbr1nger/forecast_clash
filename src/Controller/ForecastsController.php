<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Error\Debugger;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

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

    /**
     * View method
     *
     * @param string|null $id Forecast id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $forecast = $this->Forecasts->get($id, [
            'contain' => ['Users', 'WeatherEvents']
        ]);

        $this->set('forecast', $forecast);
        $this->set('_serialize', ['forecast']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $forecast = $this->Forecasts->newEntity();
        if ($this->request->is('post')) {
            $forecast = $this->Forecasts->patchEntity($forecast, $this->request->data);
            if ($this->Forecasts->save($forecast)) {
                $this->Flash->success(__('The forecast has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The forecast could not be saved. Please, try again.'));
            }
        }
        $users = $this->Forecasts->Users->find('list', ['limit' => 200]);
        $weatherEvents = $this->Forecasts->WeatherEvents->find('list', ['limit' => 200]);
        $this->set(compact('forecast', 'users', 'weatherEvents'));
        $this->set('_serialize', ['forecast']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Forecast id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $forecast = $this->Forecasts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $forecast = $this->Forecasts->patchEntity($forecast, $this->request->data);
            if ($this->Forecasts->save($forecast)) {
                $this->Flash->success(__('The forecast has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The forecast could not be saved. Please, try again.'));
            }
        }
        $users = $this->Forecasts->Users->find('list', ['limit' => 200]);
        $weatherEvents = $this->Forecasts->WeatherEvents->find('list', ['limit' => 200]);
        $this->set(compact('forecast', 'users', 'weatherEvents'));
        $this->set('_serialize', ['forecast']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Forecast id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $forecast = $this->Forecasts->get($id);
        if ($this->Forecasts->delete($forecast)) {
            $this->Flash->success(__('The forecast has been deleted.'));
        } else {
            $this->Flash->error(__('The forecast could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function forecast() {
        if ($this->request->is('ajax')) {
            $user = $this->request->session()->read('User.id');
            $data = $this->request->data;
            $location = explode(',', $data['location']);
            $lat = floatval($location[0]);
            $lon = floatval($location[1]);
            $table = $this->Forecasts;
            //Look if user and weather event combo already exists in Forecasts
            if ($query = $table->find('all')->where(['user_id' => $user, 'weather_event_id' => $data['weather_event_id']])->first()) {
                $result = $query;
            //If doesn't exist, create new   
            } else {
                $result = $table->newEntity();
                $result->user_id = $user;
                $result->weather_event_id = $data['weather_event_id'];
            }   
            $result->latitude = $lat;
            $result->longitude = $lon;
            $result->forecast_date = $data['forecast_date'];
            $result->am_pm = $data['am_pm'];
            $result->radius = 50;//$data['radius'];
            if ($this->Forecasts->save($result)) {
                $statistics = TableRegistry::get('Statistics');
                if ($statistic = $statistics->find()->where(['user_id' => $user])->first()) {
                    $statistic->active = 1;
                } else {
                    $statistic = $statistics->newEntity();
                    $statistic->user_id = $user;
                    $statistic->current_streak = 0;
                    $statistic->highest_streak = 0;
                    $statistic->active = 1;
                }
                $statistics->save($statistic);
                echo json_encode(['msg' => 'Forecast saved!', 'result' => 1, 'regLog' => 1]);
            } else {
                echo json_encode(['msg' => 'We were unable to save your forecast at this time. Please try again.', 'result' => 0, 'regLog' => 1]);
            }
            die;
        }
    }
    
    //Cron function that checks for forecasts that are within 12 hours of the current time and locks them in.
    //Also sends locked records to HistoricalforecastsController to be saved to HistoricalForecasts
    public function locker() {
        $result;
        //Different formats of the current time for different calculations and comparisons
        $now = Time::now();
        $timeNow = intval($now->i18nFormat('HH'));
        $dateNow = $now->i18nFormat('yyyy-MM-dd');
        $dateForecast = $dateNow.'-12';
        $dateForecast = new Time($dateForecast.'-12');
        $dateNext = new Time('+1 day');
        $dateNext = $dateNext->i18nFormat('yyyy-MM-dd');
        $dateNextForecast = $dateNext.'-00';
        $dateNextForecast = new Time($dateNextForecast);
        if ($timeNow < 12) {
            $query = $this->Forecasts->find()->where(['forecast_date' => $dateNow, 'am_pm' => 1]);
            $this->transferHistory($dateForecast,$query);
          //  $this->Forecasts->deleteAll(['forecast_date' => $dateNow, 'am_pm' => 1]);
        } else {
            $query = $this->Forecasts->find()->where(['forecast_date' => $dateNext, 'am_pm' => 0]);
            $this->transferHistory($dateNextForecast,$query);
          //  $this->Forecasts->deleteAll(['forecast_date' => $dateNext, 'am_pm' => 0]);
        }
        die;
    }
    
    public function transferHistory($date,$query) {
        $forecastHistory = TableRegistry::get('HistoricalForecasts');
        if ($query->toArray()) {
            //Move the contents of each row of the Forecasts table that have locked into the HistoricalForecasts table. Remove extra columns, fill in forecast length column after calculating. 
            foreach ($query as $row) {
                $history = $forecastHistory->newEntity();
                $submitted = $row['submit_date'];
                $submitted = $submitted->i18nFormat('yyyy-MM-dd-HH');
                $submitted = new Time($submitted);
                $interval = $submitted->diff($date);
                $intervalDays = intval($interval->format('%a'));
                $intervalHours = intval($interval->format('%H'));
                $intervalHours += $intervalDays * 24;
                ($intervalHours < 12) ? $intervalHours = 12 : '';
                $forecastLength = $intervalHours;
                $history->user_id = $row['user_id'];
                $history->latitude = $row['latitude'];
                $history->longitude = $row['longitude'];
                $history->iso = $row['iso'];
                $history->radius = $row['radius'];
                $history->weather_event_id = $row['weather_event_id'];
                $history->forecast_date = $row['forecast_date'];
                $history->am_pm = $row['am_pm'];
                $history->forecast_length = $forecastLength;
                debug($history);
                $result = $forecastHistory->save($history);
                return;
            }
        }
        return;
    }
    
    public function beforeFilter(Event $event){
        $this->Auth->allow();
    }
}
