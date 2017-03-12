<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BadgesusersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BadgesusersTable Test Case
 */
class BadgesusersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BadgesusersTable
     */
    public $Badgesusers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.badgesusers',
        'app.users',
        'app.social_profiles',
        'app.badges_users',
        'app.badges',
        'app.final_scores',
        'app.hail_forecasts',
        'app.historical_forecasts',
        'app.profiles',
        'app.education_levels',
        'app.states',
        'app.states_users',
        'app.ages',
        'app.stats',
        'app.teams_users',
        'app.tornado_forecasts',
        'app.weekly_contest_forecasts',
        'app.weekly_scores',
        'app.wind_forecasts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Badgesusers') ? [] : ['className' => 'App\Model\Table\BadgesusersTable'];
        $this->Badgesusers = TableRegistry::get('Badgesusers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Badgesusers);

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
