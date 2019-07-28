<?php
namespace App\Model\Table;

use Cake\Core\Configure;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Courses Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Sectors
 * @property \Cake\ORM\Association\HasMany $CourseLinks
 * @property \Cake\ORM\Association\HasMany $CoursesRecommendedBooks
 * @property \Cake\ORM\Association\BelongsToMany $Courses
 * @property \Cake\ORM\Association\BelongsToMany $Semesters
 * @property \Cake\ORM\Association\BelongsToMany $Students
 * @property \Cake\ORM\Association\BelongsToMany $StudyGuides
 *
 * @method \App\Model\Entity\Course get($primaryKey, $options = [])
 * @method \App\Model\Entity\Course newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Course[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Course|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Course patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Course[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Course findOrCreate($search, callable $callback = null)
 */
class CoursesTable extends Table
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

        $this->table('courses');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Sectors', [
            'foreignKey' => 'sector_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('CourseLinks', [
            'foreignKey' => 'course_id'
        ]);
        $this->hasMany('CoursesRecommendedBooks', [
            'foreignKey' => 'course_id'
        ]);
        $this->belongsToMany('Courses', [
            'foreignKey' => 'source_id',
            'targetForeignKey' => 'target_id',
            'joinTable' => 'courses_courses'
        ]);
        $this->belongsToMany('Semesters', [
            'foreignKey' => 'course_id',
            'targetForeignKey' => 'semester_id',
            'joinTable' => 'courses_semesters'
        ]);
        $this->belongsToMany('Students', [
            'foreignKey' => 'course_id',
            'targetForeignKey' => 'student_id',
            'joinTable' => 'courses_students',
            'through' => 'CoursesStudents'
        ]);
        $this->hasMany('CoursesStudents');

        $this->hasMany('CourseAnnouncements');

        $this->belongsToMany('StudyGuides', [
            'foreignKey' => 'course_id',
            'targetForeignKey' => 'study_guide_id',
            'joinTable' => 'courses_study_guides'
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
            ->requirePresence('title', 'create', __('Δεν συμπληρώσατε τον τίτλο του μαθήματος'))
            ->notEmpty('title', __('Δεν συμπληρώσατε τον τίτλο του μαθήματος'));

        $validator
            ->requirePresence('code', 'create', __('Δεν συμπληρώσατε τον κωδικό του μαθήματος'))
            ->notEmpty('code', __('Δεν συμπληρώσατε τον κωδικό του μαθήματος'))
            ->add('code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => __('Αυτός ο κωδικός μαθήματος υπάρχει ήδη')]);

        $validator
            ->allowEmpty('description');

        $validator
            ->requirePresence('type', 'create', __('Δεν συμπληρώσατε τον τύπο του μαθήματος'))
            ->notEmpty('type', __('Δεν συμπληρώσατε τον τύπο του μαθήματος'));

        $validator
            ->requirePresence('level', 'create', __('Δεν συμπληρώσατε το επίπεδο του μαθήματος'))
            ->notEmpty('level', __('Δεν συμπληρώσατε το επίπεδο του μαθήματος'))
            ->add('level', 'inList', [
                'rule' => ['inList', Configure::read('course.levels')],
                'message' => __('Το επίπεδο του μαθήματος δεν είναι έγκυρο')
            ]);

        $validator
            ->integer('semester')
            ->requirePresence('semester', 'create', __('Δεν συμπληρώσατε το εξάμηνο του μαθήματος'))
            ->notEmpty('semester', __('Δεν συμπληρώσατε το εξάμηνο του μαθήματος'));

        $validator
            ->allowEmpty('official_url');

        $validator
            ->allowEmpty('eclass_url');

        $validator
            ->integer('ects')
            ->requirePresence('ects', 'create', __('Δεν συμπληρώσατε τα ects του μαθήματος'))
            ->notEmpty('ects', __('Δεν συμπληρώσατε τα ects του μαθήματος'));

        $validator
            ->allowEmpty('exam_means');

        $validator
            ->numeric('gravity')
            ->requirePresence('gravity', 'create', __('Δεν συμπληρώσατε την βαρύτητα του μαθήματος'))
            ->notEmpty('gravity', __('Δεν συμπληρώσατε την βαρύτητα του μαθήματος'));

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
        $rules->add($rules->isUnique(['code']));
        $rules->add($rules->existsIn(['sector_id'], 'Sectors'));

        return $rules;
    }
}
