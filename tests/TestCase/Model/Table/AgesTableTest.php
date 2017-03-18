<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AgesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AgesTable Test Case
 */
class AgesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AgesTable
     */
    public $Ages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ages',
        'app.profiles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Ages') ? [] : ['className' => 'App\Model\Table\AgesTable'];
        $this->Ages = TableRegistry::get('Ages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ages);

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
