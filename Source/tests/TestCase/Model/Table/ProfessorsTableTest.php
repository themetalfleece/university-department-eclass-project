<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProfessorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProfessorsTable Test Case
 */
class ProfessorsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProfessorsTable
     */
    public $Professors;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        'app.courses_semesters',
        'app.courses_students',
        'app.user_emails',
        'app.user_phones',
        'app.course_semester_professors',
        'app.professor_publications',
        'app.professor_visit_hours',
        'app.schedules',
        'app.classrooms',
        'app.course_semester_classrooms',
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
        $config = TableRegistry::exists('Professors') ? [] : ['className' => 'App\Model\Table\ProfessorsTable'];
        $this->Professors = TableRegistry::get('Professors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Professors);

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
