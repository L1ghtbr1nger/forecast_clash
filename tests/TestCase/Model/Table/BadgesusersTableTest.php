<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BadgesUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BadgesUsersTable Test Case
 */
class BadgesUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BadgesUsersTable
     */
    public $BadgesUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.badges_users',
        'app.users',
        'app.badges'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('BadgesUsers') ? [] : ['className' => 'App\Model\Table\BadgesUsersTable'];
        $this->BadgesUsers = TableRegistry::get('BadgesUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BadgesUsers);

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
