<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CatInstituciones Controller
 *
 * @property \App\Model\Table\CatInstitucionesTable $CatInstituciones
 *
 * @method \App\Model\Entity\CatInstitucione[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CatInstitucionesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        
        $catInstituciones = $this->paginate($this->CatInstituciones);

        $this->set(compact('catInstituciones'));
    }

    /**
     * View method
     *
     * @param string|null $id Cat Institucione id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $catInstitucione = $this->CatInstituciones->get($id, [
            'contain' => ['CatAdscripciones']
        ]);

        $this->set('catInstitucione', $catInstitucione);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $catInstitucione = $this->CatInstituciones->newEntity();
        if ($this->request->is('post')) {
            $catInstitucione = $this->CatInstituciones->patchEntity($catInstitucione, $this->request->getData());
            if ($this->CatInstituciones->save($catInstitucione)) {
                $this->Flash->success(__('The cat institucione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cat institucione could not be saved. Please, try again.'));
        }
       $this->set(compact('catInstitucione'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cat Institucione id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $catInstitucione = $this->CatInstituciones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $catInstitucione = $this->CatInstituciones->patchEntity($catInstitucione, $this->request->getData());
            if ($this->CatInstituciones->save($catInstitucione)) {
                $this->Flash->success(__('The cat institucione has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cat institucione could not be saved. Please, try again.'));
        }
        $this->set(compact('catInstitucione'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cat Institucione id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $catInstitucione = $this->CatInstituciones->get($id);
        if ($this->CatInstituciones->delete($catInstitucione)) {
            $this->Flash->success(__('The cat institucione has been deleted.'));
        } else {
            $this->Flash->error(__('The cat institucione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
