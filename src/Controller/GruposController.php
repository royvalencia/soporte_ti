<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Grupos Controller
 *
 * @property \App\Model\Table\GruposTable $Grupos
 *
 * @method \App\Model\Entity\Grupo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GruposController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        

        $this->paginate = [
            'contain' => ['CoGroups']
        ];
        $grupos = $this->paginate($this->Grupos);

        
        $this->set(compact('grupos'));
    }

    /**
     * View method
     *
     * @param string|null $id Grupo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $grupo = $this->Grupos->get($id, [
            'contain' => ['CoGroups']
        ]);

        $coGroups = $this->Grupos->CoGroups->find('list', array(
            'conditions' => array(
                'tipo IN' => array(2)
            ),
            'order' => array('name' => 'ASC')
        ));

       
        $this->set(compact('grupo','coGroups'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $grupo = $this->Grupos->newEntity();
        if ($this->request->is('post')) {
            $grupo = $this->Grupos->patchEntity($grupo, $this->request->getData());
            if ($this->Grupos->save($grupo)) {
                $this->Flash->success(__('The grupo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grupo could not be saved. Please, try again.'));
        }

        $coGroups = $this->Grupos->CoGroups->find('list', array(
            'conditions' => array(
                'tipo IN' => array(1, 2)
            ),
            'order' => array('name' => 'ASC')
        ));

        $this->set(compact('grupo','coGroups'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Grupo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $grupo = $this->Grupos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $grupo = $this->Grupos->patchEntity($grupo, $this->request->getData());
            if ($this->Grupos->save($grupo)) {
                $this->Flash->success(__('The grupo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grupo could not be saved. Please, try again.'));
        }
        $coGroups = $this->Grupos->CoGroups->find('list', array(
            'conditions' => array(
                'tipo IN' => array(2)
            ),
            'order' => array('name' => 'ASC')
        ));
        $this->set(compact('grupo','coGroups'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Grupo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $grupo = $this->Grupos->get($id);
        if ($this->Grupos->delete($grupo)) {
            $this->Flash->success(__('The grupo has been deleted.'));
        } else {
            $this->Flash->error(__('The grupo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
