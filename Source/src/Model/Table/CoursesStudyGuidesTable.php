<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CoursesStudyGuides Model
 *
 * @property \Cake\ORM\Association\BelongsTo $StudyGuides
 * @property \Cake\ORM\Association\BelongsTo $Courses
 *
 * @method \App\Model\Entity\CoursesStudyGuide get($primaryKey, $options = [])
 * @method \App\Model\Entity\CoursesStudyGuide newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CoursesStudyGuide[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CoursesStudyGuide|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CoursesStudyGuide patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CoursesStudyGuide[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CoursesStudyGuide findOrCreate($search, callable $callback = null)
 */
class CoursesStudyGuidesTable extends Table
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

        $this->table('courses_study_guides');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('StudyGuides', [
            'foreignKey' => 'study_guide_id',
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
            ->allowEmpty('curriculum');

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
        $rules->add($rules->existsIn(['study_guide_id'], 'StudyGuides'));
        $rules->add($rules->existsIn(['course_id'], 'Courses'));

        return $rules;
    }
}
