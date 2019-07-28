<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProfessorPublication Entity
 *
 * @property int $id
 * @property int $professor_id
 * @property string $name
 * @property string $url
 * @property int $reference_count
 *
 * @property \App\Model\Entity\Professor $professor
 */
class ProfessorPublication extends Entity
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
