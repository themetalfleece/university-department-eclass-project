<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourseLinksCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourseLinksCategoriesTable Test Case
 */
class CourseLinksCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourseLinksCategoriesTable
     */
    public $CourseLinksCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_links_categories',
        'app.course_links',
        'app.courses',
        'app.sectors',
        'app.courses_recommended_books',
        'app.books',
        'app.semesters',
        'app.study_guides',
        'app.courses_study_guides',
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
        $config = TableRegistry::exists('CourseLinksCategories') ? [] : ['className' => 'App\Model\Table\CourseLinksCategoriesTable'];
        $this->CourseLinksCategories = TableRegistry::get('CourseLinksCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourseLinksCategories);

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
