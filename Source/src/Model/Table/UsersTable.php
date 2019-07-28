<?php
namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $Professors
 * @property \Cake\ORM\Association\HasMany $Students
 * @property \Cake\ORM\Association\HasMany $UserEmails
 * @property \Cake\ORM\Association\HasMany $UserPhones
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Professors', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserEmails', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserPhones', [
            'foreignKey' => 'user_id'
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
            ->requirePresence('first_name', 'create', __('Δεν συμπληρώσατε το όνομά σας'))
            ->notEmpty('first_name', __('Δεν συμπληρώσατε το όνομά σας'));

        $validator
            ->requirePresence('last_name', 'create', __('Δεν συμπληρώσατε το επίθετό σας'))
            ->notEmpty('last_name', __('Δεν συμπληρώσατε το επίθετό σας'));

        $validator
            ->allowEmpty('picture');

        $validator
            ->notEmpty('email', __('Δεν συμπληρώσατε το email σας'), 'create')
            ->allowEmpty('email', 'edit')
            ->requirePresence('email', 'create', __('Δεν συμπληρώσατε το email σας'))
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => __('Υπάρχει και άλλος χρήστης με αυτό το email')]);

        $validator
            ->notEmpty('password', __('Δεν συμπληρώσατε τον κωδικό σας'), 'create')
            ->allowEmpty('password', 'edit')
            ->requirePresence('password', 'create', __('Δεν συμπληρώσατε τον κωδικό σας'));

        $validator
            ->notEmpty('confirm_link', __('Δεν δημιουργήθηκε κωδικός επιβεβαίωσης λογαριασμού'), 'create')
            ->requirePresence('confirm_link', 'create', __('Δεν δημιουργήθηκε κωδικός επιβεβαίωσης λογαριασμού'));

        $validator
            ->allowEmpty('restore_link');

        $validator
            ->allowEmpty('confirmed')
            ->boolean('confirmed');

        $validator
            ->notEmpty('role', __('Ο ρόλος χρήστη δεν μπορεί να είναι άδειος'), 'create')
            ->allowEmpty('role', 'edit')
            ->requirePresence('role', 'create', __('Ο ρόλος χρήστη δεν μπορεί να είναι άδειος'))
            ->add('role', 'inList', [
                'rule' => ['inList', Configure::read('user.roles')],
                'message' => __('Ο ρόλος χρήστη δεν είναι έγκυρος')
            ]);

        $validator
            ->notEmpty('timezone', __('Η ζώνη ώρας δεν μπορεί να είναι άδεια'), 'create')
            ->allowEmpty('timezone', 'edit')
            ->add('timezone', 'inList', [
                'rule' => ['inList', \DateTimeZone::listIdentifiers()],
                'message' => __('Η ζώνη ώρας δεν είναι έγκυρη')
            ]);

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }

    public function findRole(Query $query, array $options)
    {
        $role = $options['role'];
        return $query->where(['role' => $role]);
    }
}
