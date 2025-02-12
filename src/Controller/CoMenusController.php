<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CoMenus Controller
 *
 * @property \App\Model\Table\CoMenusTable $CoMenus
 */
class CoMenusController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $coMenus = $this->paginate($this->CoMenus);

        $this->set(compact('coMenus'));
        $this->set('_serialize', ['coMenus']);
    }

    /**
     * View method
     *
     * @param string|null $id Co Menu id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coMenu = $this->CoMenus->get($id, [
            'contain' => ['CoGroups']
        ]);

        $this->set('coMenu', $coMenu);
        $this->set('_serialize', ['coMenu']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coMenu = $this->CoMenus->newEntity();
        if ($this->request->is('post')) {
            $coMenu = $this->CoMenus->patchEntity($coMenu, $this->request->data);
            if ($this->CoMenus->save($coMenu)) {
                $this->Flash->success(__('Menú agregado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El menú no fue agregado, intente de nuevo.'));
            }
        }
        $coGroups = $this->CoMenus->CoGroups->find('list', ['limit' => 200]);
        $coMenus = $this->CoMenus->find('list', ['conditions'=>['CoMenus.id_padre'=>0], 'limit' => 200]);
        $this->set(compact('coMenu', 'coGroups','coMenus'));
        $this->set('_serialize', ['coMenu']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Co Menu id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coMenu = $this->CoMenus->get($id, [
            'contain' => ['CoGroups']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coMenu = $this->CoMenus->patchEntity($coMenu, $this->request->data);
            if ($this->CoMenus->save($coMenu)) {
                $this->Flash->success(__('Menú actualizado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El menú no fue actualizado, intente de nuevo.'));
            }
        }
        $coGroups = $this->CoMenus->CoGroups->find('list', ['limit' => 200]);
        $coMenus = $this->CoMenus->find('list', ['conditions'=>['CoMenus.id_padre'=>0], 'limit' => 200]);
        $this->set(compact('coMenu', 'coGroups','coMenus'));
        $this->set('_serialize', ['coMenu']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Co Menu id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coMenu = $this->CoMenus->get($id);
        if ($this->CoMenus->delete($coMenu)) {
            $this->Flash->success(__('Menú eliminado.'));
        } else {
            $this->Flash->error(__('El menú no fue eliminado.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
