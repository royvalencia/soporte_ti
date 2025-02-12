<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Servers Controller
 *
 *@property \App\Model\Table\ServersTable $Servers

 * @method \App\Model\Entity\Server[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ServersController extends AppController
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
            $conditions['Servers.co_user_id']=$user;
            $this->paginate = [
                'contain' => ['CoUsers'],'conditions' =>$conditions
            ];
            $servers = $this->paginate($this->Servers);
        }else{
            $this->paginate = [
                'contain' => ['CoUsers'],'conditions' =>$conditions
            ];
            $servers = $this->paginate($this->Servers);
        }
        
        
        $this->set(compact('servers','grupo'));
    }

    /**
     * View method
     *
     * @param string|null $id Server id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $server = $this->Servers->get($id, [
            'contain' => ['CoUsers']
        ]);

        $this->set(compact('server'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $server = $this->Servers->newEntity();
        if ($this->request->is('post')) {
            
            $server = $this->Servers->patchEntity($server, $this->request->getData());

            if ($this->Servers->save($server)) {
                $this->Flash->success(__('Los datos del Servidor se han guardado con Exito'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Los datos del Servidor no se han guardado. Intente de Nuevo!!.'));
        }

        $coUsers = $this->Servers->CoUsers->find('list',array('conditions'=>array('co_group_id <>'=>1),'order'=>array('nombre'=>'ASC')));
        $this->set(compact('server','coUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Server id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $server = $this->Servers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $server = $this->Servers->patchEntity($server, $this->request->getData());
            if ($this->Servers->save($server)) {
                $this->Flash->success(__('Los datos del Servidor se han guardado con Exito.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Los datos del Servidor no se han guardado. Intente de Nuevo!!.'));
        }

        $coUsers = $this->Servers->CoUsers->find('list',array('conditions'=>array('co_group_id <>'=>1),'order'=>array('nombre'=>'ASC')));

        $this->set(compact('server','coUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Server id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $server = $this->Servers->get($id);
        if ($this->Servers->delete($server)) {
            $this->Flash->success(__('Los Datos del Servidor se han Eliminado'));
        } else {
            $this->Flash->error(__('Los Datos del Servidor no han podido eliminar. Intente de Nuevo!!.'));
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

    //Funcion de busqueda
    public function getFiltro(){
        $session = $this->request->session(); //Manejo de sesiones en la version 3
        $argumentos = null;
        $conditions =[];
        if($session->check('argumentos'.$this->name)){
            $argumentos = $session->read('argumentos'.$this->name);          
            $this->request->data = $argumentos;    //Para los datos en el view
           if(!empty($argumentos['descripcion'])){
               $conditions['Servers.descripcion like']= $argumentos['descripcion'].'%'; 
           }
           if(!empty($argumentos['user'])){
               $conditions['Servers.user']=$argumentos['user']; 
           }
           if(!empty($argumentos['servicios'])){
               $conditions['Servers.servicios']=$argumentos['servicios']; 
           }
           if(!empty($argumentos['puertos'])){
            $conditions['Servers.puertos']=$argumentos['puertos']; 
        }                               
        }   
             
        $this->set(compact('argumentos'));
        return $conditions;
    }
    
}