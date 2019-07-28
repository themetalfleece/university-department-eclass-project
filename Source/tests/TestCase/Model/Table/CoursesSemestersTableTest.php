<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CoursesSemestersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CoursesSemestersTable Test Case
 */
class CoursesSemestersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CoursesSemestersTable
     */
    public $CoursesSemesters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        'app.schedules',
        'app.classrooms',
        'app.course_semester_classrooms',
        'app.schedule_overrides',
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
        $config = TableRegistry::exists('CoursesSemesters') ? [] : ['className' => 'App\Model\Table\CoursesSemestersTable'];
        $this->CoursesSemesters = TableRegistry::get('CoursesSemesters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CoursesSemesters);

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
