<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CourseSemesterProfessorsFixture
 *
 */
class CourseSemesterProfessorsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'course_semester_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'professor_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'course_semester_professors_fk0' => ['type' => 'index', 'columns' => ['course_semester_id'], 'length' => []],
            'course_semester_professors_fk1' => ['type' => 'index', 'columns' => ['professor_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'course_semester_professors_fk0' => ['type' => 'foreign', 'columns' => ['course_semester_id'], 'references' => ['courses_semesters', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'course_semester_professors_fk1' => ['type' => 'foreign', 'columns' => ['professor_id'], 'references' => ['professors', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'course_semester_id' => 1,
            'professor_id' => 1
        ],
    ];
}
