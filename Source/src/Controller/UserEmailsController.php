<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserEmails Controller
 *
 * @property \App\Model\Table\UserEmailsTable $UserEmails
 */
class UserEmailsController extends AppController
{

    /**
     * Delete method
     *
     * @param string|null $id User Email id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['ajax']);

        $response = [
            'success' => true
        ];

        try {
            $userEmail = $this->UserEmails->get($id);
            if (!$this->UserEmails->delete($userEmail)) {
                throw new \Exception();
            }    
        } catch (\Exception $e) {
            $response['success'] = false;
        }

        $this->set('response', $response);
        $this->set('_serialize', 'response');
    }

    public function isAuthorized($user) {
        if ($this->request->action === 'delete') {
            if (isset($this->request->params['pass'][0])) {
                $id = $this->request->params['pass'][0];

                $entity = $this->UserEmails->get($id);

                if ($entity && $entity->user_id === $user['id']) {
                    \Cake\Log\Log::write('error', 'It belongs to the user');
                    return true; // it belongs to the user
                }
            }
        }

        return parent::isAuthorized($user);
    }
}
