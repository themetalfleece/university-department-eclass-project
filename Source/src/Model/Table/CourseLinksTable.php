<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseLinks Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CourseLinksCategories
 * @property \Cake\ORM\Association\BelongsTo $Courses
 *
 * @method \App\Model\Entity\CourseLink get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseLink newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseLink[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseLink|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseLink patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseLink[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseLink findOrCreate($search, callable $callback = null)
 */
class CourseLinksTable extends Table
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

        $this->table('course_links');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('CourseLinksCategories', [
            'foreignKey' => 'course_links_category_id',
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
            ->requirePresence('title', 'create')
            ->notEmpty('title', __('Δεν συμπληρώσατε τον τίτλο του συνδέσμου'));

        $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url', __('Δεν συμπληρώσατε τον σύνδεσμο'));

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
        $rules->add($rules->existsIn(['course_links_category_id'], 'CourseLinksCategories'), __('Δεν υπάρχει τέτοια κατηγορία συνδέσμων'));
        $rules->add($rules->existsIn(['course_id'], 'Courses'), __('Δεν υπάρχει τέτοιο μάθημα'));

        return $rules;
    }
}
