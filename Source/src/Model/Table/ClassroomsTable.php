<?php
namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Classrooms Model
 *
 * @property \Cake\ORM\Association\HasMany $CourseSemesterClassrooms
 * @property \Cake\ORM\Association\HasMany $Schedules
 *
 * @method \App\Model\Entity\Classroom get($primaryKey, $options = [])
 * @method \App\Model\Entity\Classroom newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Classroom[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Classroom|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Classroom patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Classroom[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Classroom findOrCreate($search, callable $callback = null)
 */
class ClassroomsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('classrooms');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('CourseSemesterClassrooms', [
            'foreignKey' => 'classroom_id'
        ]);
        $this->hasMany('Schedules', [
            'foreignKey' => 'classroom_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('type', 'create')
            ->notEmpty('type')
            ->add('type', 'inList', [
                'rule' => ['inList', Configure::read('classroom.types')],
                'message' => __('Ο τύπος αίθουσας διδασκαλίας δεν είναι έγκυρος')
            ]);

        return $validator;
    }
}
