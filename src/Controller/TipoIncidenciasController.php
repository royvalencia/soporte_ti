<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TipoIncidencias Controller
 *
 * @property \App\Model\Table\TipoIncidenciasTable $TipoIncidencias
 *
 * @method \App\Model\Entity\TipoIncidencia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TipoIncidenciasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $tipoIncidencias = $this->paginate($this->TipoIncidencias);

        $this->set(compact('tipoIncidencias'));
    }

    /**
     * View method
     *
     * @param string|null $id Tipo Incidencia id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tipoIncidencia = $this->TipoIncidencias->get($id, [
            'contain' => []
        ]);

        $this->set('tipoIncidencia', $tipoIncidencia);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tipoIncidencia = $this->TipoIncidencias->newEntity();
        if ($this->request->is('post')) {
            $tipoIncidencia = $this->TipoIncidencias->patchEntity($tipoIncidencia, $this->request->getData());
            if ($this->TipoIncidencias->save($tipoIncidencia)) {
                $this->Flash->success(__('The tipo incidencia has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipo incidencia could not be saved. Please, try again.'));
        }
        $this->set(compact('tipoIncidencia'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tipo Incidencia id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tipoIncidencia = $this->TipoIncidencias->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tipoIncidencia = $this->TipoIncidencias->patchEntity($tipoIncidencia, $this->request->getData());
            if ($this->TipoIncidencias->save($tipoIncidencia)) {
                $this->Flash->success(__('The tipo incidencia has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipo incidencia could not be saved. Please, try again.'));
        }
        $this->set(compact('tipoIncidencia'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tipo Incidencia id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tipoIncidencia = $this->TipoIncidencias->get($id);
        if ($this->TipoIncidencias->delete($tipoIncidencia)) {
            $this->Flash->success(__('The tipo incidencia has been deleted.'));
        } else {
            $this->Flash->error(__('The tipo incidencia could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
