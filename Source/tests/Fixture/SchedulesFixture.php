<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SchedulesFixture
 *
 */
class SchedulesFixture extends TestFixture
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
        'day' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'hour' => ['type' => 'time', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'professor_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'schedules_fk0' => ['type' => 'index', 'columns' => ['classroom_id'], 'length' => []],
            'schedules_fk1' => ['type' => 'index', 'columns' => ['course_semester_id'], 'length' => []],
            'schedules_fk2' => ['type' => 'index', 'columns' => ['professor_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'schedules_fk0' => ['type' => 'foreign', 'columns' => ['classroom_id'], 'references' => ['classrooms', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'schedules_fk1' => ['type' => 'foreign', 'columns' => ['course_semester_id'], 'references' => ['courses_semesters', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'schedules_fk2' => ['type' => 'foreign', 'columns' => ['professor_id'], 'references' => ['professors', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'course_semester_id' => 1,
            'day' => 1,
            'hour' => '22:23:33',
            'professor_id' => 1
        ],
    ];
}
