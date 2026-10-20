<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Utility\Security;
use Cake\Utility\Text;
use Cake\Routing\Router;



/**
 * CoUsers Controller
 *
 * @property \App\Model\Table\CoUsersTable $CoUsers
 */
class CoUsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['login', 'loginpaso1', 'loginpaso2','resetPassword']);
    }

    public $paginate = [
        'limit' => 25,
        'order' => [
            'CoUsers.co_user_id' => 'DESC'
        ]
    ];

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['logout','forgotPassword','register']);

    }



    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        //Para evitar el Cache
        $this->response->header('Cache-Control', 'no-cache');
        $conditions = $this->getFiltro(); //Filtro de la consulta

        //$this->paginate['contain'] = ['CoGroups','CentrosCapturas']; //Establecemos elcontain y conditions asi cuando usamos un order default
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
     * Index para administrar usuariios capturistas por municipio
     *
     * @return \Cake\Network\Response|null
     */
    public function indexCentro()
    {
        $conditions = $this->getFiltro(); //Filtro de la consulta

        //$conditions= array_merge(['CoUsers.co_group_id'=>4,'CoUsers.centros_captura_id IN' =>$this->Auth->user('centros_captura_id')],$conditions); //Solo capturistas de su municipio

        $this->paginate['conditions'] =$conditions;  //Asignamos el filtro de la consulta
       //  $this->log($this->municipiosUsuario());
        $coUsers = $this->paginate($this->CoUsers);
        //Tenemos que construir la consulta con matching y luego este query pasarlo al paginate a fin de encontrar los datos en una relacion HasBelongToMany como es el caso de muchos usuarios pertencen a muchos municipios
       /*
       $query = $this->CoUsers->find('all',['contain'=>['CoUsersMunicipios']])
                                    ->matching('CoUsersMunicipios')
                                    ->where($conditions);
        $coUsers = $this->paginate($query);
        */
        //$centrosCaptura = $this->CoUsers->CentrosCapturas->get($this->Auth->user('centros_captura_id'));
        $this->set(compact('coUsers'));
        $this->set('_serialize', ['coUsers']);

    }

/**
 * Determinamos el alcance del usuario para editar a otros usuarios solo de sus municipios asignados
 * @return [type] [description]
 */
    private function userScope(){
        $municipiosUsuario = $this->municipiosUsuario();

        $queryUsuariosMpios = $this->CoUsers->CoUsersMunicipios->find('list',['conditions'=>['CoUsersMunicipios.municipio_id IN '=>$municipiosUsuario]]);
        return $queryUsuariosMpios;
    }


    /**
     * View method
     *
     * @param string|null $id Co User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coUser = $this->CoUsers->get($id, [
            'contain' => ['CoGroups']
        ]);

        $this->set('coUser', $coUser);
        $this->set('_serialize', ['coUser']);
    }

    public function viewCentro($id = null)
    {
        //$coUser = $this->CoUsers->find('all',['conditions'=>['CoUsers.co_user_id'=>$id]])->first();
        $coUser = $this->CoUsers->get($id, [
            'contain' => ['CoGroups','Direcciones','Dependencias']
        ]);
        $this->set('coUser', $coUser);
        $this->set('_serialize', ['coUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coUser = $this->CoUsers->newEntity();
        if ($this->request->is('post')) {
            $coUser = $this->CoUsers->patchEntity($coUser, $this->request->data);
            if ($this->CoUsers->save($coUser)) {
                $this->Flash->success(__('Usuario agregado correctamente.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El usuario no fue agregado intente de nuevo.'));
            }
        }
        $coGroups = $this->CoUsers->CoGroups->find('list', ['limit' => 200]);
        //$centrosCapturas = $this->CoUsers->CentrosCapturas->find('list', ['order'=>'CentrosCapturas.descripcion','limit' => 200]);
        $this->set(compact('coUser', 'coGroups'));
        $this->set('_serialize', ['coUser']);
    }

    public function addCentro()
    {
        $coUser = $this->CoUsers->newEntity();
        $centrosCaptura = $this->CoUsers->CentrosCapturas->get($this->Auth->user('centros_captura_id'));
        if ($this->request->is('post')) {
            $coUser = $this->CoUsers->patchEntity($coUser, $this->request->data);
            $coUser->centros_captura_id = $this->Auth->user('centros_captura_id');
            $coUser->login = $centrosCaptura->iniciales.'_'. $coUser->login;
            $coUser->co_group_id = 4;
            if ($this->CoUsers->save($coUser)) {
                $this->Flash->success(__('Usuario agregado correctamente.'));
                return $this->redirect(['action' => 'index-centro']);
            } else {
                $this->Flash->error(__('El usuario no fue agregado intente de nuevo.'));
            }
        }

        $this->set(compact('coUser', 'coGroups','centrosCaptura'));
        $this->set('_serialize', ['coUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Co User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coUser = $this->CoUsers->get($id, [
            'contain' => ['CoGroups']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            if(empty($this->request->data['password'])){
                unset($this->request->data['password']);
            }
          //  $this->log($this->request->data);

           // pr($this->request->data);exit;
          $coUser = $this->CoUsers->patchEntity($coUser, $this->request->getData());
           $this->log($coUser);
            if ($this->CoUsers->save($coUser)) {
                $this->Flash->success(__('Usuario editado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El usuario no fue editado.'));
            }
        }
        unset($coUser->password);
     //   pr($coUser['password']);
        $coGroups = $this->CoUsers->CoGroups->find('list', ['limit' => 200]);
         //$centrosCapturas = $this->CoUsers->CentrosCapturas->find('list', ['order'=>'CentrosCapturas.descripcion','limit' => 200]);
        $this->set(compact('coUser', 'coGroups'));
        $this->set('_serialize', ['coUser']);
    }

     public function editCentro($id = null)
    {
         $coUser = $this->CoUsers->find('all',['contain'=>['CentrosCapturas'],'conditions'=>['CoUsers.co_user_id'=>$id,'CoUsers.centros_captura_id'=>$this->Auth->user('centros_captura_id')]])->first();

         if(!$coUser){
                   return $this->redirect(['action' => 'index-centro']);
         }
        if ($this->request->is(['patch', 'post', 'put'])) {

            if(empty($this->request->data['password'])){
                unset($this->request->data['password']);
            }
          //  $this->log($this->request->data);

           // pr($this->request->data);exit;
          $coUser = $this->CoUsers->patchEntity($coUser, $this->request->getData());
           $this->log($coUser);
            if ($this->CoUsers->save($coUser)) {
                $this->Flash->success(__('Usuario editado.'));
                return $this->redirect(['action' => 'index-centro']);
            } else {
                $this->Flash->error(__('El usuario no fue editado.'));
            }
        }
        unset($coUser->password);
     //   pr($coUser['password']);

        $this->set(compact('coUser', 'coGroups','centrosCapturas'));
        $this->set('_serialize', ['coUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Co User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coUser = $this->CoUsers->get($id);
        if ($this->CoUsers->delete($coUser)) {
            $this->Flash->success(__('Usuario Eliminado.'));
            $this->AddBitacora("Se elimino al usuario |".json_encode($coUser),$id);
        } else {
            $this->Flash->error(__('El usuario no fue eliminado, intente de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function deleteCentro($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
         $coUser = $this->CoUsers->find('all',['conditions'=>['CoUsers.co_user_id'=>$id,'CoUsers.centros_captura_id'=>$this->Auth->user('centros_captura_id')]])->first();

         if(!$coUser){
                   return $this->redirect(['action' => 'index-centro']);
         }
        if ($this->CoUsers->delete($coUser)) {
            $this->Flash->success(__('Usuario Eliminado.'));
            $this->AddBitacora("Se elimino al usuario |".json_encode($coUser),$id);
        } else {
            $this->Flash->error(__('El usuario no fue eliminado, intente de nuevo.'));
        }
        return $this->redirect(['action' => 'index-centro']);
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

   /**
   * Filtro del paginate
   *
   */
    public function getFiltro()
    {
        $session = $this->request->session(); //Manejo de sesiones en la version 3
        $argumentos = null;
        $conditions =[];
        if($session->check('argumentos'.$this->name)){
            $argumentos = $session->read('argumentos'.$this->name);
            $this->request->data = $argumentos;    //Para los datos en el view
           if(!empty($argumentos['login'])){
               $conditions['CoUsers.login like']=$argumentos['login'].'%';
           }
           if(!empty($argumentos['nombre'])){
               $conditions['CoUsers.nombre like']=$argumentos['nombre'].'%';
           }
           if(!empty($argumentos['co_group_id'])){
               $conditions['CoUsers.co_group_id']=$argumentos['co_group_id'];
           }
        }

        $this->set(compact('argumentos'));
        return $conditions;
    }

    /**
    * Usar FPDF
    *
    */
    public function usuariosPdf(){

        $query = $this->CoUsers->find("all",['contain'=>['CoGroups']]);
        $usuarios = $query->all();
        $this->set(compact('usuarios'));
    }

    /**
    * Exportar a EXcel
    *
    */
    public function usuariosExcel(){
         $this->viewBuilder()->layout('excel'); //Establecemos el Layout aqui
        $query = $this->CoUsers->find("all",['contain'=>['CoGroups']]);
        $usuarios = $query->all();
        $this->set(compact('usuarios'));
    }


    /**
    * Cambiar la contraseña del usuario, el chiste se hace en el validatorPassword de Model/Table/CoUsersTable.php
    *
    */
    public function changePassword(){
         $user = $this->CoUsers->get($this->Auth->user('co_user_id'));
         if (!empty($this->request->data)) {
             $user = $this->CoUsers->patchEntity($user, [
                    'old_password' => $this->request->data['old_password'],
                    'password' => $this->request->data['password1'],
                    'password1' => $this->request->data['password1'],
                    'password2' => $this->request->data['password2']],
                    ['validate' => 'password']
                    );
             if ($this->CoUsers->save($user)) {
                 $this->Flash->success('Contraseña actualizada con éxito');
                 $this->redirect($this->_getHomePage());//REdireccionamos a la pagina de inicio
             } else {
                 $this->Flash->error('La contraseña no fue actualizada, intente de nuevo');
             }
         }
         $this->set('user', $user);
    }
    /**
     * CAMBIAR DATOS COMO NOMBRE Y TELEFONO EN LA CUENTA DEL USUARIO
     *
     */
    public function changeInfo(){
        
        $user = $this->Auth->user();
        $coUser = $this->CoUsers->get($user['co_user_id']);

        if ($this->request->is('post')) {
            // Actualiza los datos del usuario con los datos del formulario
            $user = $this->CoUsers->patchEntity($coUser, $this->request->getData());

            if ($this->CoUsers->save($coUser)) {
                $this->Flash->success(__('Los datos del usuario han sido actualizados.'));
                return $this->redirect(['action' => 'change-password']); // Cambia a donde quieras redirigir
            } else {
                $this->Flash->error(__('No se pudieron actualizar los datos del usuario. Por favor, intenta de nuevo.'));
            }
        }

        // Pasa el usuario a la vista en caso de error
        //$this->set(compact('user'));
    }
    /**
    * Imagen de Perfil del usuario   , subida por el mismo usuario
    */
    public function uploadImage(){
        //Se obtiene los datos del usuario logueado
        $user = $this->Auth->user();
        $success = false;
        $data = ['message' => 'Ocurrio un error al procesar la imagen','errors'=> []];

        //Hay datos en la solicitud
        if (!empty($this->request->getData())) {
            // Obtenemos el archivo subido
            $file = $this->request->getData('upload');


            //Si no esta vacio file
            if (!empty($file['name'])) {

                $maxSize = 2 * 1024 * 1024; // 2 MB
                if ($file['size'] > $maxSize) {
                    $this->Flash->error('El archivo es demasiado grande. Tamaño máximo permitido: 2 MB.');
                    $this->redirect(['action' => 'change-password']);
                    return;
                }
                // Obtenemos la extensión del archivo
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                // Que Extensiones permitidas
                $allowExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                // Generar un nuevo nombre para el archivo
                $newFileName = time() . "_" . rand(100000, 999999) . '.' . $ext;

                //Validamos la extension del Archivo
                if (in_array($ext, $allowExtensions)) {
                    // Ruta donde se guardará la imagen
                    $uploadPath = WWW_ROOT . 'upload' . DS . 'avatar' . DS;

                    // Crear la carpeta si no existe
                    if (!file_exists($uploadPath)) {
                        mkdir($uploadPath, 0775, true);
                    }

                    // Mover el archivo subido a la carpeta de destino
                    if (move_uploaded_file($file['tmp_name'], $uploadPath . $newFileName)){
                        // Obtener el usuario de la base de datos
                        $coUser = $this->CoUsers->get($user['co_user_id']);

                        // Borrar la imagen anterior si existe
                        if (!empty($coUser->image) && file_exists($uploadPath . $coUser->image)) {
                            unlink($uploadPath . $coUser->image);
                        }

                        // Guardar el nombre de la nueva imagen en la base de datos
                        $coUser->image = $newFileName;
                        if ($this->CoUsers->save($coUser)) {
                            $success = true;
                            $this->Auth->setUser($coUser->toArray()); // Actualizar la sesión del usuario
                            $this->Flash->success('Imagen de perfil actualizada con éxito.');
                        } else {
                            $this->Flash->error('No se pudo actualizar la imagen de perfil. Inténtelo de nuevo.');
                        }
                    } else {
                        $this->Flash->error('Error al mover el archivo subido. Verifique los permisos de la carpeta.');
                    }
                } else {
                    $this->Flash->error('Extensión de archivo no válida. Solo se permiten JPG, JPEG, PNG y GIF.');
                }
            } else {
                $this->Flash->error('No se seleccionó ningún archivo para subir.');
            }
        } else {
            $this->Flash->error('No se recibieron datos en la solicitud.');
        }

        $this->redirect(['action' => 'change-password']); // Redirigir a la página de perfil
    }

    /**
    * Quitar imagen de perfil
    *
    */
    public function removeImg(){
         $user = $this->Auth->user();
         if($user['image']){

               $id = $user['co_user_id'];
               $coUser = $this->CoUsers->get($id, [
                            'contain' => []
                ]);
                $coUser->image = '';
                 if ($this->CoUsers->save($coUser)) {
                          @unlink( WWW_ROOT . DS.'upload'.DS.'avatar'.DS .$user['image']);
                          $success =true;
                           $this->Auth->setUser($coUser->toArray());
                          $this->Flash->success('Imagen de Perfil eliminada con éxito');
                 } else {
                          $success =false;
                          $this->Flash->error('La imagen de perfil no fue eliminada, intente de nuevo');
                 }


         }
          $this->redirect(['action'=>'change-password']);

    }

    /**
    * Obtener el Home page del usuario
    *
    */
  private  function _getHomePage(){
        $group_id = $this->Auth->user('co_group_id');
        //buscamos en el grupo los datos del home page
        $grupo=  $this->CoUsers->CoGroups->find('all',['conditions'=>['CoGroups.co_group_id'=>$group_id]])->first();;
        if(strlen($grupo->home_page)>0){
            $url=$grupo->home_page;
        }else{  //Si no tiene pagina de inicio(home Page) default lo desviamos al home principal
          $url = $this->Auth->redirectUrl();
        }
        return $url;
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

    /**
     * Para Recuperar Contraseña
     **/
    //Busca el correo si esta activo y envia url para recuperacion
    public function forgotPassword(){
        //Se usa un Layout que esta Vacio
        $this->viewBuilder()->setLayout('plano');

        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $usersTable = $this->getTableLocator()->get('co_users');

            //Encuentra el Email y si la cuenta esta Activa
            $user = $usersTable->find('all')
                ->select(['co_user_id','email','active','nombre'])
                ->where(['email' => $email,'active' => 1])
                ->first();

            if ($user) {
                //Se genera un token para el resetear contraseña
                $token = Security::hash(Text::uuid(), 'sha256', true);
                //Asignamos el token y fecha de modificacion al campo que le corresponden
                $user->tokenhash = $token;
                $user->modified = date('Y-m-d H:i:s');


                if ($usersTable->save($user)) {
                    // Crear enlace de restablecimiento
                    $resetUrl = Router::url([
                        'controller' => 'CoUsers',
                        'action' => 'resetPassword',
                        $token
                    ], true);

                    try {
                        // Enviar el email con la nueva contraseña temporal
                        $email = new Email('default');
                        $email->setTo($user->email)
                            ->setSubject('Solicitud de Recuperación de Contraseña')
                            ->setEmailFormat('html')
                            ->setTemplate('reset_password')
                            ->setViewVars([
                                'reseturl' => $resetUrl,
                                'name' => $user->nombre
                            ])
                            ->send();
                        $this->Flash->success('Se ha Enviado un enlace de Recuperación al Correo Registrado.');
                    } catch (\Exception $e){
                        $this->Flash->error(__('No se pudo enviar el correo de Recuperación. Por favor, contacta al soporte.'));
                        //Registra el error para su revisión
                        \Cake\Log\Log::write('error', 'Error al enviar correo de Recuperar Contraseña: ' . $e->getMessage());
                    }
                } else {
                    $this->Flash->error('Hubo un error al general enlace de Recuperación, Intente de Nuevo.');
                }
            } else {
                $this->Flash->success('Si la cuenta Existe y esta Activa, se enviara un correo de Recuperación.');
            }
        }
    }

    //Hace el cambio para la nueva contraseña cuando le llega el token
    public function resetPassword($token = null)
    {
        $this->viewBuilder()->setLayout('plano');

        //Si no llega Token
        if (!$token){
            $this->Flash->error('Token Invalido o no Existe.');
            return $this->redirect(['action' => 'login']);
        }
        //Buscamos al Usuario que tenga el token que llego
        $usersTable = $this->getTableLocator()->get('co_users');
        $user = $usersTable->find()
            ->where(['tokenhash' => $token])
            ->first();

        //Si no llega el usuario se manda al login
        if (!$user){
            $this->Flash->error('El Enlace no es valido o ya fue utilizado');
            return $this->redirect(['action' => 'login']);
        }

        //Validamos las contraseñas del formulario
        if ($this->request->is(['post','put'])){
            $password = $this->request->getData('password');
            $passwordConfirm = $this->request->getData('password_confirm');

            if ($password !== $passwordConfirm){
                $this->Flash->error('Las Contraseñas no Coinciden.');
            }else {
                $user->password = $password;
                $user->tokenhash = null;
                $user->modified = date('Y-m-d H:i:s');

                if ($usersTable->save($user)){
                    $this->Flash->success('Tu Contraseña ha si restablecida con Exito!!.');
                    return $this->redirect(['action' => 'login']);
                }else{
                    $this->Flash->error('No se pudo establecer la Contraseña. Intente de Nuevo');
                }
            }
        }
        $this->set(compact('user'));

    }

    /**
     * Login por Pasos
     **/
    /** V2 */
    public function login()
    {
        if ($this->request->is('post')) {
        // Procesa la solicitud del correo electrónico aquí si es necesario
        }
        $this->viewBuilder()->setLayout('login');
        $this->render('loginpaso1');
    }
    public function loginpaso1()
    {
        if ($this->request->is('post')) {
            $login = $this->request->getData('login');
            $user = $this->CoUsers->find('all', [
                'conditions' => [
                    'CoUsers.login' => $login,
                    'CoUsers.active' => 1
                ],
                'fields' => ['login']
            ])->first();
            /*debug($user);
            die();*/

           if ($user) {
                $this->set('login', $login);
               $this->viewBuilder()->setLayout('login');
               return $this->render('loginpaso2');
            } else {
                $this->Flash->error('Usuario no encontrado o usuario inactivo.');
                return $this->redirect(['action' => 'login']);
            }
        }

    }
    public function loginpaso2()
    {
        //$this->viewBuilder()->setLayout('login');

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                // Registrar el último inicio de sesión

                $query = $this->CoUsers->query();
                $query->update()
                    ->set(['last_login' => date('Y-m-d H:i:s')])
                    ->where(['co_user_id' => $this->Auth->user('co_user_id')])
                    ->execute();

                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error('Contraseña incorrecta, intente nuevamente.');
                return $this->redirect(['action' => 'login']);
            }
        }
        $this->viewBuilder()->setLayout('login');
        $this->render('loginpaso2');
    }

    /** CREACION DE CUENTAS */
    public function register()
    {
        $this->viewBuilder()->setLayout('plano');

        $coUser = $this->CoUsers->newEntity();
        if ($this->request->is('post')) {
            $coUser = $this->CoUsers->patchEntity($coUser, $this->request->getData());
            $coUser->login = $coUser->email;
            $coUser->co_group_id = 2;
            $coUser->active = 1;
            $coUser->super = 0;
            $coUser->image = '';


            if ($this->CoUsers->save($coUser))
            {
                try{
                    $email = new Email('default');
                    $rutaArchivo = WWW_ROOT .'upload' .DS. 'manual_soporte_tic.pdf';
                    $email->setTo($coUser->email)
                        ->setSubject('Gracias por Registrarte')
                        ->setEmailFormat('html')
                        ->setTemplate('register')
                        ->setViewVars(['coUser' => $coUser, 'LinkPagina' => RUTA_PRINCIPAL])
                        ->addAttachments($rutaArchivo,'Manual_Usuario.pdf')
                        ->send();

                    $this->Flash->success(__('El usuario ha sido guardado.'));
                }catch (\Exception $e){
                    // Manejar el error del envío de correo
                    $this->Flash->error(__('El usuario ha sido guardado, pero no se pudo enviar el correo de verificación. Por favor, contacta al soporte.'));
                    // Opcional: Registra el error para su revisión
                    \Cake\Log\Log::write('error', 'Error al enviar correo de verificación: ' . $e->getMessage());
                }


                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('No se pudo guardar el usuario. Por favor, intente nuevamente.'));
        }
        $dependencias = $this->CoUsers->Dependencias->find('list', ['limit' => 200]);
        $direcciones = $this->CoUsers->Direcciones->find('list', ['limit' => 200]);
        $this->set(compact('coUser', 'dependencias', 'direcciones'));
    }

}
