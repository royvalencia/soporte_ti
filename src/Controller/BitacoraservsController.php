<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bitacoraservs Controller
 *
 * @property \App\Model\Table\BitacoraservsTable $Bitacoraservs
 *
 * @method \App\Model\Entity\Bitacoraserv[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BitacoraservsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Servicios']
        ];
        $bitacoraservs = $this->paginate($this->Bitacoraservs);

        $this->set(compact('bitacoraservs'));
    }

    /**
     * View method
     *
     * @param string|null $id Bitacoraserv id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bitacoraserv = $this->Bitacoraservs->get($id, [
            'contain' => ['Servicios']
        ]);

        $this->set('bitacoraserv', $bitacoraserv);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bitacoraserv = $this->Bitacoraservs->newEntity();
        if ($this->request->is('post')) {
            $bitacoraserv = $this->Bitacoraservs->patchEntity($bitacoraserv, $this->request->getData());
            if ($this->Bitacoraservs->save($bitacoraserv)) {
                $this->Flash->success(__('The bitacoraserv has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bitacoraserv could not be saved. Please, try again.'));
        }
        $servicios = $this->Bitacoraservs->Servicios->find('list', ['limit' => 200]);
        $this->set(compact('bitacoraserv', 'servicios'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bitacoraserv id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bitacoraserv = $this->Bitacoraservs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bitacoraserv = $this->Bitacoraservs->patchEntity($bitacoraserv, $this->request->getData());
            if ($this->Bitacoraservs->save($bitacoraserv)) {
                $this->Flash->success(__('The bitacoraserv has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bitacoraserv could not be saved. Please, try again.'));
        }
        $servicios = $this->Bitacoraservs->Servicios->find('list', ['limit' => 200]);
        $this->set(compact('bitacoraserv', 'servicios'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bitacoraserv id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bitacoraserv = $this->Bitacoraservs->get($id);
        if ($this->Bitacoraservs->delete($bitacoraserv)) {
            $this->Flash->success(__('The bitacoraserv has been deleted.'));
        } else {
            $this->Flash->error(__('The bitacoraserv could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
