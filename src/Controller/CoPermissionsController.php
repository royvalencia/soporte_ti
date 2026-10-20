<?php
namespace App\Controller;

use App\Controller\AppController;
use ReflectionClass;
use ReflectionMethod;

/**
 * CoPermissions Controller
 *
 * @property \App\Model\Table\CoPermissionsTable $CoPermissions
 */
class CoPermissionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $coPermissions = $this->paginate($this->CoPermissions);

        $this->set(compact('coPermissions'));
        $this->set('_serialize', ['coPermissions']);
       
    //  $res = $this->getResources();
      // pr($this->name.":".$this->request->action);
    }

    /**
     * View method
     *
     * @param string|null $id Co Permission id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coPermission = $this->CoPermissions->get($id, [
            'contain' => ['CoGroups']
        ]);

        $this->set('coPermission', $coPermission);
        $this->set('_serialize', ['coPermission']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coPermission = $this->CoPermissions->newEntity();
        if ($this->request->is('post')) {
            $coPermission = $this->CoPermissions->patchEntity($coPermission, $this->request->data);
            if ($this->CoPermissions->save($coPermission)) {
                $this->Flash->success(__('Permiso agregado'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El permiso no puede ser agregado, intente de nuevo.'));
            }
        }
        $coGroups = $this->CoPermissions->CoGroups->find('list', ['limit' => 200]);
        $this->set(compact('coPermission', 'coGroups'));
        $this->set('_serialize', ['coPermission']);
    }
    
    public function addController()
    {
        $coPermission = $this->CoPermissions->newEntity();
        if (isset($this->request->data['coPermissions'])) {
            //pr($this->request->data);exit;
            foreach($this->request->data['coPermissions'] as $permiso )
            {
               $data = [];
               $data['name']=$permiso;
               $data['co_groups'] = $this->request->data['co_groups']; 
                $this->CoPermissions->patchEntity($coPermission, $data,  ['associated' => ['CoGroups']]);             
               $this->CoPermissions->save($coPermission);
              $coPermission = $this->CoPermissions->newEntity();
            }
                $this->Flash->success(__('Permisos desde controlador agregados'));
                return $this->redirect(['action' => 'index']);
           
        }
        if(isset($this->request->data['procedencia'])){
        $controladores = [];              
         foreach($this->request->data as $datos =>$value)
            if($value==1){    //Si fue seleccionado entonces lo asignamos
                $separador=split("_",$datos);
                $controladores[$this->request->data['name_'.$separador[1]]]=$this->request->data['name_'.$separador[1]];
            }
           $this->set('controladores',$controladores)      ;   
  
        }
        $coGroups = $this->CoPermissions->CoGroups->find('list', ['limit' => 200]);
        $this->set(compact('coPermission', 'coGroups'));
        $this->set('_serialize', ['coPermission']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Co Permission id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coPermission = $this->CoPermissions->get($id, [
            'contain' => ['CoGroups']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coPermission = $this->CoPermissions->patchEntity($coPermission, $this->request->data);
            if ($this->CoPermissions->save($coPermission)) {
                $this->Flash->success(__('Permiso actualizado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El permiso no fue actualizado, intente de nuevo.'));
            }
        }
        $coGroups = $this->CoPermissions->CoGroups->find('list', ['limit' => 200]);
        $this->set(compact('coPermission', 'coGroups'));
        $this->set('_serialize', ['coPermission']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Co Permission id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coPermission = $this->CoPermissions->get($id);
        if ($this->CoPermissions->delete($coPermission)) {
            $this->Flash->success(__('Permiso eliminado.'));
        } else {
            $this->Flash->error(__('El permiso no fue eliminado, intente de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function controladores(){
          
         
        $controllers = $this->getControllers(); 
        $controladores =[];
        foreach($controllers as $controller){
            $controladores[$controller] =$controller;
        }      
        
      
        $controladoresPermisos = $this->getResources();
        if ($this->request->is('post')) {
              $controladoresPermisosFilter = [];            
             $i=0;
              //var_dump(array_intersect_key($controladoresPermisos, array_flip($this->request->data['controladores'])));exit;
              foreach($controladoresPermisos as $controladorPermiso){
                 foreach($controladorPermiso as $key=>$value){                  
                  
                  foreach($this->request->data['controladores'] as $buscar){                    
                      if($key==$buscar){
                          $controladoresPermisosFilter[$i][$key] =$value;                           
                          $i++;
                      }
                  }
                 }
              }          
              $controladoresPermisos = $controladoresPermisosFilter;                       
        }
        
        $coPermission = $this->CoPermissions->newEntity();
        //Obtenemos todos los permisos para hacer un cruce;
        $query = $this->CoPermissions->find('all');
        $permisos =$query->all();
        $this->set(compact('controladoresPermisos','coPermission','controladores','permisos'));
        $this->set('_serialize',['controladoresPermisos','coPermission','controladores','permisos']);
        
    }
    
    public function getResources(){
        $controllers = $this->getControllers();
        $resources = [];
        foreach($controllers as $controller){
            $actions = $this->getActions($controller);           
            array_push($resources, $actions);
        }      
        return $resources;
    }
    
    public function getControllers() {
        $files = scandir(APP.'Controller/');
        $results = [];
        $ignoreList = [
            '.', 
            '..', 
            'Component', 
            'AppController.php',
        ];
        foreach($files as $file){
            if(!in_array($file, $ignoreList)) {
                $controller = explode('.', $file)[0];
                array_push($results, str_replace('Controller', '', $controller));
            }            
        }
        return $results;
    }
    
    public function getActions($controllerName) {
        $className = 'App\\Controller\\'.$controllerName.'Controller';
        $class = new ReflectionClass($className);
        $actions = $class->getMethods(ReflectionMethod::IS_PUBLIC);
        $results = [$controllerName => []];
        //$results = [];
        $ignoreList = ['beforeFilter', 'afterFilter', 'initialize'];
          array_push($results[$controllerName], $controllerName.':*');
        foreach($actions as $action){
            if($action->class == $className && !in_array($action->name, $ignoreList)){
                //array_push($results[$controllerName], $action->name);
                array_push($results[$controllerName], $controllerName.":".$action->name);
             //  array_push($results, ($controllerName.":".$action->name));
            }   
        }
        return $results;
    }
    
}
