<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Sectors Controller
 *
 * @property \App\Model\Table\SectorsTable $Sectors
 */
class SectorsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $sectors = $this->paginate($this->Sectors);

        $this->set(compact('sectors'));
        $this->set('_serialize', ['sectors']);
    }

    /**
     * View method
     *
     * @param string|null $id Sector id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sector = $this->Sectors->get($id, [
            'contain' => ['Courses']
        ]);

        $this->set('sector', $sector);
        $this->set('_serialize', ['sector']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sector = $this->Sectors->newEntity();
        if ($this->request->is('post')) {
            $sector = $this->Sectors->patchEntity($sector, $this->request->data);
            if ($this->Sectors->save($sector)) {
                $this->Flash->success(__('Ο τομέας έχει αποθηκευτεί'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Δεν μπορέσαμε να αποθηκεύσουμε τον τομέα. Παρακαλώ προσπαθήστε ξανά'));
            }
        }
        $this->set(compact('sector'));
        $this->set('_serialize', ['sector']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sector id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sector = $this->Sectors->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sector = $this->Sectors->patchEntity($sector, $this->request->data);
            if ($this->Sectors->save($sector)) {
                $this->Flash->success(__('Ο τομέας έχει αποθηκευτεί'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Δεν μπορέσαμε να αποθηκεύσουμε τον τομέα. Παρακαλώ προσπαθήστε ξανά'));
            }
        }
        $this->set(compact('sector'));
        $this->set('_serialize', ['sector']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sector id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sector = $this->Sectors->get($id);
        if ($this->Sectors->delete($sector)) {
            $this->Flash->success(__('The sector has been deleted.'));
        } else {
            $this->Flash->error(__('The sector could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        // todo really allow sec to do anything here?
        if ($user['role'] === 'secretary') {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
