<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CourseSemesterReview Entity
 *
 * @property int $id
 * @property int $course_semester_id
 * @property int $rating_stars
 * @property string $rating_text
 * @property bool $approved
 *
 * @property \App\Model\Entity\CoursesSemester $courses_semester
 */
class CourseSemesterReview extends Entity
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
