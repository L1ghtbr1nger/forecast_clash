<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property int $avatar_id
 * @property bool $meteorologist
 * @property \Cake\I18n\Time $date_created
 * @property string $password_reset_token
 * @property string $hashval
 *
 * @property \App\Model\Entity\Avatar $avatar
 * @property \App\Model\Entity\Forecast[] $forecasts
 * @property \App\Model\Entity\HistoricalForecast[] $historical_forecasts
 * @property \App\Model\Entity\Notification[] $notifications
 * @property \App\Model\Entity\Profile[] $profiles
 * @property \App\Model\Entity\Score[] $scores
 * @property \App\Model\Entity\SocialProfile[] $social_profiles
 * @property \App\Model\Entity\Statistic[] $statistics
 * @property \App\Model\Entity\Team[] $teams
 * @property \App\Model\Entity\WeatherStatistic[] $weather_statistics
 * @property \App\Model\Entity\WeeklyContestForecast[] $weekly_contest_forecasts
 * @property \App\Model\Entity\Badge[] $badges
 * @property \App\Model\Entity\State[] $states
 */
class User extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    
    protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }
}
