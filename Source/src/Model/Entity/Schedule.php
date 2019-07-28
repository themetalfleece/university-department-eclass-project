<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Schedule Entity
 *
 * @property int $id
 * @property int $classroom_id
 * @property int $course_semester_id
 * @property int $day
 * @property \Cake\I18n\Time $hour
 * @property int $professor_id
 *
 * @property \App\Model\Entity\Classroom $classroom
 * @property \App\Model\Entity\CoursesSemester $courses_semester
 * @property \App\Model\Entity\Professor $professor
 * @property \App\Model\Entity\ScheduleOverride[] $schedule_overrides
 */
class Schedule extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
