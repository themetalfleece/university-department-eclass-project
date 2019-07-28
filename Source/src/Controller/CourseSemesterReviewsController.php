<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\SaveException;

/**
 * CourseSemesterReviews Controller
 *
 * @property \App\Model\Table\CourseSemesterReviewsTable $CourseSemesterReviews
 */
class CourseSemesterReviewsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($courseId)
    {
        $courseSemesterReviews = $this->CourseSemesterReviews->find()
            ->matching('CoursesSemesters', function ($q) use ($courseId) {
                return $q->where(['course_id' => $courseId]);
            })
            ->contain('CoursesSemesters.Semesters')
            ->groupBy('courses_semester.semester.id');

        $latestSemester = $this->CourseSemesterReviews->CoursesSemesters->find()->contain('Semesters')->where(['course_id' => $courseId])
            ->order(['semester_id' => 'desc'])->first();

        if ($latestSemester and isset($latestSemester->semester) and !empty($latestSemester->semester)) {
            $latestSemester = $latestSemester->semester;
        }

        $course = $this->CourseSemesterReviews->CoursesSemesters->Courses->get($courseId);

        $this->set(compact('courseSemesterReviews', 'course', 'latestSemester'));
        $this->set('_serialize', ['courseSemesterReviews', 'course', 'latestSemester']);
    }

    public function getReviews()
    {
        $this->request->allowMethod(['ajax']);

        $courseId = $this->request->query['courseId'];
        $semesterId = $this->request->query['semesterId'];

        $csId = $this->CourseSemesterReviews->CoursesSemesters->find()->where(['course_id' => $courseId, 'semester_id' => $semesterId])->first()->id;

        $ratings = $this->CourseSemesterReviews->find()
            ->where(['course_semester_id' => $csId, 'approved' => true])->order(['id' => 'desc']);

        $userRating = $this->CourseSemesterReviews->find()->where(['course_semester_id' => $csId, 'user_id' => $this->Auth->user('id')])->first();

        $ratingsCount = $ratings->count();
        $ratingsSum = $ratings->sumOf('rating_stars');

        $this->set('ratings', $this->viewBuilder()->build()->element('Course/ratings', ['csId' => $csId, 'ratings' => $ratings, 'avg' => $ratingsCount === 0 ? 0 : $ratingsSum / $ratingsCount, 'userRating' => $userRating]));

        $this->set('_serialize', ['ratings']);
    }

    public function add()
    {
        $courseSemesterReview = $this->CourseSemesterReviews->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['user_id'] = $this->Auth->user('id');
            $courseSemesterReview = $this->CourseSemesterReviews->patchEntity($courseSemesterReview, $this->request->data);

            if (isset($courseSemesterReview->rating_text) and empty($courseSemesterReview->rating_text)) {
                $courseSemesterReview->approved = true; // no need for approval if doesn't have text
            }

            try {
                if (!$this->CourseSemesterReviews->save($courseSemesterReview)) {
                    throw new SaveException(__('Παρουσιάστηκαν προβλήματα κατά την αποθήκευση της κριτικής σας:'), $courseSemesterReview->errors());

                    $this->Flash->success(__('Η κριτική σας αποθηκεύτηκε με επιτυχία'));

                }
            } catch (SaveException $e) {
                $this->Flash->error($e->getModelErrors());
            }
        }

        $coursesSemesters = $this->CourseSemesterReviews->CoursesSemesters->find('list', ['limit' => 200]);
        $this->set(compact('courseSemesterReview', 'coursesSemesters'));
        $this->set('_serialize', ['courseSemesterReview']);
        return $this->redirect($this->referer());
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $courseSemesterReview = $this->CourseSemesterReviews->get($id);
        if ($this->CourseSemesterReviews->delete($courseSemesterReview)) {
            $this->Flash->success(__('Η κριτική διαγράφθηκε'));
        } else {
            $this->Flash->error(__('Δεν μπορέσαμε να διαγράψουμε την κριτική. Παρακαλώ προσπαθήστε ξανά'));
        }

        return $this->redirect($this->referer());
    }

    public function approve($id = null)
    {
        if ($this->request->is('post')) {
            $review = $this->CourseSemesterReviews->get($id);
            $review->approved = true;
            if ($this->CourseSemesterReviews->save($review)) {
                $this->Flash->success(__('Η κριτική εγκρίθηκε με επιτυχία'));
            }
        }

        $reviews = $this->CourseSemesterReviews->find()->contain(['CoursesSemesters.Courses'])->where(['approved' => false])->order(['CourseSemesterReviews.id' => 'asc']);
        $this->set('reviews', $reviews);
    }

    public function isAuthorized($user) {
        if (in_array($this->request->action, ['approve', 'delete']) && !in_array($user['role'], ['admin', 'secretary'])) {
            return false;
        }

        return true;
    }
}
