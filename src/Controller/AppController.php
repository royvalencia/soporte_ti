<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => '/',
            'logoutRedirect' => [
                'controller' => 'CoUsers',
                'action' => 'login'
            ],
            'loginAction' => [
                'controller' => 'CoUsers',
                'action' => 'login'
            ],
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'login',
                        'password' => 'password'
                    ],
                    'userModel' => 'CoUsers',
                    'scope'=>['CoUsers.active' => '1']
                ]
            ],
            'authorize' => 'Controller'  ,
            'authError' => 'Acceso denegado. No cuenta con suficientes permisos.',
            'flash'=>['element' => 'unauthorized']
        ]);
        if (!$this->Auth->user()) {
            $this->Auth->config('authError', false);
        }
        //$this->Auth->allow(['index', 'view', 'display']);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        $this->loadComponent('Auth');
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
        //Generamos el menu para la aplicacion
         if($this->Auth->user()){
             $this->set('menuApp', $this->_GetMenuBD());
         }
    }

     public function beforeFilter(Event $event)
    {
       // $this->Auth->allow(['index', 'view', 'display','edit','add']);

        parent::beforeFilter($event);
        //$this->Auth->allow(['display']);
        $this->set('Auth',$this->Auth->user());
    }

     public function isAuthorized($user = null)
    {

         return $this->__permitted($this->name,$this->request->action);
    }

   /**
   * Veriicamos si el grupo al cual pertence el usuario tiene acceso a ese controllador:funcion.
   *
   * @param mixed $controllerName
   * @param mixed $actionName
   */
   protected  function __permitted($controllerName,$actionName){
   //     echo "$controllerName : $actionName";
        //Ensure checks are all made lower case
      //  $controllerName = strtolower($controllerName);
       // $actionName = strtolower($actionName);
        //If permissions have not been cached to session...
        //$this->request->session()->write('Config.language', 'eng');
        //$this->request->session()->read('Config.language');
        if(!$this->request->session()->check('Permissions')){
            //...then build permissions array and cache it
            $permissions = array();
            //everyone gets permission to logout
            $permissions[]='CoUsers:changePassword';
            //Permiso de consultar la ayuda
             $permissions[]='Ayudas:*';
            //Import the User Model so we can build up the permission cache
           $groups = TableRegistry::get('CoGroups');
            //Now bring in the current users full record along with groups

                $coGroup = $groups->get($this->Auth->user('co_group_id'), [
                    'contain' => ['CoPermissions']
                ]);

                foreach($coGroup->co_permissions as $coPermissions){
                    $permissions[]=$coPermissions->name;
                  //  echo "Permisos: ";
                    //print_r($permissions);
                }
           // }
            //write the permissions array to session
            $this->request->session()->write('Permissions',$permissions);
            //Guardamos el grupo al cual pertenece el usuario, para luego usarse en el menu, funcion _GetMenuBD
            $this->request->session()->write('group_id',$this->Auth->user('co_group_id'));
        }else{
            //...they have been cached already, so retrieve them
            $permissions = $this->request->session()->read('Permissions');
           // $this->dump($permissions);
        }
       // $this->log($permissions);
        //Now iterate through permissions for a positive match
        foreach($permissions as $permission){
          //  echo $permission." - ";
            if($permission == '*'){
                return true;//Super Admin Bypass Found
            }
            if($permission == $controllerName.":*"){

                return true;//Controller Wide Bypass Found
            }
            if($permission == $controllerName.':'.$actionName){
                return true;//Specific permission found
            }
        }
        return false;
    }
  /**
  * Generamos el menún de la base de datos basado en el grupo del usuario
  *
  */
   protected    function _GetMenuBD(){
         $groups = TableRegistry::get('CoGroups');
         $strMenu="";
         //Obtenemos todos los menus DEPENDIENDO DEL PERFIL, por codigo realizaremos el fitro de los papas
         // y luego de los hijos de estos
         $coGroup = $groups->get($this->Auth->user('co_group_id'), [
                    'contain' => ['CoMenus']
                ]);

         $menus2=$coGroup->co_menus;
         $classPadre='';
           $almacenSeleccionado =$this->getAlmacenSeleccionado();
           $active = '';
         foreach($coGroup->co_menus as $menu){
             if($menu->id_padre==0){ //Si son los papas formamos el menu prinicpal
                $icono="";//Inicializamos esta variable
               if($menu->icono)//Si tiene icono
                  $icono="<i class=\"".$menu->icono."\"></i> ";

                   if($menu['icono']){
                       $icono='<i class="fa '.$menu->icono.' "></i>';
                   }else{
                       $icono='<i class="fa fa-th-large"></i>';
                   }

               $focusMenu = false;
               $strMenuHijo ='';
               foreach($menus2 as $hijo){
                  if($hijo->id_padre==$menu->co_menu_id){ //Si es su hijo
                      $icono_hijo="";
                      $destino =explode('/',$hijo->destino);

                      $active = '';

                      if(isset($destino[1]) && isset($destino[2])){
                          if($this->request->params['controller']==$destino[1] && $this->request->params['action']==$destino[2]){
                              $active = '  class="active" ';
                              $focusMenu = true   ;
                          }
                      }
                      if($hijo->icono)//Si tiene icono
                            $icono_hijo='<i class="'.$hijo->icono.'"></i> ';

                   //  $strMenuHijo.='     <li '.$active.'>'.$thisHtml->link($icono_hijo.''.$hijo['nombre'].'',$hijo['destino'],array('title'=>$hijo['etiqueta'],'escape'=>false))."</li>\n";
                     $strMenuHijo.='     <li '.$active.'><a href="'.Router::url($hijo->destino).'" title="'.$hijo->etiqueta.'">'.$icono_hijo.' '.$hijo->nombre."</a></li>\n";
                     //$strMenu.='<li ><a href="page-profile.html"><span class="text">Profile</span></a></li>'
                  }
               }

               if($focusMenu==true){
                  $classPadre ='  ';
                 // $faAngle='fa-angle-down';
               }else{
                   $classPadre=' collapse ';
                  // $faAngle=' fa-angle-left';
               }
                // $strMenu.=' <li'.$active.'><a href="#" >'.$icono.'<span class="nav-label">'.$menu['nombre'].'</span><span class="fa arrow"></span></a>';
                 //$strMenu.=' <li'.$active.'>'.$thisHtml->link($icono.'<span class="nav-label">'.$menu['nombre'].'</span><span class="fa arrow"></span>',$menu['destino'],array('title'=>$menu['etiqueta'],'escape'=>false))."\n";

                 if($almacenSeleccionado && $menu->co_menu_id==12){
                  $menuPadreName = $menu->nombre.' <b>'.$almacenSeleccionado->nombre.'</b>';
                 }else{
                  $menuPadreName = $menu->nombre;
                 }
                 $strMenu.=' <li id="menu-'.$menu->co_menu_id.'" '.$active.'><a href="'.Router::url($menu->destino).'" title="'.$menu->etiqueta.'">'.$icono.'<span class="nav-label">'.$menuPadreName.'</span><span class="fa arrow"></span></a>'."\n";
                if(!empty($strMenuHijo)){
                    $strMenu.='<ul class="nav nav-second-level'.$classPadre.' ">'.$strMenuHijo;
                    $strMenu.="  </ul>\n";
                }
               $strMenu.="</li>\n";
             }
         }
       //  pr('<code>'.$strMenu.'</code>');
        return $strMenu;
      }

      /**
      * Agregar un registro en la bitacora
      *
      * @param mixed $mensaje
      * @param mixed $referencia
      */
      public function AddBitacora($mensaje,$data='',$referencia=null){


        $bitacorasTable = TableRegistry::get('Bitacoras');
        $bitacora = $bitacorasTable->newEntity();

        $bitacora->usuario = $this->Auth->user('login');
        $bitacora->ip =$_SERVER['REMOTE_ADDR'];
        $bitacora->fecha = date("Y-m-d H:i:s");;
        $bitacora->descripcion = $mensaje;
        $bitacora->data = $data;
        $bitacora->referencia = $referencia;

        if ($bitacorasTable->save($bitacora)) {

        }

      }

       /**
     * Agregar un email para enviar como notificacion
     * @param [type] $para      [description]
     * @param [type] $asunto    [description]
     * @param [type] $mensaje   [description]
     * @param [type] $modelo    [description]
     * @param [type] $modelo_id [description]
     */
    public function addNotificacion($para,$asunto,$mensaje,$modelo='',$modelo_id=0){
      $notificaciones = TableRegistry::get('Notificaciones');
      $notifacion = $notificaciones->newEntity();
      $notifacion->para = $para;
      $notifacion->asunto = $asunto;
      $notifacion->mensaje = $mensaje;
      $notifacion->modelo =$modelo;
      $notifacion->modelo_id = $modelo_id;
      return $notificaciones->save($notifacion);
    }

  /**
 * regresa el almacen seleccionado o false
 */
  public function almacenSeleccionado(){
         $almacenSeleccionado = false;
     $session = $this->request->session(); //Manejo de sesiones en la version 3
        if($session->check('almacenSeleccionado')){ //Si hay un almacenen seleccionado
             $almacenSeleccionado = $session->read('almacenSeleccionado');
         }else{
           return false;
         }
        return $almacenSeleccionado;
  }

  /**
 * Lista de almacenes segun el perfil de acceso del usuario
 */
    public function ListAlmacenes(){
        $conditions = [];
        $ProductosAlmacenesTable= TableRegistry::get('ProductosAlmacenes');
        if(!$this->Auth->user('almacenes_todos')){
            $conditions['Almacenes.id'] =$this->Auth->user('almacene_id');
        }
        $almacenes = $ProductosAlmacenesTable->Almacenes->find('list', ['conditions'=>$conditions, 'order'=>'Almacenes.nombre', 'limit' => 200]);
        return $almacenes;
    }

    /**
 * Municipios asignados al usuario dependiendo del centro de captura
 */
    public function municipiosUsuario(){
          $session = $this->request->session(); //Manejo de sesiones en la version 3
        if($session->check('municipiosUsuario')){ //Si una sesion creada
          $municipios =$session->read('municipiosUsuario');
         }else{
            $conditions = [];
            $conditions = ['centros_captura_id' => $this->Auth->user('centros_captura_id')];
            $municipiosTable= TableRegistry::get('CentrosMunicipios');
            $municipiosQuery = $municipiosTable->find('all', ['conditions'=>$conditions]);
            $municipios =[];
            foreach($municipiosQuery as $municipio){
                $municipios[] =$municipio->municipio_id;
            }
            $session->write('municipiosUsuario', $municipios);
       }
        return $municipios;
    }

    public function getAlmacenSeleccionado(){
      $almacenSeleccionado =$this->almacenSeleccionado();
      if($almacenSeleccionado){
          $almacen= TableRegistry::get('Almacenes');
          return $almacen->get($almacenSeleccionado);
      }
      return false;
    }

    /**
 * Establecemos el Almacen con el cual trabajaremos verificando los permisos del usuario
 * @param [type] $id [description]
 */
    public function setAlmacenSeleccionado($id){
           //Verificamos permisos
           if(!$this->Auth->user('almacenes_todos')){
              if($this->Auth->user('almacene_id')!=$id){
               return false;
              }
           }
           //Establecemos el almacen en una variable
           $session = $this->request->session();
           $session->write('almacenSeleccionado', $id);

            return true;
    }

    /**
 * VErificamos si el grupo al que pertenece el usuario puede hacer el movimeinto
 * @param  [type] $tipo_movimiento_id [description]
 * @return [type]                     [description]
 */
    public function movimiento_grupo($tipo_movimiento_id){
        $tipoMovimientos = TableRegistry::get('TipoMovimientosGrupos');
        $autorizado = $tipoMovimientos->find('all',[
                                                    'conditions'=>['co_group_id'=>$this->Auth->user('co_group_id'),'tipo_movimiento_id'=>$tipo_movimiento_id]
                                                ])->count();

        return $autorizado;
    }
    /**
     * verificamos si el grupo del usuario puede hacer el movimiento
     * @param  [type] $status_pedido_id [description]
     * @return [type]                     [description]
     */
 public function status_grupo($status_pedido_id){
        $status = TableRegistry::get('StatusPedidosGrupos');
        $autorizado = $status->find('all',[
                                                    'conditions'=>['co_group_id'=>$this->Auth->user('co_group_id'),'status_pedido_id'=>$status_pedido_id]
                                                ])->count();

        return $autorizado;
    }

}
