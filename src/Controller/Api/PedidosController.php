<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;     
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

use Cake\ORM\TableRegistry;
use Cake\Mailer\MailerAwareTrait;
use Cake\Mailer\Email;
use Cake\Core\Configure;

/**
 * Pedidos Controller
 *
 * @property \App\Model\Table\PedidosTable $Pedidos
 *
 * @method \App\Model\Entity\Pedido[] paginate($object = null, array $settings = [])
 */
class PedidosController extends AppController
{
    use MailerAwareTrait;
    public $paginate = [
        'limit' => 30,
        'order' => [
            'Pedidos.id' => 'desc'
        ]
    ];

    public $components = array('RequestHandler');

     public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->_validViewOptions[] = 'pdfConfig';
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $pedidos =[];
          $session = $this->request->session(); //Manejo de sesiones en la version 3
        $this->paginate['contain'] = 
                         ['Almacenes', 'Clientes', 'StatusPedidos',
                           'DetallePedidos'=> function($q) {
                                        $q->select([
                                             'DetallePedidos.pedido_id',
                                             'total_solicitado' => $q->func()->sum('DetallePedidos.cantidad_solicitada*DetallePedidos.precio_venta'),
                                             'total' => $q->func()->sum('DetallePedidos.cantidad*DetallePedidos.precio_venta')
                                        ])
                                        ->group(['DetallePedidos.pedido_id']);
                                        return $q;
                                    } 
                        ];
         $this->paginate['sortWhitelist'] = [
                            'Pedidos.id', 'Clientes.nombre', 'Pedidos.status_pedido_id', 'Pedidos.referencia','Pedidos.fecha_pedido','Pedidos.facturado'
                        ] ; 
         $conditions =['Pedidos.created_by'=>$this->Auth->user('co_user_id'),'Pedidos.status_pedido_id NOT IN'=>[8]]; //Filtro de la consulta  mis pedidos con orden de pedido o creados solamentte                                                        
        $this->paginate['conditions'] = $conditions ;
            $pedidos = $this->paginate($this->Pedidos);
          $pagination=$this->request->params['paging']['Pedidos'];         
         
       
        $this->set(compact('pedidos','pagination'));
        $this->set('_serialize', ['pedidos','pagination']);
    }

    public function getAlmacenes(){
        $almacenes = $this->ListAlmacenes();
        $this->set(compact('almacenes'));
        $this->set('_serialize', ['almacenes']);   
    }

    public function getCatalogos(){
         $almacenes = $this->ListAlmacenes();
         $iva = Configure::read('iva');
        $this->set(compact('almacenes','iva'));
        $this->set('_serialize', ['almacenes','iva']);   
    }

      /**
     * View method
     *
     * @param string|null $id Pedido id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
     
        
        $pedido = $this->Pedidos->get($id, [
            'contain' => ['Clientes', 'StatusPedidos', 'BitacoraPedidos'=>['StatusPedidos'], 
                           'DetallePedidos'=>[ 'ProductosAlmacenes'=>['Productos'=>['UnidadMedidas']],
                                               'sort'=>['DetallePedidos.id'=>'ASC']
                                           ]

                        ]]);
   

        $this->set(compact('pedido'));       
        $this->set('_serialize', ['pedido']);
    }

    public function testRaw(){
        $data = $this->request->input('json_decode'); //ASi se envia información via JSON tipo RAW o haciendo un       JSON.stringify(data) en el body del post
     //   $data =  $this->request->getData();
        pr($data);
        $this->set(compact('data'));
        $this->set('_serialize',['data']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
       
       
        $pedido = $this->Pedidos->newEntity(['associated' => ['DetallePedidos']]);
          $errors = [];
        if ($this->request->is('post')) {
           //$data =  $this->request->input('json_decode');  
           $data =  json_decode(json_encode($this->request->input('json_decode')), true); //ASi obtenemos los Raw Data, ya que si no obtenemos un objeto
           // pr($data);exit;    
          //  pr($this->request->getData());exit;
            $pedido = $this->Pedidos->patchEntity($pedido, $data,['associated' => ['DetallePedidos']]);
           // $pedido->almacene_id = $almacenSeleccionado;
            $pedido->created_by = $this->Auth->user('co_user_id');
              $pedido->status_pedido_id =1; //Status solicitud creada
              $pedido->fecha_pedido = date('Y-m-d');
            //  pr($pedido);exit;
            if ($this->Pedidos->save($pedido)) {
                if($pedido->referencia==''){
                    $pedido->referencia = 'P'. str_pad($pedido->id,5, "0", STR_PAD_LEFT); //Referencia custom si no se establecio
                    $this->Pedidos->save($pedido);
                    $this->bitacoraPedidos($pedido->id,1);//Pedido creado
                     if($data['notificacion']){  //Notificacion por email , obtenemos los datos nuevos por ser alta      
                          $pedido = $this->Pedidos->get($pedido->id, [
                                'contain' => ['Clientes',  
                                               'DetallePedidos'=>['ProductosAlmacenes'=>['Productos'=>['UnidadMedidas']],
                                                                  'sort'=>['DetallePedidos.id'=>'ASC']   
                                           ],                                              
                                ] 
                            ]);           
                          $this->getMailer('Pedido')->send('solicitud', [$pedido]); 
                        }
                }
               $message='Solicitud de Pedido agregada.';
               $success = true;

               
            }else{
                 $success = false;  
                 $message='No se pudo agregar la mascota, intente de nuevo.';                
                   foreach($pedido->errors() as $nameField=> $errorField){
                    $errors[$nameField] = [];
                     foreach($errorField as $key =>$value){
                        array_push($errors[$nameField],$value);
                        $message.=' '.$value.'.';
                    //   $errors[$key]=$value;
                     }
                   }
            }
         
        }
          
        $this->set(compact('pedido', 'success', 'errors','message'));
        $this->set('_serialize', ['pedido','success','errors','message']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Pedido id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $almacenSeleccionado = $this->almacenSeleccionado();
        if(!$almacenSeleccionado){ //Si NO hay un almacenen seleccionado         
            return $this->redirect(['action' => 'index']);
         }

        $pedido = $this->Pedidos->get($id, [
            'contain' => ['Clientes',  
                           'DetallePedidos'=>['ProductosAlmacenes'=>['Productos'=>['UnidadMedidas']],
                                              'sort'=>['DetallePedidos.id'=>'ASC']   
                       ],                                              
            ] 
        ]);
        //Solo se pueden editar Pedidos con status 1: Solicitud de Pedido
        if($pedido->status_pedido_id!=1){
            $this->Flash->error('Solo se pueden editar pedidos en Status Creado. Operación Cancelada');
            $this->redirect(['action'=>'index']);
        }


        if ($this->request->is(['patch', 'post', 'put'])) {
            $pedido = $this->Pedidos->patchEntity($pedido, $this->request->getData());
            $pedido->dirty('detalle_pedidos', true);
            //pr($this->request->getData());exit;
            //pr($pedido);exit;
            if ($this->Pedidos->save($pedido)) {
                //Si se requirio se envia correo electornico
                if($this->request->getData('notificacion')){                    
                  $this->getMailer('Pedido')->send('solicitud', [$pedido]); 
                }
                $this->Flash->success(__('Solicitud de Pedido editada.'));


               return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La solicitud de pedido no fue editada, intente de nuevo.'));
        }
       
        
        
        $cliente = null;
         if($this->request->query('cliente_id')){
            $cliente = $this->Pedidos->Clientes->get($this->request->query('cliente_id'));
         }

        $almacenes = $this->Pedidos->Almacenes->find('list', ['limit' => 200]);
      
        $statusPedidos = $this->Pedidos->StatusPedidos->find('list', ['limit' => 200]);      
        $this->set(compact('pedido', 'almacenes', 'clientes', 'movimientos','cliente'));
        $this->set('_serialize', ['pedido']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Pedido id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
           //Solo se pueden editar Pedidos con status 1: Solicitud de Pedido
        
        
         $almacenSeleccionado = $this->almacenSeleccionado();
        if(!$almacenSeleccionado){ //Si NO hay un almacenen seleccionado         
            return $this->redirect(['action' => 'index']);
         }

        $this->request->allowMethod(['post', 'delete']);
        $pedido = $this->Pedidos->get($id);
        if($pedido->status_pedido_id!=1){
            $this->Flash->error('Solo se pueden Eliminar pedidos en Status Creado. Operación Cancelada');
            $this->redirect(['index']);
        }
        if ($this->Pedidos->delete($pedido)) {            
            $this->AddBitacora('Pedido eliminado de la BD', json_encode($pedido), $id);
            $this->Flash->success(__('Solicitud de Pedido Eliminada.'));
        } else {
            $this->Flash->error(__('La Solicitud no fue eliminada, intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

  

   
       

    

    

          
    
   


public function search()
{
    
        $name = $this->request->query['term'];

        $pedidos = $this->Pedidos->find('all', [
            'contain'=> ['Almacenes', 'Clientes', 'StatusPedidos',
                           'DetallePedidos'=> function($q) {
                                        $q->select([
                                             'DetallePedidos.pedido_id',
                                             'total_solicitado' => $q->func()->sum('DetallePedidos.cantidad_solicitada*DetallePedidos.precio_venta'),
                                             'total' => $q->func()->sum('DetallePedidos.cantidad*DetallePedidos.precio_venta')
                                        ])
                                        ->group(['DetallePedidos.pedido_id']);
                                        return $q;
                                    } 
                        ],          
            'conditions' => [ 'OR' => [
                'Clientes.nombre ILIKE' =>'%'. $name . '%',
                'Pedidos.id' => $name 
                ],
                'Pedidos.status_pedido_id NOT IN'=>[8]
            ],
            'limit'=>'10'
        ]);
     //   pr($pedidos);
      $this->set(compact('pedidos'));
       $this->set('_serialize',['pedidos']);    
   
  }

  


/**
 * Buscamos productos en el almacene sleccionado
 * @return [type] [description]
 */
     public function searchProductos($almacene_id)
    {
   
         $ProductosAlmacenesTable= TableRegistry::get('ProductosAlmacenes');
         $almacenSeleccionado =$almacene_id;
        $name = $this->request->query['descripcion'];
        $productos = $ProductosAlmacenesTable->find('all', [
            'contain' =>['Productos'=>['UnidadMedidas','Proveedores','Lineas','Rubros']],
            'conditions' => [ 'OR' => [
                'Productos.descripcion ILIKE' => '%'. $name . '%',
                'Productos.codigo ILIKE' => $name . '%'
            ],'ProductosAlmacenes.almacene_id'=>$almacenSeleccionado],
            'limit'=>20
        ]);
       
        $this->set(compact('productos'));
         $this->set('_serialize', ['productos']);
   
}



/**
 * Seguimiento del histórico de movimiento del pedido
 * @param  [type] $pedido_id        [description]
 * @param  [type] $status_pedido_id [description]
 * @return [type]                   [description]
 */
 private function bitacoraPedidos($pedido_id,$status_pedido_id){
       $bitacoraPedido = $this->Pedidos->BitacoraPedidos->newEntity();
       $bitacoraPedido->pedido_id =$pedido_id;
       $bitacoraPedido->status_pedido_id = $status_pedido_id;
       return $this->Pedidos->BitacoraPedidos->save($bitacoraPedido); 
 }
}
