<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProfessorPublications Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Professors
 *
 * @method \App\Model\Entity\ProfessorPublication get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProfessorPublication newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProfessorPublication[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProfessorPublication|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProfessorPublication patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProfessorPublication[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProfessorPublication findOrCreate($search, callable $callback = null)
 */
class ProfessorPublicationsTable extends Table
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

        $this->table('professor_publications');
        $this->displayField('name');
        $this->primaryKey('id');

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

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url');

        $validator
            ->integer('reference_count')
            ->requirePresence('reference_count', 'create')
            ->notEmpty('reference_count');

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
        $rules->add($rules->existsIn(['professor_id'], 'Professors'));

        return $rules;
    }
}
