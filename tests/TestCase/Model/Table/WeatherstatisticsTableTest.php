<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WeatherStatisticsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WeatherStatisticsTable Test Case
 */
class WeatherStatisticsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WeatherStatisticsTable
     */
    public $WeatherStatistics;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('WeatherStatistics') ? [] : ['className' => 'App\Model\Table\WeatherStatisticsTable'];
        $this->WeatherStatistics = TableRegistry::get('WeatherStatistics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WeatherStatistics);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
