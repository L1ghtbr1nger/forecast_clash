<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForecastsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForecastsTable Test Case
 */
class ForecastsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ForecastsTable
     */
    public $Forecasts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.forecasts',
        'app.users',
        'app.social_profiles',
        'app.avatars',
        'app.historical_forecasts',
        'app.weather_events',
        'app.weather_statistics',
        'app.scores',
        'app.teams_users',
        'app.teams',
        'app.admin_events',
        'app.notifications',
        'app.profiles',
        'app.education_levels',
        'app.states',
        'app.states_users',
        'app.ages',
        'app.statistics',
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
        $config = TableRegistry::exists('Forecasts') ? [] : ['className' => 'App\Model\Table\ForecastsTable'];
        $this->Forecasts = TableRegistry::get('Forecasts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Forecasts);

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
