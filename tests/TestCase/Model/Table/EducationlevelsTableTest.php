<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EducationLevelsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EducationLevelsTable Test Case
 */
class EducationLevelsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EducationLevelsTable
     */
    public $EducationLevels;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.education_levels',
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
        $config = TableRegistry::exists('EducationLevels') ? [] : ['className' => 'App\Model\Table\EducationLevelsTable'];
        $this->EducationLevels = TableRegistry::get('EducationLevels', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EducationLevels);

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
