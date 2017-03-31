<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WeatherEvent Entity
 *
 * @property int $id
 * @property string $weather
 *
 * @property \App\Model\Entity\Forecast[] $forecasts
 * @property \App\Model\Entity\HistoricalForecast[] $historical_forecasts
 * @property \App\Model\Entity\WeatherStatistic[] $weather_statistics
 */
class WeatherEvent extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
