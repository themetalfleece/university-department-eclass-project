<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseSemesterProfessors Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CoursesSemesters
 * @property \Cake\ORM\Association\BelongsTo $Professors
 *
 * @method \App\Model\Entity\CourseSemesterProfessor get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseSemesterProfessor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseSemesterProfessor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseSemesterProfessor|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseSemesterProfessor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseSemesterProfessor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseSemesterProfessor findOrCreate($search, callable $callback = null)
 */
class CourseSemesterProfessorsTable extends Table
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

        $this->table('course_semester_professors');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CoursesSemesters', [
            'foreignKey' => 'course_semester_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Professors', [
            'foreignKey' => 'professor_id',
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
        $rules->add($rules->existsIn(['course_semester_id'], 'CoursesSemesters'));
        $rules->add($rules->existsIn(['professor_id'], 'Professors'));

        return $rules;
    }
}
