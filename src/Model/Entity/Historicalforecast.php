<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Historicalforecast Entity
 *
 * @property int $id
 * @property int $user_id
 * @property float $latitude
 * @property float $longitude
 * @property int $radius
 * @property int $weather_event_id
 * @property \Cake\I18n\Time $forecast_date
 * @property bool $am_pm
 * @property int $forecast_length
 * @property int $admin_event_id
 * @property bool $correct
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Weatherevent $weather_event
 * @property \App\Model\Entity\Adminevent $admin_event
 */
class Historicalforecast extends Entity
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
