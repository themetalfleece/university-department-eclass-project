<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Secretaries Controller
 *
 * @property \App\Model\Table\SecretariesTable $Secretaries
 */
class SecretariesController extends AppController
{

    public function initialize() {
        parent::initialize();

        $this->loadModel('Users');
        $this->loadModel('Professors');
        $this->loadModel('Students');

        $this->loadComponent('Profile', ['role' => 'secretary']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['profile']);
    }

    public function profile($userIdentifier)
    {
        // the profile component assures us that  the profile exists (it would redirect in other case or show a 404 error)
        $user = $this->Users->find()->where(['identifier' => $userIdentifier])->contain(['UserPhones', 'UserEmails'])->first();

        $this->set('profileUser', $user);
    }

    public function index()
    {
        $query = $this->Users->find('role', ['role' => 'secretary']);
        
        $secretaries = $this->paginate($query);

        $this->set(compact('secretaries'));
        // $this->set('_serialize', ['secretaries']);
    }

    public function home($lastName = null)
    {
        if ($lastName !== $this->Auth->user('last_name')) { //todo move this check to a component because the controllers share it
            return $this->redirect(['action' => 'home', $this->Auth->user('last_name')]);
        }

        $allProfessors = $this->Professors->find();
        $unverifiedProfessors = $this->Users->find('role', ['role' => 'professor'])->where(['user_confirmed' => 0]);

        $allSecretary = $this->Users->find('role', ['role' => 'secretary']);
        $unverifiedSecretary = $this->Users->find('role', ['role' => 'secretary'])->where(['user_confirmed' => 0]);

        $students = $this->Students->find();

        $this->loadModel('CourseSemesterReviews');

        $this->set('professors', ['all' => $allProfessors->count(), 'unverified' => $unverifiedProfessors->count()]);
        $this->set('secretaries', ['all' => $allProfessors->count(), 'unverified' => $unverifiedProfessors->count()]);
        $this->set('ratingCount', $this->CourseSemesterReviews->find()->where(['approved' => false])->count());
        $this->set('students', $students->count());
    }

    public function isAuthorized($user) {
        if ($user['role'] === 'secretary')  {
            return true; // todo
        }
        
        return parent::isAuthorized($user);
    }
}
