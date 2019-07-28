<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Books Model
 *
 * @property \Cake\ORM\Association\HasMany $CoursesRecommendedBooks
 *
 * @method \App\Model\Entity\Book get($primaryKey, $options = [])
 * @method \App\Model\Entity\Book newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Book[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Book|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Book patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Book[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Book findOrCreate($search, callable $callback = null)
 */
class BooksTable extends Table
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

        $this->table('books');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->hasMany('CoursesRecommendedBooks', [
            'foreignKey' => 'book_id'
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
            ->notEmpty('title');

        $validator
            ->requirePresence('authors', 'create')
            ->notEmpty('authors');

        $validator
            ->integer('publish_year')
            ->requirePresence('publish_year', 'create')
            ->notEmpty('publish_year');

        $validator
            ->integer('publish_number')
            ->requirePresence('publish_number', 'create')
            ->notEmpty('publish_number');

        $validator
            ->requirePresence('publisher', 'create')
            ->notEmpty('publisher');

        $validator
            ->integer('ISBN')
            ->requirePresence('ISBN', 'create')
            ->notEmpty('ISBN');

        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('cover');

        return $validator;
    }
}
