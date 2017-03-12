<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WeatherstatisticsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WeatherstatisticsTable Test Case
 */
class WeatherstatisticsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WeatherstatisticsTable
     */
    public $Weatherstatistics;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.weatherstatistics',
        'app.users',
        'app.social_profiles',
        'app.badges_users',
        'app.badges',
        'app.scores',
        'app.forecasts',
        'app.weather_events',
        'app.historical_forecasts',
        'app.admin_events',
        'app.profiles',
        'app.education_levels',
        'app.states',
        'app.states_users',
        'app.ages',
        'app.stats',
        'app.teams_users',
        'app.weather_statistics',
        'app.weekly_contest_forecasts',
        'app.weekly_scores'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Weatherstatistics') ? [] : ['className' => 'App\Model\Table\WeatherstatisticsTable'];
        $this->Weatherstatistics = TableRegistry::get('Weatherstatistics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Weatherstatistics);

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
