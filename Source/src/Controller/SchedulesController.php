<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\SaveException;

/**
 * Schedules Controller
 *
 * @property \App\Model\Table\SchedulesTable $Schedules
 */
class SchedulesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Classrooms', 'CoursesSemesters.Courses', 'CoursesSemesters.Semesters', 'Professors.Users']
        ];
        $schedules = $this->paginate($this->Schedules);

        $this->set(compact('schedules'));
        $this->set('_serialize', ['schedules']);
    }

    /**
     * View method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => ['Classrooms', 'CoursesSemesters', 'Professors', 'ScheduleOverrides']
        ]);

        $this->set('schedule', $schedule);
        $this->set('_serialize', ['schedule']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $schedule = $this->Schedules->newEntity();
        if ($this->request->is('post')) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->data);

            try {

                if (!$this->Schedules->save($schedule)) {
                    throw new SaveException(__('Υπήρξαν προβλήματα στην αποθήκευση του προγράμματος:'), $schedule->errors());
                }

                $this->Flash->success(__('Το πρόγραμμα αποθηκεύτηκε με επιτυχία.'));
            } catch (SaveException $e) {
                $this->Flash->error($e->getModelErrors());
            }
        }

        $lastSemester = $this->Schedules->CoursesSemesters->Semesters->find()->order(['id' => 'desc'])->first()->id;
        $classrooms = $this->Schedules->Classrooms->find('list', ['limit' => 200]);
        $coursesSemesters = $this->Schedules->CoursesSemesters->find()->where(['semester_id' => $lastSemester])->contain('Courses');
        $professors = $this->Schedules->Professors->find()->contain('Users');

        $this->set(compact('schedule', 'classrooms', 'coursesSemesters', 'professors'));
        $this->set('_serialize', ['schedule']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->data);
            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('Η ώρα του μαθήματος έχει αποθηκευτεί.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Οι ώρες δεν μπόρεσαν να αποθηκευτούν'));
            }
        }
        $classrooms = $this->Schedules->Classrooms->find('list', ['limit' => 200]);
        $coursesSemesters = $this->Schedules->CoursesSemesters->find('list', ['limit' => 200]);
        $professors = $this->Schedules->Professors->find('list', ['limit' => 200]);
        $this->set(compact('schedule', 'classrooms', 'coursesSemesters', 'professors'));
        $this->set('_serialize', ['schedule']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schedule = $this->Schedules->get($id);
        if ($this->Schedules->delete($schedule)) {
            $this->Flash->success(__('Οι ώρες διαγράφθηκαν'));
        } else {
            $this->Flash->error(__('Οι ώρες δεν μπόρεσαν να διαγραφθούν. Παρακαλώ ξαναπροσπαθήστε'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function student()
    {
        // load the schedule of the user itself
        $student_id = $this->loadModel('Students')->getIdByUser($this->Auth->user('id'));
        $lastSemester = $this->Schedules->CoursesSemesters->Semesters->find()->order(['id' => 'desc'])->first()->id;

        $schedules = $this->Schedules->find()
            ->matching('CoursesSemesters', function ($q) use ($lastSemester, $student_id) {
                return $q
                    ->where(['semester_id' => $lastSemester])
                    ->contain('Courses')
                    ->matching('CoursesStudents', function ($q) use ($student_id) {
                        return $q->where(['CoursesStudents.student_id' => $student_id, 'CoursesStudents.status' => 'attending']);
                    });
            })
            ->contain('Classrooms', 'Professors.Users')
            ->order(['day' => 'asc', 'hour_start' => 'asc'])
            ->toList();

        $this->set('schedules', $schedules);
    }

    public function isAuthorized($user) {
        if ($user['role'] === 'secretary') {
            return true;
        }

        if ($user['role'] === 'student' and $this->request->action === 'student') {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
