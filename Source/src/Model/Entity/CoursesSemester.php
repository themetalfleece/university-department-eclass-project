<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CoursesSemester Entity
 *
 * @property int $id
 * @property int $semester_id
 * @property int $course_id
 * @property int $subscribed_users_count
 * @property float $rating
 *
 * @property \App\Model\Entity\Semester $semester
 * @property \App\Model\Entity\Course $course
 */
class CoursesSemester extends Entity
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
