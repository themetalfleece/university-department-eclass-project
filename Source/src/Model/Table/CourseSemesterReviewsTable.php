<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseSemesterReviews Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CoursesSemesters
 *
 * @method \App\Model\Entity\CourseSemesterReview get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseSemesterReview newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseSemesterReview[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseSemesterReview|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseSemesterReview patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseSemesterReview[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseSemesterReview findOrCreate($search, callable $callback = null)
 */
class CourseSemesterReviewsTable extends Table
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

        $this->table('course_semester_reviews');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('CoursesSemesters', [
            'foreignKey' => 'course_semester_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->integer('rating_stars')
            ->requirePresence('rating_stars', 'create')
            ->notEmpty('rating_stars', __('Δεν βαθμολογήσατε από το 1 έως το 5'))
            ->add('rating_stars', 'inList', [
                'rule' => ['inList', [1, 2, 3, 4, 5]],
                'message' => __('Η βαθμολογία πρέπει να είναι από 1 έως 5 αστέρια')
            ])
            ->add('rating_stars', 'custom_not_same_userid', [
                'rule' => function ($value, $context) {
                    $userId = $context['data']['user_id'];
                    $csId = $context['data']['course_semester_id'];

                    return $this->find()->where(['user_id' => $userId, 'course_semester_id' => $csId])->count() === 0;
                },
                'message' => __('Έχετε ψηφίσει ήδη το συγκεκριμένο μάθημα για το συγκεκριμένο εξάμηνο')
            ]);

        $validator
            ->allowEmpty('rating_text');

        $validator
            ->boolean('approved')
            ->allowEmpty('approved', 'create');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
