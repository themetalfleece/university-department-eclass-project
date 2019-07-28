<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\SaveException;

use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use Cake\Network\Exception\BadRequestException;
use Cake\Utility\Inflector;
use Cake\Utility\Text;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public $paginate = [];

    public function initialize()
    {
        parent::initialize();
        
        $this->loadComponent('EmailManager');
        $this->loadComponent('Paginator');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('UploadChecker');
        $this->loadComponent('LoggedInRedirector', [
            // redirect to homepage if one of these actions are called whilst the user is logged in
            'register' => ['redirect' => '/'],
            'confirm' => ['redirect' => '/'],
            'restorePassword' => ['redirect' => '/'],
        ]);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['register', 'logout', 'confirm', 'restorePassword']);
    }

    private function verifyRecaptcha($captchaCode) {
        $recaptcha = new \ReCaptcha\ReCaptcha(Configure::read('google-recaptcha.secret-key'));
        $resp = $recaptcha->verify($captchaCode, $this->request->clientIp());
        if (!$resp->isSuccess()) {
            throw new \Exception(__('Δεν μπορέσαμε να επιβεβαιώσουμε το recaptcha'));
        }
    }

    public function index()
    {
        $users = $this->Users->find()->order(['role' => 'desc', 'last_name' => 'asc']);

        $this->set('users', $users);
        $this->set('_serialize', 'users');
    }

    // adds a record to the appropriate table, depending on the user role
    private function createUserRole($user) {
        // todo chose what to create based on user role, not only student
        $rules = [
            'student' => [
                'model' => $this->Users->Students,
                'fields' => ['AM', 'level']
            ],
            'professor' => [
                'model' => $this->Users->Professors,
                'fields' => ['title']
            ]
        ];

        if (!array_key_exists($user->role, $rules)) {
            // this user role does not need a new entity in another table (e.g. secretary/admin)
            return;
        }

        $userRole = $rules[$user->role]['model']->newEntity();
        $userRole->user_id = $user->id;

        if (isset($rules[$user->role]['fields'])) {
            // have to patch with the request data
            $userRole = $rules[$user->role]['model']->patchEntity($userRole, $this->request->data, $rules[$user->role]['fields']);    
        }

        if (!$rules[$user->role]['model']->save($userRole)) {
            throw new \Exception(__('Υπήρξαν προβλήματα στη δημιουργία λογαριασμού ρόλου χρήστη'));
        }
    }

    public function register()
    {
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {

            $conn = ConnectionManager::get('default');

            try {
                // verify the recaptcha
                if (!array_key_exists('g-recaptcha-response', $this->request->data)) {
                    throw new \Exception(__('Δεν συμπληρώσατε το recaptcha'));
                }

                $this->verifyRecaptcha($this->request->data['g-recaptcha-response']);

                $userData = $this->request->data;

                // generate the confirmation link for the user
                $userData['confirm_link'] = Text::uuid();
                // generate the unique identifier for the user
                $userData['identifier'] = Text::uuid();

                // try to save the user
                $user = $this->Users->patchEntity($user, $userData);

                $conn->begin();

                if (!$this->Users->save($user)) {
                    throw new SaveException(__('Υπήρξαν προβλήματα στη δημιουργία του χρήστη:'), $user->errors());
                }

                // create student/professor/secretary etc
                $this->createUserRole($user);

                $this->EmailManager->sendConfirmationEmail($user->email, $user->confirm_link);

                $conn->commit();

            } catch(SaveException $e) {
                $this->Flash->error($e->getModelErrors());
                return $this->redirect(['action' => 'register']);
            } catch(\Exception $e) {
                $this->Flash->error($e->getMessage());
                return $this->redirect(['action' => 'register']);
            }

            $this->Flash->success(__('Ελέξτε το email σας για το link επιβεβαίωσης!'));
            return $this->redirect('/');
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    // to confirm the email of a user
    public function confirm() {
        if (!array_key_exists('id', $this->request->query)) {
            $this->Flash->error(__('Λανθασμένο λινκ επιβεβαίωσης'));
            return $this->redirect('/');
        }

        $user = $this->Users
            ->find()
            ->where(['confirm_link' => $this->request->query['id']])
            ->first();

        if (!$user) {
            $this->Flash->error(__('Δεν υπάρχει τέτοιος χρήστης προς επιβεβαίωση'));
            return $this->redirect('/');
        }

        $user->confirmed = 1;

        if (!$this->Users->save($user)) {
            $this->Flash->error(__('Υπήρξαν προβλήματα στην επιβεβαίωση του χρήστη. Παρακαλώ προσπαθήστε αργότερα'));
            return $this->redirect('/');
        }

        if ($user->role === 'student' || $user->user_confirmed) {
            // nothing else is needed to confirm the account
            $this->Flash->success(__('Ο λογαριασμός σας επιβεβαιώθηκε επιτυχώς'));
            $this->Auth->setUser($user);
            return $this->redirect(['action' => 'home']);
        }

        $this->Flash->success(__('Το email σας επιβεβαιώθηκε, αλλά ο διαχειριστής θα πρέπει να επιβεβαιώσει και τον λογαριασμό σας πριν μπορέσετε να κάνετε login (θα λάβετε σχετικό email)'));
        return $this->redirect('/'); 
    }

    // to confirm the user itself (for professors and secretaries)
    public function confirmUser() {
        $this->request->allowMethod(['post']);

        if (!isset($this->request->data['id']) || !isset($this->request->data['user_confirmed'])) {
            throw new BadRequestException();
        }

        $response = ['success' => true];

        try {
            $user = $this->Users->get($this->request->data['id']);

            if (!$user) {
                throw new \Exception();
            }

            $user = $this->Users->patchEntity($user, $this->request->data, ['user_confirmed']);

            if (!$this->Users->save($user)) {
                throw new \Exception();
            }
        } catch (\Exception $e) {
            $response['success'] = false;
        }

        $this->response->type('application/json');

        $this->set('response', $response);
        $this->set('_serialize', 'response');
    }

    private function userHomePage() {
        // this will fail unless routes.php is correctly configured
        return '/' . $this->Auth->user('role') . '/' . $this->Auth->user('last_name');
    }

    public function login()
    {
        if ($this->request->is('get')) {
            return $this->redirect('/');
        }

        $this->request->allowMethod(['post']);

        if ($this->Auth->user()) {
            return $this->redirect($this->userHomePage());
        }

        $user = $this->Auth->identify();

        if ($user) {
            if ($user['confirmed'] === false) {
                $this->Flash->error(__('Δεν μπορείτε να κάνετε login χωρίς να έχετε επιβεβαιώσει το email σας'));
                return $this->redirect('/');
            }

            if (in_array($user['role'], ['professor', 'secretary', 'admin'])) {
                // these roles should be confirmed by the admin as well
                if ($user['user_confirmed'] === false) {
                    $this->Flash->error(__('Ο ρόλος σας ως "{0}" δεν έχει επιβεβαιωθεί ακόμα από τον διαχειριστή της σελίδας', Configure::read('user.rolesTranslated')[$user['role']]));
                    return $this->redirect('/');
                }
            }

            $this->Auth->setUser($user);
            return $this->redirect($this->userHomePage());
        }

        $this->Flash->error(__('Μη έγκυρος συνδυασμός email / κωδικού'));
        return $this->redirect('/');
    }

    public function restorePassword() {
        if ($this->request->is('post')) {
            // user has given their email in order to restore their password
            try {
                $isEmail = array_key_exists('email', $this->request->data);
                $isPassword = array_key_exists('password', $this->request->data);
                if (!$isEmail && !$isPassword) {
                    throw new \Exception(__('Μη έγκυρο αίτημα'));
                }

                if ($isEmail) {
                    $user = $this->Users->find()->where(['email' => $this->request->data['email']])->first();

                    if ($user) {
                        if (empty($user->restore_link)) {
                            // create the user restore link
                            $user->restore_link = Text::uuid();
                            if (!$this->Users->save($user)) {
                                throw new \Exception(__('Υπήρξε ένα εσωτερικό πρόβλημα με το αίτημά σας. Παρακαλώ προσπαθήστε αργότερα'));
                            }
                        }
                        $this->EmailManager->sendPasswordRestoreEmail($user->email, $user->restore_link);
                    }

                    $this->Flash->success(__('Αν υπάρχει χρήστης με το συγκεκριμένο email ({0}), έχει λάβει ένα email με οδηγίες για την ανάκτηση κωδικού', $this->request->data['email']));
    
                } else if ($isPassword) {
                    if (!array_key_exists('restoreLink', $this->request->data)) {
                        throw new \Exception(__('Μη έγκυρο id ανάκτησης κωδικού'));
                    }

                    $user = $this->Users->find()->where(['restore_link' => $this->request->data['restoreLink']])->first();

                    if (!$user) {
                        throw new \Exception(__('Μη έγκυρο id ανάκτησης κωδικού'));
                    }

                    $user->restore_link = '';
                    $user->password = $this->request->data['password'];

                    if (!$this->Users->save($user)) {
                        throw new \Exception(__('Υπήρξε ένα εσωτερικό πρόβλημα με το αίτημά σας. Παρακαλώ προσπαθήστε αργότερα'));
                    }

                    $this->Flash->success(__('Μπορείτε τώρα να κάνετε login με τον νέο σας κωδικό'));

                    return $this->redirect('/');
                }
                
            } catch (\Exception $e) {
                $this->Flash->error($e->getMessage());
            }
        } else if ($this->request->is('get') && array_key_exists('id', $this->request->query)) {
            try {
                $user = $this->Users->find()->where(['restore_link' => $this->request->query['id']])->first();
                if (!$user) {
                    throw new \Exception(__('Μη έγκυρο id ανάκτησης κωδικού'));
                }

                // user exists
                $this->set('proceedToChange', true);
                $this->set('restoreLink', $user->restore_link);
            } catch(\Exception $e) {
                $this->Flash->error($e->getMessage());
            }
        } // else just display the page that user inputs their email
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
            ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
            ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function home() {
        // todo is this function really needed?
        return $this->redirect($this->userHomePage());
    }

    private function processNewUserImage()
    {
        $extension = pathinfo($this->request->data['image']['name'])['extension'];
        $filename = Text::uuid() . '.' . $extension;

        if (!move_uploaded_file($this->request->data['image']['tmp_name'], Configure::read('user.profile-pictures-dir.absolute') . $filename)) {
            throw new \Exception('Υπήρξε ένα πρόβλημα στο ανέβασμα της εικόνας σας');
        }

        if (!empty($user->picture)) {
            // delete the old user picture
            unlink(Configure::read('user.profile-pictures-dir.absolute') . $user->picture);
        }

        return $filename;
    }

    public function settings() {
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->contain(['UserPhones', 'UserEmails'])->first();
        if ($this->request->is('post')) {

            $patchOptions = [
                'fieldList' => ['timezone', 'user_phones', 'user_emails'],
                'associated' => ['UserPhones' => ['phone'], 'UserEmails' => ['email']]
            ];

            try {
                if (!empty($this->request->data['image']) && !empty($this->request->data['image']['tmp_name'])) {
                    // the user has changed their profile picture!
                    $this->UploadChecker->throwIfError($this->request->data['image']);
                    $this->request->data['picture'] = $this->processNewUserImage($user);

                    $patchOptions['fieldList'][] = 'picture';
                }

                $user = $this->Users->patchEntity($user, $this->request->data, $patchOptions);
            
                if (!$this->Users->save($user)) {
                    throw new SaveException(__('Οι ρυθμίσεις σας δεν μπόρεσαν να αποθηκευτούν:'), $user->errors());
                }

                $this->Auth->setUser($user);

                $this->Flash->success(__('Οι ρυθμίσεις σας αποθηκεύτηκαν επιτυχώς'));
            } catch(SaveException $e) {
                $this->Flash->error($e->getModelErrors());
            } catch (\Exception $e) {
                $this->Flash->error($e->getMessage());
            }
        }

        $this->set('settingsUser', $user);
    }

    public function isAuthorized($user) {
        if (in_array($this->request->action, ['home', 'settings'])) {
            return true;
        }

        if ($this->request->action === 'confirmUser') {
            // secretaries can confirm professors and other secretaries (they cannot confirm admins though)
            if ($this->Auth->user('role') === 'secretary' && isset($this->request->data['id'])) {
                $user = $this->Users->get($this->request->data['id']);

                if ($user && in_array($user->role, ['professor', 'secretary'])) {
                    return true;
                }
            }
        }

        return parent::isAuthorized($user);
    }
}
