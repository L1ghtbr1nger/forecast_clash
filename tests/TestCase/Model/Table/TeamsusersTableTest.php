<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TeamsUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TeamsUsersTable Test Case
 */
class TeamsUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TeamsUsersTable
     */
    public $TeamsUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.teams_users',
        'app.users',
        'app.social_profiles',
        'app.avatars',
        'app.badges_users',
        'app.badges',
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
        'app.weather_statistics',
        'app.statistics',
        'app.teams',
        'app.weekly_contest_forecasts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TeamsUsers') ? [] : ['className' => 'App\Model\Table\TeamsUsersTable'];
        $this->TeamsUsers = TableRegistry::get('TeamsUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TeamsUsers);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
