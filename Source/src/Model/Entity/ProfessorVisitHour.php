<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProfessorVisitHour Entity
 *
 * @property int $id
 * @property int $professor_id
 * @property int $day
 * @property \Cake\I18n\Time $hour_start
 * @property \Cake\I18n\Time $hour_end
 *
 * @property \App\Model\Entity\Professor $professor
 */
class ProfessorVisitHour extends Entity
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
