<?php
namespace App\Test\TestCase\Controller;

use App\Controller\UserPhonesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\UserPhonesController Test Case
 */
class UserPhonesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_phones',
        'app.users',
        'app.professors',
        'app.course_semester_professors',
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
        'app.courses_students',
        'app.courses_study_guides',
        'app.professor_publications',
        'app.professor_visit_hours',
        'app.schedules',
        'app.classrooms',
        'app.course_semester_classrooms',
        'app.schedule_overrides',
        'app.user_emails'
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