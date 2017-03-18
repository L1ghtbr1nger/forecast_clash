<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdminEventsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdminEventsTable Test Case
 */
class AdminEventsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AdminEventsTable
     */
    public $AdminEvents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.admin_events',
        'app.historical_forecasts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AdminEvents') ? [] : ['className' => 'App\Model\Table\AdminEventsTable'];
        $this->AdminEvents = TableRegistry::get('AdminEvents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AdminEvents);

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
}
