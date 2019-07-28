<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CourseAnnouncements Controller
 *
 * @property \App\Model\Table\CourseAnnouncementsTable $CourseAnnouncements
 */
class CourseAnnouncementsController extends AppController
{

    public function course($code = null)
    {
        try {
            if ($code === null) {
                throw new \Exception(__('Δεν δηλώσατε κωδικό μαθήματος'));
            }

            $course = $this->loadModel('Courses')->findByCode($code)->first();

            if (!$course) {
                throw new \Exception(__('Δεν υπάρχει μάθημα με κωδικό {0}', $code));
            }

            $announcements = $this->CourseAnnouncements->find()->where(['course_id' => $course->id])->order(['CourseAnnouncements.created' => 'desc']);

            $this->set(compact(['announcements', 'course']));
        } catch (\Exception $e) {
            $this->Flash->error($e->getMessage());
            return $this->redirect($this->referer());
        }
    }

    public function isAuthorized($user)
    {
        // todo
        return true;
    }
}
