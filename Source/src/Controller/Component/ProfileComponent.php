<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Routing\Router;
use Cake\Utility\Inflector;

class ProfileComponent extends Component
{

    private $role;
    private $users;
    private $controller;

    public function initialize(array $config) {
        $this->role = $config['role'];
        $this->controller = $this->_registry->getController();
        $this->users = $this->controller->loadModel('Users');
    }

    public function beforeFilter(Event $event)
    {
        $request = $this->controller->request;

        if ($request->action !== 'profile') {
            return;
        }

        if (count($request['pass']) === 0) {
            $this->controller->Flash(__('Δεν δηλώσατε αναγνωριστικό χρήστη'));
            return $this->controller->redirect('/');
        }

        $identifier = $request['pass'][0];

        $user = $this->users->find()->where([
            'identifier' => $identifier,
            'role' => $this->role
        ])->first();

        if (!$user) {
            $user = $this->users->find()->where([
                'identifier' => $identifier
            ])->first();

            if (!$user) {
                // user identifier does not even exist
                throw new NotFoundException(__('Το προφίλ του χρήστη δεν βρέθηκε'));
            }

            // user exists, but other profile
            return $this->controller->redirect('/' . Inflector::pluralize($user->role) . '/' . $identifier);
        }
    }
}