<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TeamsusersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TeamsusersTable Test Case
 */
class TeamsusersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TeamsusersTable
     */
    public $Teamsusers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.teamsusers',
        'app.users',
        'app.social_profiles',
        'app.badges_users',
        'app.badges',
        'app.scores',
        'app.weather_statistics',
        'app.weather_events',
        'app.forecasts',
        'app.historical_forecasts',
        'app.admin_events',
        'app.profiles',
        'app.education_levels',
        'app.states',
        'app.states_users',
        'app.ages',
        'app.stats',
        'app.teams_users',
        'app.teams',
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
        $config = TableRegistry::exists('Teamsusers') ? [] : ['className' => 'App\Model\Table\TeamsusersTable'];
        $this->Teamsusers = TableRegistry::get('Teamsusers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Teamsusers);

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
