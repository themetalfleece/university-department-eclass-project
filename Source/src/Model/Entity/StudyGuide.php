<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudyGuide Entity
 *
 * @property int $id
 * @property int $semester_id
 * @property string $level
 * @property string $info
 * @property string $ruling
 *
 * @property \App\Model\Entity\Semester $semester
 * @property \App\Model\Entity\Course[] $courses
 */
class StudyGuide extends Entity
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
