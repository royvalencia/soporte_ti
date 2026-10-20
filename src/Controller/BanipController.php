<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Banip Controller
 *
 * @property \App\Model\Table\BanipTable $Banip
 *
 * @method \App\Model\Entity\Banip[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BanipController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $conditions = $this->getFiltro();


        $user = $this->Auth->User('co_user_id');
        $grupo = $this->Auth->User('co_group_id');

        if ($grupo==4){
            $conditions['Banip.co_user_id']=$user;
            $this->paginate = [
                'contain' => ['CoUsers'],'conditions' =>$conditions
            ];
            $banip = $this->paginate($this->Banip);
        }else{
            $this->paginate = [
                'contain' => ['CoUsers'],'conditions' =>$conditions
            ];
            $banip = $this->paginate($this->Banip);
        }

        $this->set(compact('banip','grupo'));
    }

    /**
     * View method
     *
     * @param string|null $id Banip id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $banip = $this->Banip->get($id, [
            'contain' => ['CoUsers']
        ]);

        $this->set('banip', $banip);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $banip = $this->Banip->newEntity();
        if ($this->request->is('post')) {
            $banip = $this->Banip->patchEntity($banip, $this->request->getData());
            if ($this->Banip->save($banip)) {
                $this->Flash->success(__('La IP Baneada se ha Registrado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La IP no se ha registrado. Intente de nuevo'));
        }
        $coUsers = $this->Banip->CoUsers->find('list',array('conditions'=>array('co_group_id <>'=>1),'order'=>array('nombre'=>'ASC')));

        $this->set(compact('banip','coUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Banip id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $banip = $this->Banip->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $banip = $this->Banip->patchEntity($banip, $this->request->getData());
            if ($this->Banip->save($banip)) {
                $this->Flash->success(__('La IP Baneada se ha Registrado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La IP no se ha registrado. Intente de nuevo'));
        }
        $coUsers = $this->Banip->CoUsers->find('list',array('conditions'=>array('co_group_id <>'=>1),'order'=>array('nombre'=>'ASC')));

        $this->set(compact('banip','coUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Banip id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $banip = $this->Banip->get($id);
        if ($this->Banip->delete($banip)) {
            $this->Flash->success(__('La IP Baneado ha sido Eliminado'));
        } else {
            $this->Flash->error(__('La IP no se ha podido eliminar. Intente de Nuevo'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
    * Buscar
    * 
    * @param mixed $borrarFiltro si se pasa 1 se borra el filtro de la sesion
    */
    public function buscar($borrarFiltro = 0)
    {
       $session = $this->request->session(); //Manejo de sesiones en la version 3
        if ($this->request->is('post')) {
            if(!empty($this->request->data)) {
                $url = [];
                $url['action']=(isset($this->request->data['destino'])) ? $this->request->data['destino'] : 'index';
                foreach ($this->request->data as $k=>$v)
                {
                $url[$k] =$v;               
                }
                $argumentos= $url;
                
                $session->write('argumentos'.$this->name,$argumentos);
                $this->redirect($url, null, true);
            }
        }
        //Borrado del filtro de busqueda
        if($borrarFiltro==1)  { 
           $session->delete('argumentos'.$this->name);   
            if ($this->referer() != '/') {
                $this->redirect($this->referer());
            } 
            else {
                $this->redirect(array('action' => 'index'));
            }
        }
             
    }


    public function getFiltro(){
        $session = $this->request->session(); //Manejo de sesiones en la version 3
        $argumentos = null;
        $conditions =[];
        if($session->check('argumentos'.$this->name)){
            $argumentos = $session->read('argumentos'.$this->name);          
            $this->request->data = $argumentos;    //Para los datos en el view
           if(!empty($argumentos['ip'])){
               $conditions['Banip.ip like']= $argumentos['ip'].'%'; 
           }
           if(!empty($argumentos['amenanza'])){
               $conditions['Banip.amenanza like']=$argumentos['amenanza'].'%'; 
           }
           if(!empty($argumentos['fuente'])){
               $conditions['Banip.fuente like']=$argumentos['fuente'].'%'; 
           }
           if(!empty($argumentos['destinofin'])){
            $conditions['Banip.destinofin like']=$argumentos['destinofin'].'%'; 
        }                               
        }   
             
        $this->set(compact('argumentos'));
        return $conditions;
    }
}
