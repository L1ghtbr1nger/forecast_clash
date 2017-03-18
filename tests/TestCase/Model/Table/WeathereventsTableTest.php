<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WeatherEventsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WeatherEventsTable Test Case
 */
class WeatherEventsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WeatherEventsTable
     */
    public $WeatherEvents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.weather_events',
        'app.forecasts',
        'app.users',
        'app.avatars',
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
        'app.weather_statistics',
        'app.weekly_contest_forecasts',
        'app.badges',
        'app.badges_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('WeatherEvents') ? [] : ['className' => 'App\Model\Table\WeatherEventsTable'];
        $this->WeatherEvents = TableRegistry::get('WeatherEvents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WeatherEvents);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
