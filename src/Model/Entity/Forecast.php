<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Forecast Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $weather_event_id
 * @property \Cake\I18n\Time $submit_date
 * @property \Cake\I18n\Time $forecast_date_start
 * @property \Cake\I18n\Time $forecast_date_end
 * @property int $radius
 * @property float $latitude
 * @property float $longitude
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\WeatherEvent $weather_event
 */
class Forecast extends Entity
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
