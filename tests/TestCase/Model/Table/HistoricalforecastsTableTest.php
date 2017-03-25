<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HistoricalForecastsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HistoricalForecastsTable Test Case
 */
class HistoricalForecastsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HistoricalForecastsTable
     */
    public $HistoricalForecasts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.historical_forecasts',
        'app.users',
        'app.social_profiles',
        'app.avatars',
        'app.forecasts',
        'app.weather_events',
        'app.weather_statistics',
        'app.scores',
        'app.teams_users',
        'app.teams',
        'app.notifications',
        'app.profiles',
        'app.education_levels',
        'app.states',
        'app.states_users',
        'app.ages',
        'app.statistics',
        'app.weekly_contest_forecasts',
        'app.badges',
        'app.badges_users',
        'app.admin_events'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('HistoricalForecasts') ? [] : ['className' => 'App\Model\Table\HistoricalForecastsTable'];
        $this->HistoricalForecasts = TableRegistry::get('HistoricalForecasts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HistoricalForecasts);

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
