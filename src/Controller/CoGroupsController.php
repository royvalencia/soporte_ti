<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CoGroups Controller
 *
 * @property \App\Model\Table\CoGroupsTable $CoGroups
 */
class CoGroupsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
       
        $coGroups = $this->paginate($this->CoGroups);

        $this->set(compact('coGroups'));
        $this->set('_serialize', ['coGroups']);
    }

    /**
     * View method
     *
     * @param string|null $id Co Group id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coGroup = $this->CoGroups->get($id, [
            'contain' => ['CoPermissions', 'CoMenus', 'CoUsers']
        ]);

        $this->set('coGroup', $coGroup);
        $this->set('_serialize', ['coGroup']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coGroup = $this->CoGroups->newEntity();
        if ($this->request->is('post')) {
            $this->log($this->request->data);
            $coGroup = $this->CoGroups->patchEntity($coGroup, $this->request->data);
            $this->log($coGroup);
            $coGroup->dirty('co_groups_permissions',true);
            if ($this->CoGroups->save($coGroup)) {
                $this->Flash->success(__('Grupo agregado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El Grupo no fue agregado, intente de nuevo.'));
            }
        }
        $coPermissions = $this->CoGroups->CoPermissions->find('list', ['limit' => 200]);
        $coMenus = $this->CoGroups->CoMenus->find('list', ['limit' => 200]);
        $this->set(compact('coGroup', 'coPermissions', 'coMenus'));
        $this->set('_serialize', ['coGroup']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Co Group id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coGroup = $this->CoGroups->get($id, [
            'contain' => ['CoPermissions', 'CoMenus']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coGroup = $this->CoGroups->patchEntity($coGroup, $this->request->data);
            if ($this->CoGroups->save($coGroup)) {
                $this->Flash->success(__('Grupo editado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El Grupo no fue editado, intente de nuevo.'));
            }
        }
        $coPermissions = $this->CoGroups->CoPermissions->find('list', ['limit' => 200]);
        $coMenus = $this->CoGroups->CoMenus->find('list', ['limit' => 200]);
        $this->set(compact('coGroup', 'coPermissions', 'coMenus'));
        $this->set('_serialize', ['coGroup']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Co Group id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coGroup = $this->CoGroups->get($id);
        if ($this->CoGroups->delete($coGroup)) {
            $this->Flash->success(__('Grupo Eliminado.'));
        } else {
            $this->Flash->error(__('El gruupo no fue eliminado.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
