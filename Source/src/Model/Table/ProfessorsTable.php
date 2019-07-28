<?php
namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Professors Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $CourseSemesterProfessors
 * @property \Cake\ORM\Association\HasMany $ProfessorPublications
 * @property \Cake\ORM\Association\HasMany $ProfessorVisitHours
 * @property \Cake\ORM\Association\HasMany $Schedules
 *
 * @method \App\Model\Entity\Professor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Professor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Professor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Professor|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Professor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Professor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Professor findOrCreate($search, callable $callback = null)
 */
class ProfessorsTable extends Table
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

        $this->table('professors');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('CourseSemesterProfessors', [
            'foreignKey' => 'professor_id'
        ]);
        $this->hasMany('ProfessorPublications', [
            'foreignKey' => 'professor_id'
        ]);
        $this->hasMany('ProfessorVisitHours', [
            'foreignKey' => 'professor_id'
        ]);
        $this->hasMany('Schedules', [
            'foreignKey' => 'professor_id'
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
            ->requirePresence('title', 'create', __('Ο τίτλος καθηγητή δεν μπορεί να είναι άδειος'))
            ->notEmpty('title', __('Ο τίτλος καθηγητή δεν μπορεί να είναι άδειος'))
            ->add('title', 'inList', [
                'rule' => ['inList', Configure::read('professor.titles')],
                'message' => __('Ο τίτλος καθηγητή δεν είναι έγκυρος')
            ]);

        $validator
            ->allowEmpty('bio');

        $validator
            ->allowEmpty('office_location');

        $validator
            ->boolean('active')
            ->allowEmpty('active', 'create');

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

        return $rules;
    }

    public function getIdByUser($id) {
        return (int) $this->findByUserId($id)->first()->id;
    }
}
