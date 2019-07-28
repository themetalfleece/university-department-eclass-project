<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CourseSemesterClassroomsFixture
 *
 */
class CourseSemesterClassroomsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'classroom_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'course_semester_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'course_semester_classrooms_fk0' => ['type' => 'index', 'columns' => ['classroom_id'], 'length' => []],
            'course_semester_classrooms_fk1' => ['type' => 'index', 'columns' => ['course_semester_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'course_semester_classrooms_fk0' => ['type' => 'foreign', 'columns' => ['classroom_id'], 'references' => ['classrooms', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'course_semester_classrooms_fk1' => ['type' => 'foreign', 'columns' => ['course_semester_id'], 'references' => ['courses_semesters', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'classroom_id' => 1,
            'course_semester_id' => 1
        ],
    ];
}
