<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StatesUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StatesUsersTable Test Case
 */
class StatesUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StatesUsersTable
     */
    public $StatesUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.states_users',
        'app.users',
        'app.states',
        'app.profiles',
        'app.education_levels',
        'app.ages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StatesUsers') ? [] : ['className' => 'App\Model\Table\StatesUsersTable'];
        $this->StatesUsers = TableRegistry::get('StatesUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StatesUsers);

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
