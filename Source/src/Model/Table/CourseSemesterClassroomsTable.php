<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseSemesterClassrooms Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Classrooms
 * @property \Cake\ORM\Association\BelongsTo $CoursesSemesters
 *
 * @method \App\Model\Entity\CourseSemesterClassroom get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseSemesterClassroom newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseSemesterClassroom[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseSemesterClassroom|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseSemesterClassroom patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseSemesterClassroom[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseSemesterClassroom findOrCreate($search, callable $callback = null)
 */
class CourseSemesterClassroomsTable extends Table
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

        $this->table('course_semester_classrooms');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Classrooms', [
            'foreignKey' => 'classroom_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CoursesSemesters', [
            'foreignKey' => 'course_semester_id',
            'joinType' => 'INNER'
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

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['classroom_id'], 'Classrooms'));
        $rules->add($rules->existsIn(['course_semester_id'], 'CoursesSemesters'));

        return $rules;
    }
}
