<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProfessorVisitHours Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Professors
 *
 * @method \App\Model\Entity\ProfessorVisitHour get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProfessorVisitHour newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProfessorVisitHour[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProfessorVisitHour|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProfessorVisitHour patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProfessorVisitHour[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProfessorVisitHour findOrCreate($search, callable $callback = null)
 */
class ProfessorVisitHoursTable extends Table
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

        $this->table('professor_visit_hours');
        $this->displayField('id');
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
            ->integer('day')
            ->requirePresence('day', 'create')
            ->notEmpty('day');

        $validator
            ->time('hour_start')
            ->requirePresence('hour_start', 'create')
            ->notEmpty('hour_start');

        $validator
            ->time('hour_end')
            ->requirePresence('hour_end', 'create')
            ->notEmpty('hour_end');

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
