<?php
namespace App\Model\Table;

use App\Model\Entity\CoursesStudent;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CoursesStudents Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Courses
 * @property \Cake\ORM\Association\BelongsTo $Students
 *
 * @method \App\Model\Entity\CoursesStudent get($primaryKey, $options = [])
 * @method \App\Model\Entity\CoursesStudent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CoursesStudent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CoursesStudent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CoursesStudent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CoursesStudent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CoursesStudent findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CoursesStudentsTable extends Table
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

        $this->table('courses_students');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('CoursesSemesters', [
            'foreignKey' => 'course_id',
            'bindingKey' => 'course_id',
            'joinType' => 'INNER'
        ]);
        $this->addBehavior('CounterCache', [
            'Courses' => [
                'students_count' => [
                     'conditions' => ['CoursesStudents.status IN' => ['registered', 'attending']]
                ],
                'attending_students_count' => [
                     'conditions' => ['CoursesStudents.status' => 'attending']
                ]
            ]
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
            ->requirePresence('status', 'create')
            ->add('status', 'inList', [
                'rule' => ['inList', Configure::read('course.statuses')]
            ])
            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['course_id'], 'Courses'));
        $rules->add($rules->existsIn(['student_id'], 'Students'));

        return $rules;
    }

    public function findCoursesOf(Query $query, array $options) {
        if (!empty($options['where.contain'])) {
            return $query->where($options['where'])->contain(['Courses' => function ($q) use ($options) {
                return $q->where($options['where.contain']);
            }]);
        }
        return $query->where($options['where'])->contain(['Courses']);
    }

    public function findCoursesCountOf(Query $query, array $options) {
        return $query->where($options['where'])->count();
    }
}
