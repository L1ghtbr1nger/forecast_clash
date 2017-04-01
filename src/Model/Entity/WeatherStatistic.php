<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WeatherStatistic Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $weather_event_id
 * @property int $valid_attempts
 * @property int $attempts
 * @property int $radius
 * @property int $forecast_length
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\WeatherEvent $weather_event
 */
class WeatherStatistic extends Entity
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
