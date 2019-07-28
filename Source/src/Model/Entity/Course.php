<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Course Entity
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @property string $description
 * @property string $type
 * @property string $level
 * @property int $semester
 * @property string $official_url
 * @property string $eclass_url
 * @property int $ects
 * @property string $exam_means
 * @property float $gravity
 * @property int $sector_id
 *
 * @property \App\Model\Entity\Sector $sector
 * @property \App\Model\Entity\CourseLink[] $course_links
 * @property \App\Model\Entity\CoursesRecommendedBook[] $courses_recommended_books
 * @property \App\Model\Entity\Course[] $courses
 * @property \App\Model\Entity\Semester[] $semesters
 * @property \App\Model\Entity\Student[] $students
 * @property \App\Model\Entity\StudyGuide[] $study_guides
 */
class Course extends Entity
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
