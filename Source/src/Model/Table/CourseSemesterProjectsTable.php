<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseSemesterProjects Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CoursesSemesters
 *
 * @method \App\Model\Entity\CourseSemesterProject get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseSemesterProject newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseSemesterProject[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseSemesterProject|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseSemesterProject patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseSemesterProject[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseSemesterProject findOrCreate($search, callable $callback = null)
 */
class CourseSemesterProjectsTable extends Table
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

        $this->table('course_semester_projects');
        $this->displayField('id');
        $this->primaryKey('id');

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

        $validator
            ->dateTime('assign_date')
            ->requirePresence('assign_date', 'create')
            ->notEmpty('assign_date');

        $validator
            ->dateTime('due_date')
            ->requirePresence('due_date', 'create')
            ->notEmpty('due_date');

        $validator
            ->requirePresence('text', 'create')
            ->notEmpty('text');

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
        $rules->add($rules->existsIn(['course_semester_id'], 'CoursesSemesters'));

        return $rules;
    }
}
