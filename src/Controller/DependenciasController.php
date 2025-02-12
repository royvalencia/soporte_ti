<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Dependencias Controller
 *
 * @property \App\Model\Table\DependenciasTable $Dependencias
 *
 * @method \App\Model\Entity\Dependencia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DependenciasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $dependencias = $this->paginate($this->Dependencias);

        $this->set(compact('dependencias'));
    }

    /**
     * View method
     *
     * @param string|null $id Dependencia id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dependencia = $this->Dependencias->get($id, [
            'contain' => []
        ]);

        $this->set('dependencia', $dependencia);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dependencia = $this->Dependencias->newEntity();
        if ($this->request->is('post')) {
            $dependencia = $this->Dependencias->patchEntity($dependencia, $this->request->getData());
            if ($this->Dependencias->save($dependencia)) {
                $this->Flash->success(__('The dependencia has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dependencia could not be saved. Please, try again.'));
        }
        $this->set(compact('dependencia'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dependencia id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dependencia = $this->Dependencias->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dependencia = $this->Dependencias->patchEntity($dependencia, $this->request->getData());
            if ($this->Dependencias->save($dependencia)) {
                $this->Flash->success(__('The dependencia has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dependencia could not be saved. Please, try again.'));
        }
        $this->set(compact('dependencia'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dependencia id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dependencia = $this->Dependencias->get($id);
        if ($this->Dependencias->delete($dependencia)) {
            $this->Flash->success(__('The dependencia has been deleted.'));
        } else {
            $this->Flash->error(__('The dependencia could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
