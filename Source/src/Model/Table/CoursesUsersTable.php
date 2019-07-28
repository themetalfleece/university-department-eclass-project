<?php
namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CoursesUsers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Courses
 *
 * @method \App\Model\Entity\UsersCourse get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsersCourse newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UsersCourse[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersCourse|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersCourse patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsersCourse[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersCourse findOrCreate($search, callable $callback = null)
 */
class CoursesUsersTable extends Table
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

        $this->table('courses_users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
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
            ->requirePresence('status', 'create')
            ->add('role', 'inList', [
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['course_id'], 'Courses'));

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
