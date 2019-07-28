<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CoursesSemesters Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Semesters
 * @property \Cake\ORM\Association\BelongsTo $Courses
 *
 * @method \App\Model\Entity\CoursesSemester get($primaryKey, $options = [])
 * @method \App\Model\Entity\CoursesSemester newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CoursesSemester[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CoursesSemester|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CoursesSemester patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CoursesSemester[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CoursesSemester findOrCreate($search, callable $callback = null)
 */
class CoursesSemestersTable extends Table
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

        $this->table('courses_semesters');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('CourseSemesterClassrooms', [
            'foreignKey' => 'course_semester_id',
            'joinType' => 'INNER',
            'dependent' => true
        ]);
        $this->hasMany('CourseSemesterProfessors', [
            'foreignKey' => 'course_semester_id',
            'joinType' => 'INNER',
            'dependent' => true
        ]);
        $this->hasMany('CourseSemesterProjects', [
            'foreignKey' => 'course_semester_id',
            'joinType' => 'INNER',
            'dependent' => true
        ]);
        
        $this->hasMany('CourseSemesterReviews', [
            'foreignKey' => 'course_semester_id',
            'joinType' => 'INNER',
            'dependent' => true
        ]);

        $this->hasMany('Schedules', [
            'foreignKey' => 'course_semester_id',
            'joinType' => 'INNER',
            'dependent' => true
        ]);

        $this->belongsTo('Semesters', [
            'foreignKey' => 'semester_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CoursesStudents', [
            'foreignKey' => 'course_id',
            'bindingKey' => 'course_id',
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
            ->integer('subscribed_users_count')
            ->requirePresence('subscribed_users_count', 'create')
            ->notEmpty('subscribed_users_count');

        $validator
            ->numeric('rating')
            ->allowEmpty('rating');

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
        $rules->add($rules->existsIn(['semester_id'], 'Semesters'));
        $rules->add($rules->existsIn(['course_id'], 'Courses'));

        return $rules;
    }
}
