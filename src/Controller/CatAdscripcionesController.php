<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CatAdscripciones Controller
 *
 * @property \App\Model\Table\CatAdscripcionesTable $CatAdscripciones
 *
 * @method \App\Model\Entity\CatAdscripcione[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CatAdscripcionesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CatInstituciones']
        ];
        $catAdscripciones = $this->paginate($this->CatAdscripciones);

        $this->set(compact('catAdscripciones'));
    }

    /**
     * View method
     *
     * @param string|null $id Cat Adscripcione id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $catAdscripcione = $this->CatAdscripciones->get($id, [
            'contain' => ['CatInstituciones']
        ]);

        $this->set('catAdscripcione', $catAdscripcione);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $catAdscripcione = $this->CatAdscripciones->newEntity();
        if ($this->request->is('post')) {
            $catAdscripcione = $this->CatAdscripciones->patchEntity($catAdscripcione, $this->request->getData());
            if ($this->CatAdscripciones->save($catAdscripcione)) {
                $this->Flash->success(__('The cat adscripcione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cat adscripcione could not be saved. Please, try again.'));
        }
        $catInstituciones = $this->CatAdscripciones->CatInstituciones->find('list', ['limit' => 200]);
        $this->set(compact('catAdscripcione', 'catInstituciones'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cat Adscripcione id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $catAdscripcione = $this->CatAdscripciones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $catAdscripcione = $this->CatAdscripciones->patchEntity($catAdscripcione, $this->request->getData());
            if ($this->CatAdscripciones->save($catAdscripcione)) {
                $this->Flash->success(__('The cat adscripcione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cat adscripcione could not be saved. Please, try again.'));
        }
        $catInstituciones = $this->CatAdscripciones->CatInstituciones->find('list', ['limit' => 200]);
        $this->set(compact('catAdscripcione', 'catInstituciones'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cat Adscripcione id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $catAdscripcione = $this->CatAdscripciones->get($id);
        if ($this->CatAdscripciones->delete($catAdscripcione)) {
            $this->Flash->success(__('The cat adscripcione has been deleted.'));
        } else {
            $this->Flash->error(__('The cat adscripcione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
