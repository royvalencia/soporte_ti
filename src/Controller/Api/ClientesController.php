<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;     
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
/**
 * Clientes Controller
 *
 * @property \App\Model\Table\ClientesTable $Clientes
 *
 * @method \App\Model\Entity\Cliente[] paginate($object = null, array $settings = [])
 */
class ClientesController extends AppController
{

     public $paginate = [
        'limit' => 10,
        'order' => [
            'Clientes.id' => 'desc'
        ]
    ];

    public $components = array('RequestHandler');


    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');       
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
         $conditions = [];
        $this->paginate['conditions'] =array_merge(['Clientes.activo'=>true],$conditions);  //Asignamos el filtro de la consulta
        $clientes = $this->paginate($this->Clientes);
         $pagination=$this->request->params['paging']['Clientes'];   
        $this->set(compact('clientes','pagination'));
        $this->set('_serialize', ['clientes','pagination']);
    }

    public function search()
{
    
     //   $this->autoRender = false;
        $name = $this->request->query['nombre'];
        $clientes = $this->Clientes->find('all', [          
            'conditions' => [ 'OR' => [
                'nombre ILIKE' =>'%'. $name . '%',
                'nombre_contacto ILIKE' =>'%'. $name . '%',
                ],
                'activo'=>true
            ],
            'order'=>'Clientes.nombre',
            'limit'=>'10'
        ]);
      
       $this->set(compact('clientes'));
       $this->set('_serialize',['clientes']);    
  }

    /**
     * View method
     *
     * @param string|null $id Cliente id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cliente = $this->Clientes->get($id, [
            'contain' => ['Pedidos']
        ]);

         $this->set('cliente', $cliente);
        $this->set('_serialize', ['cliente']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cliente = $this->Clientes->newEntity();
       $errors = [];
        if ($this->request->is('post')) {
            $cliente = $this->Clientes->patchEntity($cliente, $this->request->getData());
            $cliente->created_by = $this->Auth->user('co_user_id');
            if ($this->Clientes->save($cliente)) {
               $success = true;               
                $message = 'Cliente agregado con exito';
            }else{
                 $success = false;  
                 $message='No se pudo agregar el cliente, intente de nuevo';                
                   foreach($cliente->errors() as $nameField=> $errorField){
                    $errors[$nameField] = [];
                     foreach($errorField as $key =>$value){
                        array_push($errors[$nameField],$value);
                        $message.=' '.$value.'.';
                    //   $errors[$key]=$value;
                     }
                   }
            }
            
        }
         
        $this->set(compact('cliente','success','errors','message'));
        $this->set('_serialize', ['cliente','success','errors','message']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cliente id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cliente = $this->Clientes->get($id, [
            'contain' => []
        ]);
          $errors = [];
        if ($this->request->is(['patch', 'post', 'put'])) {
          //   pr($this->request->getData());exit;
            $cliente = $this->Clientes->patchEntity($cliente, $this->request->getData());
            if($cliente->email==null){
                $cliente->email ='';
            }
         //   pr($cliente);exit;
            if ($this->Clientes->save($cliente)) {
              $success = true;               
                $message = 'Cliente editado con éxito';
            }else{
                 $success = false;  
                 $message='No se pudo editar.';      

                   foreach($cliente->errors() as $nameField=> $errorField){
                    $errors[$nameField] = [];
                     foreach($errorField as $key =>$value){
                        array_push($errors[$nameField],$value);
                        $message.=' '.$value.'.';
                    //   $errors[$key]=$value;
                     }
                   }
            }
        }
          $this->set(compact('cliente','success','errors','message'));
        $this->set('_serialize', ['cliente','success','errors','message']);
    }





   




  
}
