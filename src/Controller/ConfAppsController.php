<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ConfApps Controller
 *
 * @property \App\Model\Table\ConfAppsTable $ConfApps
 *
 * @method \App\Model\Entity\ConfApp[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConfAppsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $confApps = $this->paginate($this->ConfApps);

        $this->set(compact('confApps'));
    }

    /**
     * View method
     *
     * @param string|null $id Conf App id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $confApp = $this->ConfApps->get($id, [
            'contain' => []
        ]);

        $this->set('confApp', $confApp);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $confApp = $this->ConfApps->newEntity();
        if ($this->request->is('post')) {
            $confApp = $this->ConfApps->patchEntity($confApp, $this->request->getData());
            if ($this->ConfApps->save($confApp)) {
                $this->Flash->success(__('The conf app has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The conf app could not be saved. Please, try again.'));
        }
        $this->set(compact('confApp'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Conf App id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $confApp = $this->ConfApps->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $confApp = $this->ConfApps->patchEntity($confApp, $this->request->getData());
            if ($this->ConfApps->save($confApp)) {
                $this->Flash->success(__('The conf app has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The conf app could not be saved. Please, try again.'));
        }
        $this->set(compact('confApp'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Conf App id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $confApp = $this->ConfApps->get($id);
        if ($this->ConfApps->delete($confApp)) {
            $this->Flash->success(__('The conf app has been deleted.'));
        } else {
            $this->Flash->error(__('The conf app could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
