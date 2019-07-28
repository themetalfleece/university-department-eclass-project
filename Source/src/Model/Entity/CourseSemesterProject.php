<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CourseSemesterProject Entity
 *
 * @property int $id
 * @property int $course_semester_id
 * @property \Cake\I18n\Time $assign_date
 * @property \Cake\I18n\Time $due_date
 * @property string $text
 *
 * @property \App\Model\Entity\CoursesSemester $courses_semester
 */
class CourseSemesterProject extends Entity
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
