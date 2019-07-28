<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CoursesStudent Entity
 *
 * @property int $id
 * @property int $course_id
 * @property int $student_id
 * @property string $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Course $course
 * @property \App\Model\Entity\Student $student
 */
class CoursesStudent extends Entity
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
