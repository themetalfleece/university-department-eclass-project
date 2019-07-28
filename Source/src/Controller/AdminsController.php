<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Inflector;

/**
 * Admins Controller
 *
 * @property \App\Model\Table\AdminsTable $Admins
 */
class AdminsController extends AppController
{
	public function initialize()
    {
        parent::initialize();

        $this->loadModel('Users');
        $this->loadModel('Professors');
        $this->loadModel('Students');

        $this->loadComponent('Profile', ['role' => 'admin']);
    }

    public function index() {
        $query = $this->Users->find()->where(['role' => 'admin']);

        $admins = $this->paginate($query);

        $this->set('admins', $admins);
    }

    public function home($lastName = null) {
        if ($lastName !== $this->Auth->user('last_name')) {
            return $this->redirect(['action' => 'home', $this->Auth->user('last_name')]);
        }

        $allProfessors = $this->Professors->find();
        $unverifiedProfessors = $this->Users->find('role', ['role' => 'professor'])->where(['user_confirmed' => 0]);

        $allSecretaries = $this->Users->find('role', ['role' => 'secretary']);
        $unverifiedSecretaries = $this->Users->find('role', ['role' => 'secretary'])->where(['user_confirmed' => 0]);

        $allAdmins = $this->Users->find('role', ['role' => 'admin']);
        $unverifiedAdmins = $this->Users->find('role', ['role' => 'admin'])->where(['user_confirmed' => 0]);

        $students = $this->Students->find();

        $this->set('professors', ['all' => $allProfessors->count(), 'unverified' => $unverifiedProfessors->count()]);
        $this->set('secretaries', ['all' => $allSecretaries->count(), 'unverified' => $unverifiedSecretaries->count()]);
        $this->set('admins', ['all' => $allAdmins->count(), 'unverified' => $unverifiedAdmins->count()]);
        $this->set('students', $students->count());
    }
}
