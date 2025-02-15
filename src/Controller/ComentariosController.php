<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Comentarios Controller
 *
 * @property \App\Model\Table\ComentariosTable $Comentarios
 *
 * @method \App\Model\Entity\Comentario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ComentariosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Servicios', 'CoUsers']
        ];
        $comentarios = $this->paginate($this->Comentarios);

        $this->set(compact('comentarios'));
    }

    /**
     * View method
     *
     * @param string|null $id Comentario id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comentario = $this->Comentarios->get($id, [
            'contain' => ['Servicios', 'CoUsers']
        ]);

        $this->set('comentario', $comentario);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comentario = $this->Comentarios->newEntity();
        if ($this->request->is('post')) {
            $comentario = $this->Comentarios->patchEntity($comentario, $this->request->getData());
            if ($this->Comentarios->save($comentario)) {
                $this->Flash->success(__('The comentario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comentario could not be saved. Please, try again.'));
        }
        $servicios = $this->Comentarios->Servicios->find('list', ['limit' => 200]);
        $coUsers = $this->Comentarios->CoUsers->find('list', ['limit' => 200]);
        $this->set(compact('comentario', 'servicios', 'coUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Comentario id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comentario = $this->Comentarios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comentario = $this->Comentarios->patchEntity($comentario, $this->request->getData());
            if ($this->Comentarios->save($comentario)) {
                $this->Flash->success(__('The comentario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comentario could not be saved. Please, try again.'));
        }
        $servicios = $this->Comentarios->Servicios->find('list', ['limit' => 200]);
        $coUsers = $this->Comentarios->CoUsers->find('list', ['limit' => 200]);
        $this->set(compact('comentario', 'servicios', 'coUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comentario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comentario = $this->Comentarios->get($id);
        if ($this->Comentarios->delete($comentario)) {
            $this->Flash->success(__('The comentario has been deleted.'));
        } else {
            $this->Flash->error(__('The comentario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
