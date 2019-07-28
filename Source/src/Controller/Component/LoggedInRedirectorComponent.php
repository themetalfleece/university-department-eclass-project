<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Routing\Router;

class LoggedInRedirectorComponent extends Component
{
    private $config;

    public function initialize(array $config) {
        $this->config = $config;
    }

    public function beforeFilter(Event $event)
    {
        $controller = $event->subject();

        if (!$controller->Auth->user()) {
            return; // the user is not logged in
        }

        $requestedAction = $controller->request->params['action'];

        if (!array_key_exists($requestedAction, $this->config)) {
            return; // the action is not configured for any redirection
        }

        if (!array_key_exists('redirect', $this->config[$requestedAction])) {
            return; // the action is configured, but does not specify any redirection
        }

        if (array_key_exists('exceptExt', $this->config[$requestedAction]) &&
            $this->config[$requestedAction]['exceptExt'] === $controller->request->params['_ext']) {
            return; // the action is configured for redirect, but not for this extension (e.g. json, xml etc)
        }

        // redirect the user
        return $controller->redirect($this->config[$requestedAction]['redirect']);
    }
}