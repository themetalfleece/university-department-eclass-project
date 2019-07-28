<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\SaveException;

use Cake\Collection\Collection;
use Cake\Datasource\ConnectionManager;

/**
 * Semesters Controller
 *
 * @property \App\Model\Table\SemestersTable $Semesters
 */
class SemestersController extends AppController
{

    public function initialize()
    {
        $this->loadComponent('SemesterDuplicator');
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
        'Semesters' => [
        'limit' => 10,
        'sortWhitelist' => ['Semesters.id', 'Semesters.date_start', 'Semesters.date_end', 'Semesters.era'],
        'order' => [
        'Semesters.id' => 'desc'
        ]
        ]
        ];

        $semesters = $this->paginate($this->Semesters);

        $this->set(compact('semesters'));
        $this->set('_serialize', ['semesters']);
    }

    /**
     * View method
     *
     * @param string|null $id Semester id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $semester = $this->Semesters->get($id, [
            'contain' => ['Courses', 'StudyGuides']
            ]);

        $this->set('semester', $semester);
        $this->set('_serialize', ['semester']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $semester = $this->Semesters->newEntity();
        if ($this->request->is('post')) {
            $semester = $this->Semesters->patchEntity($semester, $this->request->data);

            try {
                $controller = $this;

                $conn = ConnectionManager::get('default');

                $conn->transactional(function () use ($controller, $semester) {
                    if (!$controller->Semesters->save($semester, ['atomic' => false])) {
                        throw new SaveException(__('Το εξάμηνο δεν μπόρεσε να δημιουργηθεί:'), $semester->errors());
                    }

                    if (isset($controller->request->data['copy_over_lessons']) and $controller->request->data['copy_over_lessons'] === '1') {
                        // copy the old courses semesters to the new one
                        $fromSemester = empty($controller->request->data['copy_semester_id']) ? false : $controller->Semesters->get($controller->request->data['copy_semester_id']);

                        if (!$fromSemester) {
                            throw new \Exception(__('Δεν μπόρεσε να γίνει η αντιγραφή των μαθημάτων στο εξάμηνο γιατί δηλώθηκε μη έγκυρο εξάμηνο πηγής αντιγραφής'));
                        }

                        $this->SemesterDuplicator->duplicate($fromSemester->id, $semester->id, $controller->request->data);
                    }
                });

                $this->Flash->success(__('Το εξάμηνο "{0}" προστέθηκε με επιτυχία', $semester->era));
            } catch(SaveException $e) {
                $this->Flash->error($e->getModelErrors());
            } catch(\Exception $e) {
                $this->Flash->error($e->getMessage());
            }
        }

        $courses = $this->Semesters->Courses->find('list', ['limit' => 200]);

        $pastSemesters = [];

        (new Collection($this->Semesters->find()->order(['id' => 'desc'])))->each(function ($value, $key) use (&$pastSemesters) {
            $pastSemesters[$value->id] = $value->era;
        });

        $this->set(compact('semester', 'courses', 'pastSemesters'));
        $this->set('_serialize', ['semester']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Semester id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $semester = $this->Semesters->get($id, [
            'contain' => ['Courses']
            ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $semester = $this->Semesters->patchEntity($semester, $this->request->data);
            if ($this->Semesters->save($semester)) {
                $this->Flash->success(__('Το εξάμηνο αποθηκεύτηκε με επιτυχία'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Δεν μπορέσαμε να αποθηκεύσουμε το εξάμηνο με επιτυχία. Παρακαλώ προσπαθήστε ξανά'));
            }
        }
        $courses = $this->Semesters->Courses->find('list', ['limit' => 200]);
        $this->set(compact('semester', 'courses'));
        $this->set('_serialize', ['semester']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Semester id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $semester = $this->Semesters->get($id);
        $coursesSemesters = $this->Semesters->CoursesSemesters->find()->where(['semester_id' => $id]);
        $error = false;

        $this->Semesters->connection()->transactional(function () use ($coursesSemesters, $semester, &$error) {
            foreach ($coursesSemesters as $cs) {
                $this->Semesters->CoursesSemesters->delete($cs);
            }

            $error = $this->Semesters->delete($semester);
        });

        if ($error) {
            $this->Flash->success(__('Το εξάμηνο διαγράφθηκε με επιτυχία'));
        } else {
            $this->Flash->error(__('Δεν μπορέσαμε να διαγράψουμε το εξάμηνο. Παρακαλώ προσπαθήστε ξανά'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['index', 'add', 'view', 'edit', 'delete']) && $user['role'] === 'secretary') {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
