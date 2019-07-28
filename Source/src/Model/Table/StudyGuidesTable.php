<?php
namespace App\Model\Table;

use Cake\Core\Configure;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StudyGuides Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Semesters
 * @property \Cake\ORM\Association\BelongsToMany $Courses
 *
 * @method \App\Model\Entity\StudyGuide get($primaryKey, $options = [])
 * @method \App\Model\Entity\StudyGuide newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StudyGuide[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StudyGuide|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudyGuide patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StudyGuide[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StudyGuide findOrCreate($search, callable $callback = null)
 */
class StudyGuidesTable extends Table
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

        $this->table('study_guides');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Semesters', [
            'foreignKey' => 'semester_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Courses', [
            'foreignKey' => 'study_guide_id',
            'targetForeignKey' => 'course_id',
            'joinTable' => 'courses_study_guides'
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
            ->requirePresence('level', 'create')
            ->notEmpty('level')->add('level', 'inList', [
                'rule' => ['inList', Configure::read('course.levels')],
                'message' => __('Το επίπεδο του οδηγού σπουδών δεν είναι έγκυρο')
            ]);

        $validator
            ->requirePresence('info', 'create')
            ->notEmpty('info');

        $validator
            ->requirePresence('ruling', 'create')
            ->notEmpty('ruling');

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

        return $rules;
    }
}
