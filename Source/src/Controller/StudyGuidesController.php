<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StudyGuides Controller
 *
 * @property \App\Model\Table\StudyGuidesTable $StudyGuides
 */
class StudyGuidesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Semesters']
        ];
        $studyGuides = $this->paginate($this->StudyGuides);

        $this->set(compact('studyGuides'));
        $this->set('_serialize', ['studyGuides']);
    }

    /**
     * View method
     *
     * @param string|null $id Study Guide id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studyGuide = $this->StudyGuides->get($id, [
            'contain' => ['Semesters', 'Courses']
        ]);

        $this->set('studyGuide', $studyGuide);
        $this->set('_serialize', ['studyGuide']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studyGuide = $this->StudyGuides->newEntity();
        if ($this->request->is('post')) {
            $studyGuide = $this->StudyGuides->patchEntity($studyGuide, $this->request->data);
            if ($this->StudyGuides->save($studyGuide)) {
                $this->Flash->success(__('Ο οδηγός σπουδών έχει αποθηκευτεί.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Δεν μπορέσαμε να αποθηκεύσουμε τον οδηγό σπουδών. Παρακαλώ προσπαθήστε ξανά'));
            }
        }

        $semesters = [];
        
        $this->StudyGuides->Semesters->find()->each(function ($value, $key) use (&$semesters) {
            $semesters[$value->id] = $value->era;
        });


        $courses = $this->StudyGuides->Courses->find('list', ['limit' => 200]);
        $this->set(compact('studyGuide', 'semesters', 'courses'));
        $this->set('_serialize', ['studyGuide']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Study Guide id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studyGuide = $this->StudyGuides->get($id, [
            'contain' => ['Courses']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studyGuide = $this->StudyGuides->patchEntity($studyGuide, $this->request->data);
            if ($this->StudyGuides->save($studyGuide)) {
                $this->Flash->success(__('Ο οδηγός σπουδών αποθηκεύτηκε'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Δεν μπορέσαμε να αποθηκεύσουμε τον οδηγό σπουδών. Παρακαλώ προσπαθήστε ξανά'));
            }
        }

        $semesters = [];
        
        $this->StudyGuides->Semesters->find()->each(function ($value, $key) use (&$semesters) {
            $semesters[$value->id] = $value->era;
        });

        $courses = $this->StudyGuides->Courses->find('list');

        $this->set(compact('studyGuide', 'semesters', 'courses'));
        $this->set('_serialize', ['studyGuide']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Study Guide id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studyGuide = $this->StudyGuides->get($id);
        if ($this->StudyGuides->delete($studyGuide)) {
            $this->Flash->success(__('The study guide has been deleted.'));
        } else {
            $this->Flash->error(__('The study guide could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        // todo, really true for all actions?
        if ($user['role'] === 'secretary') {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
