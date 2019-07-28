<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\SaveException;

use Cake\Core\Configure;
use Cake\Event\Event;

/**
 * Courses Controller
 *
 * @property \App\Model\Table\CoursesTable $Courses
 */
class CoursesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // todo make the overview function for logged out users
        $this->Auth->allow(['view', 'index']);
    }

    public function view()
    {
        $course = $this->Courses->find()->where(['code' => $this->request->params['code']])->first();

        if (!$course) {
            $this->Flash->error(__('Δεν υπάρχει μάθημα με κωδικό {0}', $this->request->params['code']));
        }

        $this->loadModel('CoursesSemesters');

        $maxSemester = $this->CoursesSemesters->find()
            ->where(['course_id' => $course->id])
            ->select(['max_semester_id' => 'MAX(CoursesSemesters.semester_id)'])->first();

        if ($maxSemester) {
            $maxSemester = $maxSemester->max_semester_id;

            $this->loadModel('CourseSemesterProfessors');

            $courseSemesterProfessors = $this->CourseSemesterProfessors->find()
                ->where(['course_semester_id' => $maxSemester])
                ->contain('Professors.Users');

            $this->set('courseSemesterProfessors', $courseSemesterProfessors);
        }

        $announcements = $this->Courses->CourseAnnouncements->find()->where(['course_id' => $course->id])->order(['created' => 'desc'])->limit(3);

        $courseLinksCount = $this->Courses->CourseLinks->find()->where(['course_id' => $course->id])->count();

        $this->set(compact(['course', 'courseLinksCount', 'announcements', 'courseProfessors']));

        $this->set('_serialize', ['course']);
    }

    public function add() {
        $course = $this->Courses->newEntity();
        
        if ($this->request->is('post')) {

            $course = $this->Courses->patchEntity($course, $this->request->data);

            try {
                if (!$this->Courses->save($course)) {
                    throw new SaveException(__('Υπήρξαν προβλήματα στην προσθήκη του μαθήματος'), $course->errors());
                }

                $this->Flash->success(__('Το μάθημα "{0}" προστέθηκε με επιτυχία', $course->title));
            } catch (SaveException $e) {
                $this->Flash->error($e->getModelErrors());
            }
        }

        $this->set('course', $course);

        $sectors = $this->loadModel('Sectors')->find();
        $this->set('sectors', $sectors);
    }

    public function index() {

        $this->paginate = [
            'Courses' => [
                'limit' => PHP_INT_MAX,
                'sortWhitelist' => ['Courses.title', 'Courses.type', 'Courses.code'],
                'order' => [
                    'Courses.title' => 'asc'
                ]
            ]
        ];

        $courses = $this->Courses->find()
            ->select(['title', 'code', 'type', 'students_count', 'attending_students_count']);

        $this->set('courses', $this->paginate($courses));
        $this->set('_serialize', 'courses');
    }

    public function register() {
        $this->paginate = [
            'Courses' => [
                'limit' => Configure::read('course.perPage'),
                'maxLimit' => Configure::read('course.perPage'),
                'sortWhitelist' => ['Courses.title', 'Sectors.sector', 'Courses.ects', 'Courses.code', 'Courses.level', 'Courses.type'],
                'order' => [
                    'Courses.title' => 'asc'
                ]
            ]
        ];

        $query = $this->Courses->find()
            ->select(['id', 'sector_id', 'title', 'code', 'type', 'level', 'semester', 'ects', 'Sectors.sector'])
            ->contain([
                'Sectors',
                'CoursesStudents' => function ($q) {
                    return $q->where(['student_id' => $this->Courses->Students->getIdByUser($this->Auth->user('id'))]);
                }
            ]);

        if (!empty($this->request->query('search'))) {
            $query->where(['Courses.title LIKE' => '%' . $this->request->query('search') . '%']);
        }

        $this->set('searchTerm', $this->request->query('search'));
        $this->set('courses', $this->paginate($query));
    }

    public function delete($code)
    {
        $course = null;
        try {
            $course = $this->Courses->findByCode($code)->first();

            if (!$course) {
                throw new \Exception(__('Δεν υπάρχει μάθημα με κωδικό {0}', $code));
            }

            $courseTitle = $course->title;

            $this->loadModel('CoursesSemesters');
            $this->loadModel('CoursesStudents');
            $this->loadModel('CourseAnnouncements');
            $this->loadModel('CourseLinks');

            $coursesSemesters = $this->CoursesSemesters->find()->where(['course_id' => $course->id]);
            $coursesStudents = $this->CoursesStudents->find()->where(['course_id' => $course->id]);
            $coursesAnnouncements = $this->CourseAnnouncements->find()->where(['course_id' => $course->id]);
            $coursesLinks = $this->CourseLinks->find()->where(['course_id' => $course->id]);

            $error = false;

            $this->Courses->connection()->transactional(function () use ($coursesLinks, $coursesSemesters, $coursesStudents, $coursesAnnouncements, $course, &$error) {
                foreach ($coursesSemesters as $cs) {
                    $this->CoursesSemesters->delete($cs);
                }

                foreach ($coursesStudents as $cs) {
                    $this->CoursesStudents->delete($cs);
                }

                foreach ($coursesAnnouncements as $ca) {
                    $this->CourseAnnouncements->delete($ca);
                }

                foreach ($coursesLinks as $cl) {
                    $this->CourseLinks->delete($cl);
                }

                $error = $this->Courses->delete($course);
            });

            try {
                $this->Courses->delete($course);
            } catch (\Exception $e) {
                throw new SaveException(__('Το μάθημα "{0}" δεν μπορεί να διαγραφθεί', $course->title), $course->errors());
            }

            $this->Flash->success(__('Το μάθημα "{0}" διαγράφθηκε με επιτυχία', $courseTitle));

        } catch(SaveException $e) {
            $this->Flash->error($e->getModelErrors());
        } catch (\Exception $e) {
            $this->Flash->error($e->getMessage());
        }

        return $this->redirect($this->referer());
    }

    public function isAuthorized($user) {
        if ($this->request->action === 'register' && $user['role'] === 'student') {
            return true; // only students are allowed to register a course
        }

        if (in_array($this->request->action, ['add', 'delete']) && $user['role'] === 'secretary') {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
