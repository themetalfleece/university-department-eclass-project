<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserPhonesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserPhonesTable Test Case
 */
class UserPhonesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserPhonesTable
     */
    public $UserPhones;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserPhones') ? [] : ['className' => 'App\Model\Table\UserPhonesTable'];
        $this->UserPhones = TableRegistry::get('UserPhones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserPhones);

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
