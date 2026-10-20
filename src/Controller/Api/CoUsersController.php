<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;     
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;



/**
 * CoUsers Controller
 *
 * @property \App\Model\Table\CoUsersTable $CoUsers
 */
class CoUsersController extends AppController
{

      public $paginate = [
        'limit' => 25,
        'order' => [
            'CoUsers.co_user_id' => 'DESC'
        ]
    ];
      
      public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['add', 'token']);
    }


    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $conditions = $this->getFiltro(); //Filtro de la consulta
       
        $this->paginate['contain'] = ['CoGroups']; //Establecemos elcontain y conditions asi cuando usamos un order default
        $this->paginate['conditions'] =$conditions;  //Asignamos el filtro de la consulta
        /*
        //Cuando no se usa un order default entonces el paginate se usa asi
        $this->paginate = [
            'contain' => ['CoGroups'],
            'conditions'=>$conditions
        ];
        */        
        $coUsers = $this->paginate($this->CoUsers);
        
        $coGroups = $this->CoUsers->CoGroups->find('list', ['limit' => 200]);     
        $this->set(compact('coUsers','coGroups'));
        $this->set('_serialize', ['coUsers','coGroups']);
       
    }

       /**
    * VErificamos un token para el login
    * 
    */
    public function token()
{
    $user = $this->Auth->identify();
   // print_r('data: '); print_r($this->request->getData());print_r($this->request->input('json_decode'));exit;
    
    if (!$user) {
        //throw new UnauthorizedException('Invalid username or password');
        $this->set([
        'success' => false,
        'data' => [
          
        ],
         'message'=>'Nombre de usuario o contraseña incorrectos',
        '_serialize' => ['success', 'data','message']
    ]);
        
    }else{

    $this->set([
        'success' => true,       
        'data' => [
             'exptime' =>date('Y-m-d H:i:s',time() + (30 * 24 * 60 * 60)),
            'user' =>$user,
            'token' => JWT::encode([
                'sub' => $user['co_user_id'],
                'exp' =>  time() +  (30 * 24 * 60 * 60)
            ],
            Security::salt())
        ],
        'message'=>'Login Success',
        '_serialize' => ['success', 'data','message']
    ]);
    }
}
    
       public function uploadImage(){
        $user = $this->Auth->user();
        $success = false;  
        $data = array('message'=>'Ocurrio un error al procesar la imagen','errors'=>array());  
        $imageFileName = false;    
     //   pr($this->request);exit;
         if ($this->request->is(['patch', 'post', 'put','options'])) {
             //Se envia como form-data normal en lugar de application/x-www-form-urlencoded
             if (!empty($this->request->data)) {
                 
                if (!empty($this->request->data['upload']['name'])) {
                $file = $this->request->data['upload']; //put the data into a var for easy use

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                $setNewFileName = time() . "_" . rand(000000, 999999);

                //only process if the extension is valid
                if (in_array($ext, $arr_ext)) {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is 
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . DS.'upload'.DS.'avatar'.DS . $setNewFileName . '.' . $ext);

                    //prepare the filename for database entry 
                    $imageFileName = $setNewFileName . '.' . $ext;
                    if($imageFileName){ //Guardamos la imagen en la BD
                        $user = $this->Auth->user();
                        $id = $user['id'];
                        $propietario = $this->Propietarios->get($id, [
                            'contain' => []
                        ]);                        
                        //Borramos la imagen anterior si existe
                            if($propietario->image){
                                @unlink( WWW_ROOT . DS.'upload'.DS.'avatar'.DS .$propietario->image);
                            }
                        //Actualizamos la imagen de perfil en la BD                    
                         $propietario->image = $imageFileName;
                        if ($this->Propietarios->save($propietario)) {
                          $success =true;
                          $data['message'] ="Se ha subido la imagen correctamente";
                          $data['image'] =$imageFileName;
                       } else {
                          $success =false;
                          $data['message'] ="Ocurrió un erro al guardar la imagen, intente de nuevo";
                       }                  
                      
                    }
                }else{
                        $success =false;
                        $data['message'] = 'Extension de archivo no válida';
                        $data['errors'] = array();
                }
              }      
           }
         }
         $this->set(compact('data','success'));
        $this->set('_serialize', ['success','data']);
    }
    
    public function changePassword(){
           $data = array();
        $success = false;  
         $propietario = $this->Propietarios->get($this->Auth->user('id'));
       //  pr($propietario);exit;
         if (!empty($this->request->data)) {
             $user = $this->Propietarios->patchEntity($propietario, [
                    'old_password' => $this->request->data['old_password'],
                    'password' => $this->request->data['password1'], 
                    'password1' => $this->request->data['password1'],
                    'password2' => $this->request->data['password2']], 
                    ['validate' => 'password']
                    );
             if ($this->Propietarios->save($propietario)) {
                  $success = true;
             } else {
                  $data['message']='No se pudo cambiar la contraseña del usuario, intente de nuevo';
                  $data['error']  = [];
                   foreach($propietario->errors() as $errorField){
                     foreach($errorField as $key =>$value){
                        array_push($data['error'],$value);
                     }
                   }
             }
         }
          $this->set(compact('data','success'));
        $this->set('_serialize', ['success','data']);
    }
    
    
    
   
    
  

    /**
    * Cerrar Sesion
    * 
    */
    public function logout()   
    {
         $this->request->session()->destroy();//Destruimos la sesions por aquello del os permisos
        return $this->redirect($this->Auth->logout());
    }
}
