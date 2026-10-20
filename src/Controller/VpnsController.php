<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Vpns Controller
 *
 * @property \App\Model\Table\VpnsTable $Vpns
 *
 * @method \App\Model\Entity\Vpn[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VpnsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {   
        $conditions = $this->getFiltro(); //Filtro de la consulta

        $user = $this->Auth->User('co_user_id');
        $grupo = $this->Auth->User('co_group_id');

        if ($grupo==4){
            $conditions['Vpns.co_user_id']=$user;
            $this->paginate = [
                'contain' => ['CatInstituciones','CoUsers'],'conditions' =>$conditions
            ];
            $vpns = $this->paginate($this->Vpns);
        }else {
            $this->paginate = [
                'contain' => ['CatInstituciones','CoUsers'],'conditions' =>$conditions
            ];
            $vpns = $this->paginate($this->Vpns);
        }
      

        $catInstituciones = $this->Vpns->CatInstituciones->find('list');
        $this->set(compact('vpns','grupo','catInstituciones'));
    }

    /**
     * View method
     *
     * @param string|null $id Vpn id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        
        $vpn = $this->Vpns->get($id, [
            'contain' => ['CatInstituciones','Adjuntoscd','CoUsers']
        ]);

        $this->set(compact('vpn'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vpn = $this->Vpns->newEntity();
        if ($this->request->is('post')) {

            $vpn = $this->Vpns->patchEntity($vpn, $this->request->getData());

            if ($this->Vpns->save($vpn)) {
                $this->Flash->success(__('Los datos de la VPN se han guardado con Exito'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Los datos del Servidor no se han guardado. Intente de Nuevo!!'));
        }

        $catInstituciones = $this->Vpns->CatInstituciones->find('list', array('order'=>array('nombre'=>'ASC')));
        $coUsers = $this->Vpns->CoUsers->find('list',array('conditions'=>array('co_group_id <>'=>1),'order'=>array('nombre'=>'ASC')));


        $this->set(compact('vpn','catInstituciones','coUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vpn id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vpn = $this->Vpns->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vpn = $this->Vpns->patchEntity($vpn, $this->request->getData());
            if ($this->Vpns->save($vpn)) {
                $this->Flash->success(__('Los datos de la VPN se han guardado con Exito.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Los datos de de VPNS no se han guardado. Intente de Nuevo!!.'));
        }
        $catInstituciones = $this->Vpns->CatInstituciones->find('list', array('order'=>array('nombre'=>'ASC')));
        $coUsers = $this->Vpns->CoUsers->find('list',array('conditions'=>array('co_group_id <>'=>1),'order'=>array('nombre'=>'ASC')));

        //pr($vpn);
        $this->set(compact('vpn','catInstituciones','coUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vpn id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vpn = $this->Vpns->get($id);
        if ($this->Vpns->delete($vpn)) {
            $this->Flash->success(__('Los Datos de la VPN se han Eliminado.'));
        } else {
            $this->Flash->error(__('Los Datos de la VPN no han podido eliminar. Intente de Nuevo!!'));
        }

        return $this->redirect(['action' => 'index']);
    }
//Funcion para Descargar los Adjuntos/VPN
    public function download($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Descarga Invalida', true));
            $this->redirect(array('action'=>'index'));   
        }
        //if (!empty($this->data)) {
            //$filename = $this->Adjuntos->findByAdjuntoId($id);
        $this->loadModel('Adjuntoscd'); //Carga el Modelo
            //$filename=$this->Adjuntos->find('list',array('conditions'=>array('adjunto_id'=>$id)));
            $fila = $this->Adjuntoscd->findByAdjuntocdId($id);
            $filename=$fila->first();
            //pr($filename['archivo']);
            $name=$filename['archivo'];
            $path = empty($path) ? WWW_ROOT.'/upload/archivos/' : $path;
            $file="$path/".$name;
            //$mimeType = $this->mimeType($file);

            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false);
           // header("Content-Type: ".$mimeType);
            header("Content-type: application/force-download");
            header("Content-Length: ".@filesize($file));
            header("Content-Disposition: Adjuntoscd; filename=\"".$name."\";");
             $fp = fopen($file, "r"); 
           fpassthru($fp); 
           fclose($fp);
         //   set_time_limit(0);
           // @readfile("$file");   //Reemplazamos la funcion por compatibilidades con el server de produccion 
            exit;
            $this->Session->setFlash(__('El archivo ha sido descargado', true));
            $this->redirect(array('action'=>'index'));

     
        if (empty($this->data)) {
         //  $this->data = $this->ArcAdjunto->read(null, $id);
        }   
    }


/*     //Funcion de Busqueda/AJAX 
    //Falta Query para buscar 2 Tablas
    public function buscar()
    {
        $this->request->allowMethod('ajax');
   
        $keyword = $this->request->query('keyword');
        $query = $this->Vpns->find('all',
            [ 'contain' => ['CatInstituciones','CoUsers'], //Se Anexan las Tablas Relacionadas
              'conditions' => [
                    'OR' => [
                        'responsable LIKE'=>'%'.$keyword.'%',
                        'usuario LIKE'=>'%'.$keyword.'%',
                        'observaciones LIKE'=>'%'.$keyword.'%'
                    ]
            
                ],
              'order' => ['Vpns.vpn_id'=>'DESC'],
              'limit' => 10
            ]);

        //debug($query);
        $catInstituciones = $this->Vpns->CatInstituciones->find('list');

        $this->set('vpns',$this->paginate($query));
        $this->set('_serialize', ['vpns']);

    }
 */
    /**
    * Buscar
    * 
    * @param mixed $borrarFiltro si se pasa 1 se borra el filtro de la sesion
    */
    public function buscar($borrarFiltro = 0)
    {                        
       $session = $this->request->session(); //Manejo de sesiones en la version 3
        if ($this->request->is('post')) {
        if(!empty($this->request->data)) 
        {
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
        if($borrarFiltro==1) //Borrado del filtro de busqueda
        { 
           $session->delete('argumentos'.$this->name);   
            if ($this->referer() != '/') 
            {
                $this->redirect($this->referer());
            } 
            else 
            {
                $this->redirect(array('action' => 'index'));
            }
        }
             
    }

    //Funcion GetFiltro para $Conditions
    public function getFiltro(){
        $session = $this->request->session(); //Manejo de sesiones en la version 3
        $argumentos = null;
        $conditions =[];
        if($session->check('argumentos'.$this->name)){
            $argumentos = $session->read('argumentos'.$this->name);          
            $this->request->data = $argumentos;    //Para los datos en el view
           if(!empty($argumentos['responsable'])){
               $conditions['Vpns.responsable like']=$argumentos['responsable'].'%'; 
           }
           if(!empty($argumentos['usuario'])){
               $conditions['Vpns.usuario like']=$argumentos['usuario'].'%'; 
           }
           if(!empty($argumentos['observaciones'])){
               $conditions['Vpns.observaciones like']=$argumentos['observaciones'].'%'; 
           }                                 
        }   
        $this->set(compact('argumentos'));
        return $conditions;
    }
}
