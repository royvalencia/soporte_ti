<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Direcciones Controller
 *
 * @property \App\Model\Table\DireccionesTable $Direcciones
 *
 * @method \App\Model\Entity\Direccione[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DireccionesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $direcciones = $this->paginate($this->Direcciones);

        $this->set(compact('direcciones'));
    }

    /**
     * View method
     *
     * @param string|null $id Direccione id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $direccione = $this->Direcciones->get($id, [
            'contain' => []
        ]);

        $this->set('direccione', $direccione);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $direccione = $this->Direcciones->newEntity();
        if ($this->request->is('post')) {
            $direccione = $this->Direcciones->patchEntity($direccione, $this->request->getData());
            if ($this->Direcciones->save($direccione)) {
                $this->Flash->success(__('The direccione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The direccione could not be saved. Please, try again.'));
        }
        $this->set(compact('direccione'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Direccione id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $direccione = $this->Direcciones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $direccione = $this->Direcciones->patchEntity($direccione, $this->request->getData());
            if ($this->Direcciones->save($direccione)) {
                $this->Flash->success(__('The direccione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The direccione could not be saved. Please, try again.'));
        }
        $this->set(compact('direccione'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Direccione id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $direccione = $this->Direcciones->get($id);
        if ($this->Direcciones->delete($direccione)) {
            $this->Flash->success(__('The direccione has been deleted.'));
        } else {
            $this->Flash->error(__('The direccione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
