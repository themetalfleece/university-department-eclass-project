<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EctsSemesterTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EctsSemesterTable Test Case
 */
class EctsSemesterTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EctsSemesterTable
     */
    public $EctsSemester;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ects_semester'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EctsSemester') ? [] : ['className' => 'App\Model\Table\EctsSemesterTable'];
        $this->EctsSemester = TableRegistry::get('EctsSemester', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EctsSemester);

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
