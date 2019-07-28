<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ScheduleOverrides Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Schedules
 *
 * @method \App\Model\Entity\ScheduleOverride get($primaryKey, $options = [])
 * @method \App\Model\Entity\ScheduleOverride newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ScheduleOverride[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ScheduleOverride|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ScheduleOverride patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ScheduleOverride[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ScheduleOverride findOrCreate($search, callable $callback = null)
 */
class ScheduleOverridesTable extends Table
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

        $this->table('schedule_overrides');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Schedules', [
            'foreignKey' => 'schedule_id',
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
            ->time('hour')
            ->allowEmpty('hour');

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
        $rules->add($rules->existsIn(['schedule_id'], 'Schedules'));

        return $rules;
    }
}
