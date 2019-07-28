<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseLinksCategories Model
 *
 * @property \Cake\ORM\Association\HasMany $CourseLinks
 *
 * @method \App\Model\Entity\CourseLinksCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseLinksCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseLinksCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseLinksCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseLinksCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseLinksCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseLinksCategory findOrCreate($search, callable $callback = null)
 */
class CourseLinksCategoriesTable extends Table
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

        $this->table('course_links_categories');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('CourseLinks', [
            'foreignKey' => 'course_links_category_id'
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
            ->requirePresence('category', 'create')
            ->notEmpty('category');

        return $validator;
    }
}
