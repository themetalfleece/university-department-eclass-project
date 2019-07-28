<?php
namespace App\Model\Table;

use Cake\I18n\Time;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Semesters Model
 *
 * @property \Cake\ORM\Association\HasMany $StudyGuides
 * @property \Cake\ORM\Association\BelongsToMany $Courses
 *
 * @method \App\Model\Entity\Semester get($primaryKey, $options = [])
 * @method \App\Model\Entity\Semester newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Semester[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Semester|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Semester patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Semester[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Semester findOrCreate($search, callable $callback = null)
 */
class SemestersTable extends Table
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

        $this->table('semesters');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('CoursesSemesters', [
            'foreignKey' => 'semester_id',
            'dependent' => true
        ]);

        $this->hasMany('StudyGuides', [
            'foreignKey' => 'semester_id'
        ]);

        $this->belongsToMany('Courses', [
            'foreignKey' => 'semester_id',
            'targetForeignKey' => 'course_id',
            'joinTable' => 'courses_semesters'
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
            ->date('date_start')
            ->requirePresence('date_start', 'create')
            ->notEmpty('date_start')
            ->add('date_start', 'custom', [
                'rule' => function ($value, $context) {
                    $dateStart = (new Time())
                        ->year($value['year'])
                        ->month($value['month'])
                        ->day($value['day']);

                    $dateEnd = (new Time())
                        ->year($context['data']['date_end']['year'])
                        ->month($context['data']['date_end']['month'])
                        ->day($context['data']['date_end']['day']);

                    // date start less than date end
                    return $dateStart->lt($dateEnd);
                },
                'message' => __('Η ημερομηνία έναρξης του εξαμήνου δεν μπορεί να είναι μετά την ημερομηνία λήξης του')
            ]);

        $validator
            ->date('date_end')
            ->requirePresence('date_end', 'create')
            ->notEmpty('date_end');

        $validator
            ->requirePresence('era', 'create')
            ->notEmpty('era');

        return $validator;
    }
}
