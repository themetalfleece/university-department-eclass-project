<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScheduleOverridesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ScheduleOverridesTable Test Case
 */
class ScheduleOverridesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ScheduleOverridesTable
     */
    public $ScheduleOverrides;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.schedule_overrides',
        'app.schedules',
        'app.classrooms',
        'app.course_semester_classrooms',
        'app.courses_semesters',
        'app.semesters',
        'app.study_guides',
        'app.courses',
        'app.sectors',
        'app.course_links',
        'app.course_links_categories',
        'app.courses_recommended_books',
        'app.books',
        'app.students',
        'app.users',
        'app.professors',
        'app.course_semester_professors',
        'app.professor_publications',
        'app.professor_visit_hours',
        'app.user_emails',
        'app.user_phones',
        'app.courses_students',
        'app.courses_study_guides'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ScheduleOverrides') ? [] : ['className' => 'App\Model\Table\ScheduleOverridesTable'];
        $this->ScheduleOverrides = TableRegistry::get('ScheduleOverrides', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ScheduleOverrides);

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
