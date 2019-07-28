<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudyGuidesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudyGuidesTable Test Case
 */
class StudyGuidesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudyGuidesTable
     */
    public $StudyGuides;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('StudyGuides') ? [] : ['className' => 'App\Model\Table\StudyGuidesTable'];
        $this->StudyGuides = TableRegistry::get('StudyGuides', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudyGuides);

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
