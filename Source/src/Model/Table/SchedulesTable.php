<?php
namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\I18n\Time;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Schedules Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Classrooms
 * @property \Cake\ORM\Association\BelongsTo $CoursesSemesters
 * @property \Cake\ORM\Association\BelongsTo $Professors
 * @property \Cake\ORM\Association\HasMany $ScheduleOverrides
 *
 * @method \App\Model\Entity\Schedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\Schedule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Schedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Schedule|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Schedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Schedule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Schedule findOrCreate($search, callable $callback = null)
 */
class SchedulesTable extends Table
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

        $this->table('schedules');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Classrooms', [
            'foreignKey' => 'classroom_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CoursesSemesters', [
            'foreignKey' => 'course_semester_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Professors', [
            'foreignKey' => 'professor_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ScheduleOverrides', [
            'foreignKey' => 'schedule_id'
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
            ->notEmpty('day')
            ->add('day', 'inList', [
                'rule' => ['inList', array_keys(Configure::read('schedule.days'))],
                'message' => __('Μη έγκυρη ημέρα της εβδομάδος')
            ]);

        $table = $this;

        $validator
            ->time('hour_start')
            ->requirePresence('hour_start', 'create')
            ->notEmpty('hour_start')
            ->add('hour_start', 'custom_before_hour_end', [
                'rule' => function ($value, $context) {
                    $hourStart = (new Time())
                        ->hour($value['hour'])
                        ->minute($value['minute']);

                    $hourEnd = (new Time())
                        ->hour($context['data']['hour_end']['hour'])
                        ->minute($context['data']['hour_end']['minute']);

                    // date start less than date end
                    return $hourStart->lt($hourEnd);
                },
                'message' => __('Η ώρα λήξης πρέπει να είναι μετά την ώρα έναρξης του προγράμματος')
            ])
            ->add('hour_start', 'custom_does_not_collide', [
                'rule' => function ($value, $context) {
                    // find whether the schedule collides with another time
                    $schedule = $context['data'];

                    $scheduleStart = (new Time())
                        ->hour($schedule['hour_start']['hour'])
                        ->minute($schedule['hour_start']['minute']);

                    $scheduleEnd = (new Time())
                        ->hour($schedule['hour_end']['hour'])
                        ->minute($schedule['hour_end']['minute']);

                    $otherSchedulesOfSameClassroom = $this->find()->where(['classroom_id' => $schedule['classroom_id'], 'day' => $schedule['day']]);

                    foreach ($otherSchedulesOfSameClassroom as $otherSchedule) {
                        $otherScheduleStart = new Time($otherSchedule->hour_start);
                        $otherScheduleEnd = new Time($otherSchedule->hour_end);

                        if ( ($scheduleStart->gte($otherScheduleStart) and $scheduleStart->lte($otherScheduleEnd)) or
                             ($scheduleEnd->gte($otherScheduleStart) and $scheduleEnd->lte($otherScheduleEnd))) {
                            return false;
                        }
                    }

                    return true;
                },
                'message' => __('Οι ώρες που ορίσατε για τη συγκεκριμένη αίθουσα συμπίπτουν με άλλο μάθημα.')
            ]);


        $validator
            ->time('hour_end')
            ->requirePresence('hour_end', 'create')
            ->notEmpty('hour_end');

        return $validator;
    }

    public function customValidationMethod($check, array $context)
    {
        $userid = $context['providers']['passed']['userid'];
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
        $rules->add($rules->existsIn(['classroom_id'], 'Classrooms'));
        $rules->add($rules->existsIn(['course_semester_id'], 'CoursesSemesters'));
        $rules->add($rules->existsIn(['professor_id'], 'Professors'));

        return $rules;
    }
}
