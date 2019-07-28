<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CoursesCourse Entity
 *
 * @property int $id
 * @property int $source_id
 * @property int $target_id
 * @property string $relationship_type
 *
 * @property \App\Model\Entity\Course $course
 */
class CoursesCourse extends Entity
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
