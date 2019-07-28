<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\SaveException;

use Cake\Collection\Collection;

/**
 * CourseLinks Controller
 *
 * @property \App\Model\Table\CourseLinksTable $CourseLinks
 */
class CourseLinksController extends AppController
{
    public function index($courseCode = null)
    {
        try {
            if ($courseCode === null) {
                throw new \Exception(__('Δεν δηλώσατε κωδικό μαθήματος'));
            }

            $course = $this->CourseLinks->Courses->find()->where(['code' => $courseCode])->first();

            if (!$course) {
                throw new \Exception(__('Δεν υπάρχει μάθημα με κωδικό "{0}"', $courseCode));
            }

            $categories = $this->CourseLinks->CourseLinksCategories->find()->matching('CourseLinks', function ($q) use ($course) {
                return $q->where(['course_id' => $course->id]);
            })->toArray();

            $byCategory = (new Collection($categories))->groupBy('category')->toArray();

            $this->set('course', $course);
            $this->set('categories', $byCategory);
        } catch (\Exception $e) {
            $this->Flash->error($e->getMessage());
            return $this->redirect($this->referer());
        }
    }

    // /**
    //  * View method
    //  *
    //  * @param string|null $id Course Link id.
    //  * @return \Cake\Network\Response|null
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    // public function view($id = null)
    // {
    //     $courseLink = $this->CourseLinks->get($id, [
    //         'contain' => ['CourseLinksCategories', 'Courses']
    //     ]);

    //     $this->set('courseLink', $courseLink);
    //     $this->set('_serialize', ['courseLink']);
    // }

    // /**
    //  * Add method
    //  *
    //  * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
    //  */
    // public function add()
    // {
    //     $courseLink = $this->CourseLinks->newEntity();
    //     if ($this->request->is('post')) {
    //         $courseLink = $this->CourseLinks->patchEntity($courseLink, $this->request->data);
    //         if ($this->CourseLinks->save($courseLink)) {
    //             $this->Flash->success(__('The course link has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         } else {
    //             $this->Flash->error(__('The course link could not be saved. Please, try again.'));
    //         }
    //     }
    //     $courseLinksCategories = $this->CourseLinks->CourseLinksCategories->find('list', ['limit' => 200]);
    //     $courses = $this->CourseLinks->Courses->find('list', ['limit' => 200]);
    //     $this->set(compact('courseLink', 'courseLinksCategories', 'courses'));
    //     $this->set('_serialize', ['courseLink']);
    // }

    // *
    //  * Edit method
    //  *
    //  * @param string|null $id Course Link id.
    //  * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
    //  * @throws \Cake\Network\Exception\NotFoundException When record not found.
     
    public function edit($id = null)
    {
        $courseLink = $this->CourseLinks->get($id, [
            'contain' => ['Courses']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $courseLink = $this->CourseLinks->patchEntity($courseLink, $this->request->data);

            try {
                if (!$this->CourseLinks->save($courseLink)) {
                    \Cake\Log\Log::write('error', $this->request->data);
                    \Cake\Log\Log::write('error', $courseLink->errors());
                    throw new SaveException(__('Ο σύνδεσμος του μαθήματος δεν μπόρεσε να αποθηκευτεί:'), $courseLink->errors());
                }

                $this->Flash->success(__('The course link has been saved.'));
            } catch (SaveException $e) {
                $this->Flash->error($e->getModelErrors());
            }

        }

        $courseLinksCategories = [];
        (new Collection($this->CourseLinks->CourseLinksCategories->find()->toArray()))->each(function ($value, $key) use (&$courseLinksCategories) {
            $courseLinksCategories[$value->id] = $value->category;
        });

        $courses = [];
        (new Collection($this->CourseLinks->Courses->find()))->each(function ($value, $key) use (&$courses) {
            $courses[$value->id] = $value->title . ' (' . $value->code . ')';
        });

        $this->set(compact('courseLink', 'courseLinksCategories', 'courses'));
        $this->set('_serialize', ['courseLink']);
    }

    public function delete($id = null)
    {
        $courseLink = $this->CourseLinks->get($id);

        if (!$courseLink) {
            $this->Flash->error(__('Μη έγκυρος σύνδεσμος'));
        } else {
            if ($this->CourseLinks->delete($courseLink)) {
                $this->Flash->success(__('Ο σύνδεσμος "{0}" διαγράφθηκε', $courseLink->title));
            } else {
                $this->Flash->error(__('Ο σύνδεσμος "{0}" δεν διαγράφθηκε. Παρακαλούμε προσπαθήστε ξανά', $courseLink->title));
            }
        }

        return $this->redirect($this->referer());
    }

    public function deleteAll($categoryId, $courseId)
    {
        $category = $this->CourseLinks->CourseLinksCategories->get($categoryId);
        $course = $this->CourseLinks->Courses->get($courseId);

        if (!$category or !$course) {
            $this->Flash->error(__('Μη έγκυρη κατηγορία ή μάθημα'));
        } else {
            $this->CourseLinks->deleteAll(['course_links_category_id' => $categoryId, 'course_id' => $courseId]);
            $this->Flash->success(__('Όλα τα links από την κατηγορία "{0}" διαγράφθηκαν από το μάθημα "{1}"', $category->category, $course->title));
        }

        return $this->redirect($this->referer());
    }

    public function isAuthorized($user)
    {
        if (in_array($user['role'], ['student', 'secretary']) and in_array($this->request->action, ['index'])) {
            return true;
        }

        if (in_array($user['role'], ['secretary', 'teacher']) and in_array($this->request->action, ['edit', 'delete', 'deleteAll'])) {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
