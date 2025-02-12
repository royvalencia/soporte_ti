<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;    
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Mailer\MailerAwareTrait;
use Cake\Mailer\Email;

/**
 * Entregas Controller
 *
 * @property \App\Model\Table\EntregasTable $Entregas
 *
 * @method \App\Model\Entity\Entrega[] paginate($object = null, array $settings = [])
 */
class EntregasController extends AppController
{
    use MailerAwareTrait;
    public $paginate = [
        'limit' => 25,
        'order' => [
            'Entregas.id' => 'desc'
        ]
    ];

     public $components = array('RequestHandler');

     public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        //$this->_validViewOptions[] = 'pdfConfig';
    }


     ########## REPARTIDORES 
 
/**
     * Index method
     * Entregas por hacer el usuario.
     * @return \Cake\Http\Response|void
     */
    public function indexRepartidores()
    {
        $entregas =  $entrega = $this->Entregas->find('all', [
            'contain' => ['Almacenes','StatusEntregas', 'DetalleEntregas'=>['Pedidos'=>['Clientes']]],
            'conditions'=>['Entregas.co_user_id'=>$this->Auth->user('co_user_id'),'Entregas.status_entrega_id'=>1]
        ]);
        $status = $this->Entregas->DetalleEntregas->getStatusDetalle();
        $statusDetalle = [];
        foreach($status as $key=> $statu){
          $objStatus = [];
          $objStatus['id'] = $key;
          $objStatus['descripcion'] =$statu;
          $statusDetalle[] = $objStatus;
        }
        $motivosGet  = $this->Entregas->DetalleEntregas->getMotivos();
        foreach($motivosGet as $motivo){
          $objMotivo =[];
          $objMotivo['descripcion'] =$motivo;
          $motivos[] = $objMotivo;
        }
        $this->set('statusDetalle',$statusDetalle);
        $this->set('motivos',$motivos);
        $this->set(compact('entregas','motivos','statusDetalle'));
        $this->set('_serialize', ['entregas','motivos','statusDetalle']);
    }

    public function viewRepartidores($id = null)
    {
       
        $entrega = $this->Entregas->find('all', [
            'contain' => ['StatusEntregas', 'DetalleEntregas'=>['Pedidos'=>['Clientes']]],
            'conditions'=>['Entregas.id'=>$id,'Entregas.co_user_id'=>$this->Auth->user('co_user_id')]
        ])->first();

        //obtenemos el detalle de los pedidos para imprmirlo
        /**
            * NOTA: Para esta consulta se debe habilitar la extension  intarray( create extension intarray) en postgresql para usar el orden sobre un arreglo
            * si se usara mysql es asi ORDER BY FIELD(67,23,1362,24)
        */
        $idPedidos = [];
         if (!empty($entrega->detalle_entregas)){
            foreach($entrega->detalle_entregas as $detalle){
                $idPedidos[] = $detalle->pedido_id;
            }
            $idsString = implode(',', $idPedidos);
             $pedidos = $this->Entregas->DetalleEntregas->Pedidos->find('all', [
                    'contain' => ['Clientes', 'StatusPedidos', 
                           'DetallePedidos'=>[ 'ProductosAlmacenes'=>['Productos'=>['UnidadMedidas']],
                                               'sort'=>['DetallePedidos.id'=>'ASC']
                                           ]

                        ],
                     'conditions'=>['Pedidos.id IN' =>$idPedidos] ,  
                     'order' =>' idx(ARRAY['.$idsString.'], Pedidos.id)'    
                    ]);
           
         }


             $this->viewBuilder()->options([
                'pdfConfig' => [
                    'orientation' => 'portrait',
                    'filename' => 'entrega_' . $id.'.pdf'
                ]]);

        $this->set('entrega', $entrega);
        $this->set('pedidos', $pedidos);
        $this->set('statusDetalle',$this->Entregas->DetalleEntregas->getStatusDetalle());
        $this->set('motivos',$this->Entregas->DetalleEntregas->getMotivos());
        $this->set('_serialize', ['entrega']);
    }


 ############################## 

  

     
/**
 * Marcar como pedido entregado un pedido
 * Si todos los pedidos de la entrega se entregan o no la entrega se marca como terminada
 * Status 0: por entregar 1: entregado 2: No entregado (Motivo no entregado) 
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
public function pedidoEntregado($id){

  $entrega_id =$this->request->query('entrega_id');
  $detalleEntrega = $this->Entregas->DetalleEntregas->get($id,['contain'=>['Pedidos']]);
  $success = false;
  if($detalleEntrega->status==0){ //Marcamos como entregado el pedido
    $detalleEntrega->status = 1;
    if($this->Entregas->DetalleEntregas->save($detalleEntrega)){
      $success = true;
      if($detalleEntrega->pedido->status_pedido_id==3 || $detalleEntrega->pedido->status_pedido_id==4){
        //marcamos como pedido entregado al pedido
        $result = $this->Entregas->connection()->update('pedidos', ['status_pedido_id' => 5], ['id' => $detalleEntrega->pedido->id]);
        $this->bitacoraPedidos($detalleEntrega->pedido_id,5); //Guardamos en la bitácora el evento
             //Enviamos un email a facturacion si esta marcado como true
                     if(Configure::read('email_facturacion')){
                        $pedidosTable= TableRegistry::get('Pedidos');
                         $pedido = $pedidosTable->get($detalleEntrega->pedido->id, [
                                    'contain' => ['Clientes',  
                                                   'DetallePedidos'=>['ProductosAlmacenes'=>['Productos'=>['UnidadMedidas']],
                                                                      //'saveStrategy'=>'replace',  
                                                                      'sort'=>['DetallePedidos.id'=>'ASC']   
                                               ],                                              
                                    ] 
                                ]);
                         $this->getMailer('Pedido')->send('facturacion', [$pedido]);
                     }
      }
      $porEntregar = $this->entregaCompletada($detalleEntrega->entrega_id); //Verificamos si ya se entregaron todos los pedidos
     $message = 'Pedido marcado como entregado';
    }else{
          $success = false;  
                 $message='No se pudo marcar como pedido entregado, intente de nuevo';                
                   foreach($cliente->errors() as $nameField=> $errorField){
                    $errors[$nameField] = [];
                     foreach($errorField as $key =>$value){
                        array_push($errors[$nameField],$value);
                        $message.=' '.$value.'.';
                    //   $errors[$key]=$value;
                     }
                   }
    }

  }else{
    $message =' El pedido ya fue entregado. Operación Cancelada.';
    $success = false;
  }
     $this->set(compact('success','errors','message'));
        $this->set('_serialize', ['success','errors','message']);

}
/**
 * Marcar un pedido no entregado
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
public function pedidoNoEntregado($id){
  //pr($this->request->getData());exit;
  if ($this->request->is('post')) { //Guardamos
    $data = $this->request->getData();
    //pr($data);exit;

    $detalleEntrega = $this->Entregas->DetalleEntregas->get($id,['contain'=>['Pedidos']]);
    if($detalleEntrega->status==0){ //Marcamos como entregado el pedido
      $detalleEntrega->status = 2;
      $detalleEntrega->motivo = $data['motivo'];
      if($this->Entregas->DetalleEntregas->save($detalleEntrega)){
        if($detalleEntrega->pedido->status_pedido_id==3 || $detalleEntrega->pedido->status_pedido_id==4){
          //marcamos como pedido entregado al pedido
          $result = $this->Entregas->connection()->update('pedidos', ['status_pedido_id' => 7], ['id' => $detalleEntrega->pedido->id]);
          $this->bitacoraPedidos($detalleEntrega->pedido_id,7); //Guardamos en la bitácora el evento          
        }
        $porEntregar = $this->entregaCompletada($detalleEntrega->entrega_id);
        $success =true;
        $message = 'Pedido marcado como No entregado.';
      }else{
                $success = false;  
                 $message='No se pudo marcar como pedido No entregado, intente de nuevo';                
                   foreach($cliente->errors() as $nameField=> $errorField){
                    $errors[$nameField] = [];
                     foreach($errorField as $key =>$value){
                        array_push($errors[$nameField],$value);
                        $message.=' '.$value.'.';
                    //   $errors[$key]=$value;
                     }
                   }

    }
      
  }else{
    $success = false;
    $message =' El pedido ya fue marcado anteriormente. Operación Cancelada.';
  }
     $this->set(compact('success','errors','message'));
        $this->set('_serialize', ['success','errors','message']);

  } 
}

/**
 * Marcamos como entrega completada si todos los pedidos han sido entregado o no entregados
 * @param  [type] $entrega_id [description]
 * @return [type]             [description]
 */
private function entregaCompletada($entrega_id){
  //Contamos los detalles
  $totalPorEntregar = $this->Entregas->DetalleEntregas->find('all',['conditions'=>['entrega_id'=>$entrega_id,'status'=>0]])->count();
  if($totalPorEntregar==0){
    $result = $this->Entregas->connection()->update('entregas', ['status_entrega_id' => 2], ['id' => $entrega_id]);
  }
  return $totalPorEntregar;
}
   

   


   
            
   
   

     private function bitacoraPedidos($pedido_id,$status_pedido_id){
        $bitacoraTable = TableRegistry::get('BitacoraPedidos');
       $bitacoraPedido = $bitacoraTable->newEntity();
       $bitacoraPedido->pedido_id =$pedido_id;
       $bitacoraPedido->status_pedido_id = $status_pedido_id;
       return $bitacoraTable->save($bitacoraPedido); 
 }
/**
 * agrega a la bitacora de pedidos varios pedidos a la vez
 */
 private function bitacoraPedidosBatch($pedidos_id,$status_pedido_id){
     
       return $this->Pedidos->BitacoraPedidos->save($bitacoraPedido); 
 }
}
