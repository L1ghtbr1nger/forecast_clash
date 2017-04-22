<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class LockerShell extends Shell
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Forecasts');
    }
    
    public function main() { //Takes Forecasts that have locked in and moves them to HistoricalForecasts
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
}
?>