<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Collection\Collection;
use Cake\Event\Event;

/**
 * Professors Controller
 *
 * @property \App\Model\Table\ProfessorsTable $Professors
 */
class ProfessorsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Profile', ['role' => 'professor']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['profile', 'index']);
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        
        $professors = $this->paginate($this->Professors);

        $this->set(compact('professors'));
        $this->set('_serialize', ['professors']);
    }

    public function profile($userIdentifier)
    {
        // the profile component assures us that  the profile exists (it would redirect in other case or show a 404 error)
        $user = $this->Users->find()->where(['identifier' => $userIdentifier])->contain(['UserPhones', 'UserEmails'])->first();

        $professor = $this->Professors->find()->where(['user_id' => $user->id])->first();

        $this->set('professor', $professor);
        $this->set('profileUser', $user);
    }

    public function home($lastName = null)
    {
        if ($lastName !== $this->Auth->user('last_name')) {
            return $this->redirect(['action' => 'home', $this->Auth->user('last_name')]);
        }

        $this->loadModel('CourseSemesterProfessors');
        $this->loadModel('Semesters');

        $profId = $this->Professors->getIdByUser($this->Auth->user('id'));

        $professorCourses = $this->CourseSemesterProfessors->find()
            ->where(['professor_id' => $profId])
            ->contain(['CoursesSemesters.Courses']);

        $this->set('professorCourses', $professorCourses);
    }

    public function students() {
        $professors = $this->Professors->find()->where(['id' => $this->Professors->getIdByUser($this->Auth->user('id'))])
            ->contain(['CourseSemesterProfessors.CoursesSemesters.Courses.CoursesStudents.Students.Users']);

        $students = (new Collection($professors))->extract('course_semester_professors.{*}.courses_semester.course.courses_students.{*}.student')->indexBy('AM');

        $this->set('students', $students);
    }

    public function studentCourses() {

        $studentId = $this->request->query['student-id'];
        $professorId = $this->Professors->getIdByUser($this->Auth->user('id'));

        $professors = $this->Professors->find()->where(['Professors.id' => $professorId])
            ->contain([
                'CourseSemesterProfessors.CoursesSemesters.Courses.CoursesStudents.Students' => function ($q) use ($studentId) {
                    return $q->where(['Students.id' => $studentId]);
                }]);

        $courses = (new Collection($professors))
            ->extract('course_semester_professors.{*}.courses_semester.course')
            ->indexBy('code')
            ->toList();

        $this->loadModel('Users');
        $this->loadModel('Students');

        $studentUserId = $this->Students->find()->where(['id' => $studentId])->first()->user_id;

        $response = [
            'courses' => $this->viewBuilder()->build()->element('Professor/userCourses', ['courses' => $courses]),
            'user' => $this->viewBuilder()->build()->element('Professor/userTitle', ['user' => $this->Users->get($studentUserId)])
        ];

        $this->response->type('application/json');

        $this->set('response', $response);
        $this->set('_serialize', 'response');
    }

    public function register() {
        $this->loadModel('CoursesSemesters');
        $this->loadModel('Semesters');
        if ($this->request->is('get')) {
            $lastSemester = $this->Semesters->find()->order(['id' => 'desc'])->first();
            if ($lastSemester) {
                $lastSemester = $lastSemester->id;

                $latestCs = $this->CoursesSemesters->find()->contain(['Courses', 'CourseSemesterProfessors'])->where(['semester_id' => $lastSemester]);

                $this->set('latestCs', $latestCs);
            } else {
                $this->set('latestCs', false);
            }    
        } else {
            $response = ['success' => true];

            $this->loadModel('CourseSemesterProfessors');
            $register = $this->request->data['checked'];
            $csid = $this->request->data['csid'];
            $courseSemester = $this->CoursesSemesters->get($csid);
            $professor_id = $this->Professors->find()->where(['user_id' => $this->Auth->user('id')])->first()->id;

            if ($register === 'true') {
                if ($this->CourseSemesterProfessors->find()->where(['course_semester_id' => $csid, 'professor_id' => $professor_id])->count() > 0) {
                    // already OK
                } else {
                    $csp = $this->CourseSemesterProfessors->newEntity();
                    $csp->professor_id = $professor_id;
                    $csp->course_semester_id = $csid;

                    $response['success'] = $this->CourseSemesterProfessors->save($csp) ? true : false;
                }
            } else {
                $this->CourseSemesterProfessors->deleteAll(['course_semester_id' => $csid, 'professor_id' => $professor_id]);
            }

            $this->set('response', $response);
            $this->set('_serialize', 'response');
        }
    }

    public function isAuthorized($user) {
        if ($user['role'] === 'professor' && in_array($this->request->action, ['home', 'students', 'register', 'studentCourses'])) {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
