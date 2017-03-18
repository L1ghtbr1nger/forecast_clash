<?php
namespace App\Test\TestCase\Controller;

use App\Controller\WeatherStatisticsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\WeatherStatisticsController Test Case
 */
class WeatherStatisticsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.weather_statistics',
        'app.users',
        'app.avatars',
        'app.forecasts',
        'app.weather_events',
        'app.historical_forecasts',
        'app.admin_events',
        'app.notifications',
        'app.profiles',
        'app.education_levels',
        'app.states',
        'app.states_users',
        'app.ages',
        'app.scores',
        'app.social_profiles',
        'app.statistics',
        'app.teams',
        'app.teams_users',
        'app.weekly_contest_forecasts',
        'app.badges',
        'app.badges_users'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
