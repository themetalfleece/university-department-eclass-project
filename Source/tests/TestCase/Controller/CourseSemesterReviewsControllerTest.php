<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CourseSemesterReviewsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\CourseSemesterReviewsController Test Case
 */
class CourseSemesterReviewsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_semester_reviews',
        'app.courses_semesters',
        'app.course_semester_classrooms',
        'app.classrooms',
        'app.schedules',
        'app.professors',
        'app.users',
        'app.students',
        'app.courses',
        'app.sectors',
        'app.course_links',
        'app.course_links_categories',
        'app.courses_recommended_books',
        'app.books',
        'app.semesters',
        'app.study_guides',
        'app.courses_study_guides',
        'app.courses_students',
        'app.course_announcements',
        'app.user_emails',
        'app.user_phones',
        'app.course_semester_professors',
        'app.professor_publications',
        'app.professor_visit_hours',
        'app.schedule_overrides',
        'app.course_semester_projects'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
