<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Professor Entity
 *
 * @property int $id
 * @property string $title
 * @property string $bio
 * @property int $user_id
 * @property string $office_location
 * @property bool $active
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\CourseSemesterProfessor[] $course_semester_professors
 * @property \App\Model\Entity\ProfessorPublication[] $professor_publications
 * @property \App\Model\Entity\ProfessorVisitHour[] $professor_visit_hours
 * @property \App\Model\Entity\Schedule[] $schedules
 */
class Professor extends Entity
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
