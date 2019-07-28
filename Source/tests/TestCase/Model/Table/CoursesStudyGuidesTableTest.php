<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CoursesStudyGuidesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CoursesStudyGuidesTable Test Case
 */
class CoursesStudyGuidesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CoursesStudyGuidesTable
     */
    public $CoursesStudyGuides;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.courses_study_guides',
        'app.study_guides',
        'app.semesters',
        'app.courses',
        'app.sectors',
        'app.course_links',
        'app.course_links_categories',
        'app.courses_recommended_books',
        'app.books',
        'app.courses_semesters',
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
        'app.courses_students'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CoursesStudyGuides') ? [] : ['className' => 'App\Model\Table\CoursesStudyGuidesTable'];
        $this->CoursesStudyGuides = TableRegistry::get('CoursesStudyGuides', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CoursesStudyGuides);

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
