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
namespace App\Controller\Api;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;


/**
 * Application Controller
 *

 * Crearemos nuestros propios eventos en lugar de usar el crud plugin para asi tener un mejor control de la lógica, asi que armaremos la jsnon response de esta forma
 * {success =>true o false
 *  data {Modelo, relaciones , otros}
 *  pagination => datos de la paginacion
 * }
 *            
 * 
 *Majearemos JW.Auth para la respuesta esta nada mas se incluye lo siguiente
 * {
 *  "message": "You are not authorized to access that location.",
  "url": "/pet_kardex/back_end/api/mascotas.json?page=23",
  "code": 401
 * }
 * 
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

   // use \Crud\Controller\ControllerTrait;
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
        //$this->loadComponent('Flash');
        /*
               $this->loadComponent('Crud.Crud', [
            'actions' => [
                'Crud.Index',
                'Crud.View',
                'Crud.Add',
                'Crud.Edit',
                'Crud.Delete'
            ],
            'listeners' => [
                'Crud.Api',
                'Crud.ApiPagination',
                'Crud.ApiQueryLog'
            ]
        ]);
        */
          
         $this->loadComponent('Auth', [
            'storage' => 'Memory',
            'authenticate' => [
                'Form' => [
                     'userModel'=>'CoUsers' ,
                    'fields' => ['username' => 'login', 'password' => 'password'] ,
                    'scope'=>['active'=>1]
                ],
                'ADmad/JwtAuth.Jwt' => [
                    'parameter' => 'token',
                    'userModel' => 'CoUsers',
                    'scope' => ['CoUsers.active' => 1],
                    'fields' => [                                                                    
                        'username' => 'co_user_id', //Se especifica el campo que se puso en el sub del token                       
                    ],
                    'queryDatasource' => true
                ]
            ],
            'unauthorizedRedirect' => false,
            'checkAuthIn' => 'Controller.initialize'   ,             
          // 'authError' => 'Acceso denegado. No cuenta con suficientes permisos.',
            'loginAction' => false
        ]);
            
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
    
     public function isAuthorized($user = null)
    {
         
         return true;
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
        $almacenes = $ProductosAlmacenesTable->Almacenes->find('all', ['conditions'=>$conditions, 'order'=>'Almacenes.nombre', 'limit' => 200]);
        return $almacenes;
    }
}
