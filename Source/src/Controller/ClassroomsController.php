<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\SaveException;

use Cake\Collection\Collection;

/**
 * Classrooms Controller
 *
 * @property \App\Model\Table\ClassroomsTable $Classrooms
 */
class ClassroomsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $classrooms = $this->paginate($this->Classrooms);

        $this->set(compact('classrooms'));
        $this->set('_serialize', ['classrooms']);
    }

    /**
     * View method
     *
     * @param string|null $id Classroom id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $courseSemesterClassrooms = $this->Classrooms->CourseSemesterClassrooms->find()
            ->where(['classroom_id' => $id])
            ->contain(['CoursesSemesters.Semesters', 'CoursesSemesters.Courses', 'Classrooms.Schedules.Professors.Users', 'Classrooms.Schedules.CoursesSemesters.Courses', 'Classrooms.Schedules.CoursesSemesters.Semesters'])
            ->order(['Semesters.date_start' => 'desc'])
            ->toList();

        if (empty($courseSemesterClassrooms)) {
            $classroom = $this->Classrooms->get($id);
        } else {
            $classroom = $courseSemesterClassrooms[0]->classroom;
        }

        $this->set('courseSemesterClassrooms', $courseSemesterClassrooms);
        $this->set('classroom', $classroom);
        $this->set('_serialize', ['courseSemesterClassroom', 'classroom']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $classroom = $this->Classrooms->newEntity();
        if ($this->request->is('post')) {
            $classroom = $this->Classrooms->patchEntity($classroom, $this->request->data);
            try {
                if (!$this->Classrooms->save($classroom)) {
                    throw new SaveException(__('Η αίθουσα δεν μπόρεσε να αποθηκευτεί:'), $classroom->errors());
                }
               $this->Flash->success(__('Η αίθουσα "{0}" έχει αποθηκευτεί.', $classroom->name));

                return $this->redirect(['action' => 'index']);
            } catch (SaveException $e) {
                $this->Flash->error($e->getModelErrors());
            }
            
        }
        $this->set(compact('classroom'));
        $this->set('_serialize', ['classroom']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Classroom id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $classroom = $this->Classrooms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $classroom = $this->Classrooms->patchEntity($classroom, $this->request->data);
            if ($this->Classrooms->save($classroom)) {
                $this->Flash->success(__('Η αίθουσα "{0}" έχει αποθηκευτεί.', $classroom->name));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Η αίθουσα δεν μπόρεσε να αποθηκευτεί, παρακαλώ προσπαθήστε ξανά'));
            }
        }
        $this->set(compact('classroom'));
        $this->set('_serialize', ['classroom']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Classroom id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $classroom = $this->Classrooms->get($id);
        if ($this->Classrooms->delete($classroom)) {
            $this->Flash->success(__('Η αίθουσα διαγράφθηκε'));
        } else {
            $this->Flash->error(__('Δεν μπορέσαμε να διαγράψουμε την αίθουσα. Παρακαλώ προσπαθήστε ξανά'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user) {
        // todo fix
        return true;
    }
}
