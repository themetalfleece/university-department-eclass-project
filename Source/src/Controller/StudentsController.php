<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\SaveException;

use Cake\Core\Configure;
use Cake\Event\Event;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 */
class StudentsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Profile', ['role' => 'student']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['profile']);
    }

    private function courseStatusField() {
        return 'FIELD(CoursesStudents.status, ' . implode(', ', array_map(function ($v) {
            return '\'' . $v . '\'';
        }, Configure::read('course.statuses'))) . ')';
    }

    public function index() {
        $query = $this->Students->find()->contain(['Users']);

        $students = $this->paginate($query);

        $this->set('students', $students);
    }

    public function profile($userIdentifier)
    {
        // the profile component assures us that  the profile exists (it would redirect in other case or show a 404 error)
        $user = $this->Users->find()->where(['identifier' => $userIdentifier])->contain(['Students', 'UserPhones', 'UserEmails'])->first();

        $this->set('profileUser', $user);
    }

    public function home($lastName = null) {
        if ($lastName !== $this->Auth->user('last_name')) {
            return $this->redirect(['action' => 'home', $this->Auth->user('last_name')]);
        }
        $courseStatusField = $this->courseStatusField();
        // show the courses in the correct order (e.g. first the attending ones, then the registered then...)
        $this->paginate = [
            'CoursesStudents' => [
                'limit' => Configure::read('student.courses.perPage'),
                'maxLimit' => Configure::read('student.courses.perPage'),
                'order' => [
                    $courseStatusField => 'asc',
                    'CoursesStudents.created' => 'desc'
                ],
                'sortWhitelist' => ['Courses.title', 'Courses.ects', 'Courses.type', 'Courses.level', 'CoursesStudents.created', $courseStatusField],
                'finder' => [
                    'coursesOf' => ['where' => ['student_id' => $this->Students->getIdByUser($this->Auth->user('id'))]]
                ]
            ]
        ];

        if (array_key_exists('search', $this->request->query) && !empty($this->request->query['search'])) {
            // add the search term to the pagination rules
            $this->paginate['CoursesStudents']['finder']['coursesOf']['where.contain'] = ['Courses.title LIKE' => '%' . $this->request->query['search'] . '%'];
            $this->set('searchTerm', $this->request->query['search']);
        } else {
            $this->set('searchTerm', false);
        }

        $this->set('courseStatusField', $courseStatusField);

        $this->set('userCourses', $this->paginate('CoursesStudents'));
    }

    public function settings()
    {
        $this->request->allowMethod(['post']);

        $student = $this->Students->get($this->Students->getIdByUser($this->Auth->user('id')));

        $student = $this->Students->patchEntity($student, $this->request->data, ['AM', 'level']);

        try {
            if (!$this->Students->save($student)) {
                throw new SaveException(__('Υπήρξαν προβλήματα στην αποθήκευση των ρυθμίσεων του χρήστη:'), $student->errors());
            }

            $this->Flash->success(__('Οι ρυθμίσεις αποθηκεύτηκαν με επιτυχία.'));
        } catch (SaveException $e) {
            $this->Flash->error($e->getModelErrors());
        }

        return $this->redirect(['controller' => 'Users', 'action' => 'settings']);
    }

    public function isAuthorized($user) {
        if ($user['role'] === 'student' && in_array($this->request->action, ['home', 'settings'])) {
            return true;
        }

        if ($this->request->action === 'index' && $user['role'] === 'secretary') {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
