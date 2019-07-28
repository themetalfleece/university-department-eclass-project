<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Log\Log;
use Cake\Datasource\ConnectionManager;

/**
 * CoursesStudents Controller
 *
 * @property \App\Model\Table\CoursesStudentsTable $CoursesStudents
 */
class CoursesStudentsController extends AppController
{
    public function add()
    {
        $response = ['success' => true];
        try {
            if (!array_key_exists('course_id', $this->request->data) || !array_key_exists('status', $this->request->data)) {
                \Cake\Log\Log::write('error', 'no status or course id');
                throw new \Exception();
            }

            $studentId = $this->CoursesStudents->Students->getIdByUser($this->Auth->user('id'));

            $studentCourse = $this->CoursesStudents->find()->where([
                'course_id' => $this->request->data['course_id'],
                'student_id' => $studentId
            ])->first();

            if ($this->request->data['status'] === 'deregister') {
                // delete the relation

                if (!$studentCourse) {
                    throw new \Exception();
                }

                if (!$this->CoursesStudents->delete($studentCourse)) {
                    throw new \Exception();
                }
            } else {
                \Cake\Log\Log::write('error', 'creating');
                // create
                if (!$studentCourse) {
                    // student has not already registered to the course
                    $studentCourse = $this->CoursesStudents->newEntity();
                    $studentCourse->student_id = $studentId;
                }

                $this->CoursesStudents->patchEntity($studentCourse, $this->request->data, ['status']);

                if (!$this->CoursesStudents->save($studentCourse)) {
                    \Cake\Log\Log::write('error', $studentCourse->errors());
                    throw new \Exception();
                }

            }
        } catch (\Exception $e) {
            \Cake\Log\Log::write('error', $e);
            $response['success'] = false;
        }

        $this->set('response', $response);
        $this->set('_serialize', 'response');
    }

    public function edit($id)
    {
        $response = ['success' => true];

        try {
            if (!array_key_exists('status', $this->request->data)) {
                throw new \Exception();
            }

            $courseStudent = $this->CoursesStudents->get($id);

            $this->CoursesStudents->patchEntity($courseStudent, $this->request->data, ['status']);

            if (!$this->CoursesStudents->save($courseStudent)) {
                throw new \Exception();
            }

        } catch (\Exception $e) {
            $response['success'] = false;
        }
        
        $this->set('response', $response);
        $this->set('_serialize', 'response');
    }

    /**
     * Delete method
     *
     * @param string|null $id Students Course id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersCourse = $this->CoursesStudents->get($id);
        if ($this->CoursesStudents->delete($usersCourse)) {
            $this->Flash->success(__('The users course has been deleted.'));
        } else {
            $this->Flash->error(__('The users course could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user) {
        if ($user['role'] === 'student') {
            if ($this->request->action === 'edit') {
                if (!isset($this->request->params['id'])) {
                    return false;
                }

                $courseStudent = $this->CoursesStudents->get($this->request->params['id']);

                if ($courseStudent->student_id !== $this->CoursesStudents->Students->getIdByUser($user['id'])) {
                    return false; // other student
                }

                return true;
            }

            if ($this->request->action === 'add') {
                if (!isset($this->request->data['course_id'])) {
                    return false;
                }

                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}
