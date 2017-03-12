<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ScoresController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ScoresController Test Case
 */
class ScoresControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.scores',
        'app.users',
        'app.social_profiles',
        'app.badges_users',
        'app.badges',
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
