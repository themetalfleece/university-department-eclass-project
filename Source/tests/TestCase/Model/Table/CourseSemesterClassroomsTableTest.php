<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourseSemesterClassroomsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourseSemesterClassroomsTable Test Case
 */
class CourseSemesterClassroomsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourseSemesterClassroomsTable
     */
    public $CourseSemesterClassrooms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_semester_classrooms',
        'app.classrooms',
        'app.schedules',
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
        'app.courses_study_guides',
        'app.schedule_overrides'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CourseSemesterClassrooms') ? [] : ['className' => 'App\Model\Table\CourseSemesterClassroomsTable'];
        $this->CourseSemesterClassrooms = TableRegistry::get('CourseSemesterClassrooms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourseSemesterClassrooms);

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
