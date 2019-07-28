<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CourseLinksCategories Controller
 *
 * @property \App\Model\Table\CourseLinksCategoriesTable $CourseLinksCategories
 */
class CourseLinksCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $courseLinksCategories = $this->paginate($this->CourseLinksCategories);

        $this->set(compact('courseLinksCategories'));
        $this->set('_serialize', ['courseLinksCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Course Links Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $courseLinksCategory = $this->CourseLinksCategories->get($id, [
            'contain' => ['CourseLinks']
        ]);

        $this->set('courseLinksCategory', $courseLinksCategory);
        $this->set('_serialize', ['courseLinksCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $courseLinksCategory = $this->CourseLinksCategories->newEntity();
        if ($this->request->is('post')) {
            $courseLinksCategory = $this->CourseLinksCategories->patchEntity($courseLinksCategory, $this->request->data);
            if ($this->CourseLinksCategories->save($courseLinksCategory)) {
                $this->Flash->success(__('The course links category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The course links category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('courseLinksCategory'));
        $this->set('_serialize', ['courseLinksCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Course Links Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $courseLinksCategory = $this->CourseLinksCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $courseLinksCategory = $this->CourseLinksCategories->patchEntity($courseLinksCategory, $this->request->data);
            if ($this->CourseLinksCategories->save($courseLinksCategory)) {
                $this->Flash->success(__('The course links category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The course links category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('courseLinksCategory'));
        $this->set('_serialize', ['courseLinksCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Course Links Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $courseLinksCategory = $this->CourseLinksCategories->get($id);
        if ($this->CourseLinksCategories->delete($courseLinksCategory)) {
            $this->Flash->success(__('The course links category has been deleted.'));
        } else {
            $this->Flash->error(__('The course links category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        // todo is this ok?
        if ($user['role'] === 'student') {
            return false;
        }

        return true;
    }
}
