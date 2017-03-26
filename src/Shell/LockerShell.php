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
}
?>