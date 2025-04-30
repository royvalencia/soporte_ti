<?php

namespace App\Controller;

use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Servicios Controller
 *
 * @property \App\Model\Table\ServiciosTable $Servicios
 *
 * @method \App\Model\Entity\Servicio[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ServiciosController extends AppController
{


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        //Para evitar Cache
        $this->response->header('Cache-Control', 'no-cache');

        $conditions = $this->getFiltro(); //Filtro de la consulta

        $user = $this->Auth->User('co_user_id');
        $grupo = $this->Auth->User('co_group_id');

        $this->loadModel('CoGroups');
        $grupos2 = $this->CoGroups->find('all', ['conditions' => ['co_group_id' => $grupo]]);
        foreach ($grupos2 as $grupo2) {
            $tipo = $grupo2->tipo;
        }

        if ($tipo == 1) {
            $this->paginate = [
                'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers'],
                'order' => ['servicio_id DESC'],
                'conditions' => $conditions
            ];
            $servicios = $this->paginate($this->Servicios);
        } elseif ($tipo == 2) {
            $grupoB[] = $grupo;
            $grupos3 = $this->CoGroups->find('all', ['conditions' => ['supervisor_padre' => $grupo]])->toArray();
            foreach ($grupos3 as $grupo3) {
                $grupoB[] = $grupo3->co_group_id;
            }
            $conditions2 = array(
                array('Servicios.co_user_id' => $user),
                array('Servicios.co_group_id IN' => $grupoB)
            );
            $conditions['OR'] = $conditions2;
            /*$conditions=array (
                'OR' => array(
                    array('Servicios.co_user_id' => $user),
                    array('Servicios.co_group_id IN' => $grupoB),
                ));*/
            $this->paginate = [
                'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers'],
                'order' => ['servicio_id DESC'],
                'conditions' => $conditions

            ];
            $servicios = $this->paginate($this->Servicios);
        } elseif ($tipo == 3) {
            $conditions2 = array(
                array('Servicios.co_user_id' => $user),
                array('Servicios.agente' => $user)
            );
            $conditions['OR'] = $conditions2;


            $this->paginate = [
                'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers'],
                'order' => ['servicio_id DESC'],
                'conditions' => $conditions

            ];
            $servicios = $this->paginate($this->Servicios);
        } elseif ($tipo == 4) {
            $conditions['Servicios.co_user_id'] = $user;
            $this->paginate = [
                'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers'],
                'order' => ['servicio_id DESC'],
                'conditions' => $conditions
            ];
            $servicios = $this->paginate($this->Servicios);
        }

        $coGroups = $this->Servicios->CoGroups->find('list', array(
            'conditions' => array(
                'tipo IN' => array(2, 3)
            ),
            'order' => array('name' => 'ASC')
        ));

        $agentes = $this->Servicios->CoUsers->find('list', array(
            'contain' => array('CoGroups'),
            'conditions' => array(
                'CoGroups.tipo IN' => array(1, 2, 3)
            ),
            'order' => array('CoUsers.nombre' => 'ASC')
        ))->toArray();

        $usuarios = $this->Servicios->CoUsers->find('list', array(
            'contain' => array('CoGroups'),
            'conditions' => array(
                'CoGroups.tipo' => 4
            ),
            'order' => array('CoUsers.nombre' => 'ASC')
        ))->toArray();

        $status = $this->Servicios->Status->find('list');
        $tipoIncidencias = $this->Servicios->TipoIncidencias->find('list');
        $grupos = $this->Servicios->Grupos->find('list');

        if ($tipo != 4) {
            $this->loadModel('Servicios');
            foreach ($servicios as $servicio):
                $query = $this->Servicios->query();
                $query->update()
                    ->set(['estado' => 1])
                    ->where(['servicio_id' => $servicio->servicio_id])
                    ->execute();
            endforeach;
        }


        $this->set(compact('servicios', 'agentes', 'usuarios', 'status', 'tipoIncidencias', 'grupos', 'tipo', 'coGroups'));
    }

    /**
     * View method
     *
     * @param string|null $id Servicio id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        //Para evitar Cache
        $this->response->header('Cache-Control', 'no-cache');


        $user = $this->Auth->User('co_user_id');
        $grupo = $this->Auth->User('co_group_id');
        $emailuser = $this->Auth->User('email');
        $nombreuser = $this->Auth->User('nombre');

        $this->loadModel('CoGroups');
        $grupos2 = $this->CoGroups->find('all', ['conditions' => ['co_group_id' => $grupo]]);
        foreach ($grupos2 as $grupo2) {
            $tipo = $grupo2->tipo;
            $padre = $grupo2->supervisor_padre;
        }


        if ($tipo == 1) {
            try {
                $servicio = $this->Servicios->get($id, [
                    'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers']
                ]);
            } catch (\Exception $e) {
                $this->Flash->error(__('No tiene permitido el acceso.'));
                return $this->redirect(['action' => 'index']);
            }
        } elseif ($tipo == 2) {
            $grupoB[] = $grupo;
            $grupos3 = $this->CoGroups->find('all', ['conditions' => ['supervisor_padre' => $grupo]])->toArray();
            foreach ($grupos3 as $grupo3) {
                $grupoB[] = $grupo3->co_group_id;
            }
            $conditions2 = array(
                array('Servicios.co_user_id' => $user),
                array('Servicios.co_group_id IN' => $grupoB)
            );
            $conditions['OR'] = $conditions2;
            try {
                $servicio = $this->Servicios->get($id, [
                    'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers'],
                    'conditions' => $conditions
                ]);
            } catch (\Exception $e) {
                $this->Flash->error(__('No tiene permitido el acceso.'));
                return $this->redirect(['action' => 'index']);
            }
        } elseif ($tipo == 3) {
            $conditions2 = array(
                array('Servicios.co_user_id' => $user),
                array('Servicios.agente' => $user)
            );
            $conditions['OR'] = $conditions2;
            try {
                $servicio = $this->Servicios->get($id, [
                    'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers'],
                    'conditions' => $conditions
                ]);
            } catch (\Exception $e) {
                $this->Flash->error(__('No tiene permitido el acceso.'));
                return $this->redirect(['action' => 'index']);
            }
        } elseif ($tipo == 4) {
            $conditions['Servicios.co_user_id'] = $user;
            try {
                $servicio = $this->Servicios->get($id, [
                    'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers'],
                    'conditions' => $conditions
                ]);
            } catch (\Exception $e) {
                $this->Flash->error(__('No tiene permitido el acceso.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $agenteanterior = $servicio->agente;
        $estadoanterior = $servicio->statu_id;
        //$user = $this->Auth->User('co_user_id');
        //$grupo = $this->Auth->User('co_group_id');

        //llamar a modelo Adjuntos
        $this->loadModel('Adjuntos');
        $adjuntos = $this->Adjuntos->find('all', ['conditions' => ['Adjuntos.servicio_id' => $id, 'Adjuntos.archivo !=' => ""]]);


        //llamar a modelo Comentarios
        $this->loadModel('Comentarios');
        $comentarios = $this->Comentarios->find('all', ['contain' => ['Servicios', 'CoUsers'], 'conditions' => ['Comentarios.servicio_id' => $id]]);

        $comentario = $this->Comentarios->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            //VALIDACION DEL PESO DE ARCHIVO
            if ($_SERVER['CONTENT_LENGTH'] > 30 * 1024 * 1024) { // 30 MB
                $this->Flash->error('El archivo excede el límite de tamaño permitido (30 MB).');
                return $this->redirect(['action' => 'view/' . $id]);
            }
            if (isset($_POST['Responder'])) {
                $comentario = $this->Comentarios->patchEntity($comentario, $this->request->getData());
                $nuevosValores = array("servicio_id" => $this->request->data['servicio_id'], "fecha_creacion" => $this->request->data['fecha_creacion']);

                $actualizacion = $this->Servicios->get($this->request->data['servicio_id'], [
                    'contain' => []
                ]);
                $actualizacion = $this->Servicios->patchEntity($actualizacion, $nuevosValores);

                /*$tamaniotexto = strlen($comentario->texto);
                if ($tamaniotexto > 2147000000) {
                    $this->Flash->error('No se guardó el servicio ya que las imagenes anexadas directamente en el texto sobrepasan el límite. Por favor Anexe sus Imagenes como adjuntos');
                } else { */

                try {

                    if ($result2 = $this->Comentarios->save($comentario)) {
                        $result33 = $this->Servicios->save($actualizacion);
                        //dd($result2);
                        //---------------
                        // Verificamos si se seleccionaron archivos
                        //if (isset($_FILES['archivos']) && !empty($_FILES['archivos']['name'][0])) {
                        $entro = 0;
                        if (!empty($this->request->data['archivos'][0]['name'])) {
                            $entro = 1;
                            if (!is_dir('upload/archivos/' . $id)) {
                                mkdir('upload/archivos/' . $id, 0777, true);
                            }

                            $archivosSubidos = $this->request->data['archivos'];
                            $numArchivos = count($archivosSubidos) - 1;

                            $archivosGuardados = [];

                            $cont = 0;
                            // Iteramos sobre los archivos subidos

                            for ($i = 0; $i < $numArchivos; $i++) {
                                $nombreArchivo = $archivosSubidos[$i]['name'];
                                $tmpArchivo = $archivosSubidos[$i]['tmp_name'];
                                $errorArchivo = $archivosSubidos[$i]['error'];

                                //$comentario_id='';
                                //$comentario_id=$result2->comentario_id;
                                //armamos los datos de los archivos para la DB
                                $data[$cont] = [
                                    'servicio_id' => $id,
                                    'comentario_id' => $result2->comentario_id,
                                    'descripcion' => '',
                                    'archivo' => $nombreArchivo
                                ];

                                $cont++;


                                if ($errorArchivo === 0) {
                                    $rutaDestino = 'upload/archivos/' . $id . '/' . basename($nombreArchivo);

                                    // Movemos el archivo al directorio de destino
                                    if (move_uploaded_file($tmpArchivo, $rutaDestino)) {
                                        $archivosGuardados[] = $rutaDestino;
                                    } else {
                                        echo "Error al mover el archivo $nombreArchivo.<br>";
                                    }
                                } else {
                                    echo "Error al subir el archivo $nombreArchivo. Código de error: $errorArchivo.<br>";
                                }
                            }

                            // Si se subieron archivos con éxito
                            if (!empty($archivosGuardados)) {
                                echo "Los siguientes archivos se subieron con éxito:<br>";
                                foreach ($archivosGuardados as $archivo) {
                                    echo "<a href='$archivo' target='_blank'>$archivo</a><br>";
                                }
                            }
                        }


                        $adjuntos = TableRegistry::get('adjuntos');

                        if ($entro == 1) {
                            $entidades = $adjuntos->newEntities($data);
                            if ($result3 = $adjuntos->saveMany($entidades)) {
                                //$this->Flash->success(__('The servicio has been saved.'));
                                //return $this->redirect(['action' => 'view/' . $id]);
                            };
                        }

                        if ($comentario->tipo == 1) { //Se envia correo si no es nota privada

                            $registradoPorUsuario = $this->Servicios->CoUsers->get($servicio->co_user_id); // Obtener el usuario que registró el servicio
                            $agentes = $this->Servicios->CoUsers->get($servicio->agente);
                            $emailagente = $agentes->email;
                            $nombreagente = $agentes->nombre;
                            $LinkTicket = RUTA_PRINCIPAL . 'servicios/view/' . $servicio->id;

                            if ($comentario->co_user_id == $registradoPorUsuario->co_user_id) {
                                $email = new Email('default');
                                $email->setTo($emailagente)
                                    ->setSubject('Nuevo Comentario en la Incidencia')
                                    ->setEmailFormat('html')
                                    ->setTemplate('replyticket')
                                    ->setViewVars([
                                        'servicio' => $servicio,
                                        'username' => $nombreagente,
                                        'numeroServicio' => $servicio->servicio_id,
                                        'comentario' => $this->request->getData('texto'),
                                        'atendidoPor' => $nombreuser, // Nombre del usuario que respondió
                                        'LinkTicket' => $LinkTicket
                                    ]);
                            } else {
                                $email = new Email('default');
                                $email->setTo($registradoPorUsuario->email)
                                    ->setSubject('Nuevo Comentario en su Incidencia')
                                    ->setEmailFormat('html')
                                    ->setTemplate('replyticket')
                                    ->setViewVars([
                                        'servicio' => $servicio,
                                        'username' => $registradoPorUsuario->nombre,
                                        'numeroServicio' => $servicio->servicio_id,
                                        'comentario' => $this->request->getData('texto'),
                                        'atendidoPor' => $nombreuser, // Nombre del usuario que respondió
                                        'LinkTicket' => $LinkTicket
                                    ]);
                            }

                            try {
                                $email->send();
                                $this->Flash->success('El correo de notificación se envió correctamente.');
                            } catch (Exception $e) {
                                $this->Flash->error('Error al enviar el correo de notificación: ' . $e->getMessage());
                            }
                        }



                        $this->Flash->success(__('El Comentario fué guardado con éxito.'));

                        return $this->redirect(['action' => 'view/' . $id]);
                    }
                    $this->Flash->error(__('El Comentario NO fué guardado. Por favor, intente otra vez.'));
                } catch (Exception $e) {
                    $this->Flash->error('Error: las imagenes ingresadas en el area de texto exceden el limite permitido. favor de agregarlas como archivos adjuntos: ' . $e->getMessage());
                }

                //}
            } elseif (isset($_POST['GuardarE'])) {
                $servicio2 = $this->Servicios->patchEntity($servicio, $this->request->getData());
                $agentenuevo = $this->request->data['agente'];
                $estadonuevo = $this->request->data['statu_id'];

                if ($agentenuevo != $agenteanterior) {
                    //enviar correo
                    $agentes = $this->Servicios->CoUsers->get($agenteanterior);
                    $emailagenteant = $agentes->email;
                    $nombreagenteant = $agentes->nombre;

                    $agentes = $this->Servicios->CoUsers->get($agentenuevo);
                    $emailagentenue = $agentes->email;
                    $nombreagentenue = $agentes->nombre;

                    $LinkTicket = RUTA_PRINCIPAL . 'servicios/view/' . $servicio->id;


                    //Envio de Correo de Notificacion
                    $email2 = new Email('default');
                    $email2->setTo($emailagentenue)
                        ->setSubject('Nueva Asignación de Incidencia')
                        ->setEmailFormat('html')
                        ->setTemplate('reasignaage')
                        ->setViewVars([
                            'servicio' => $servicio,
                            'username' => $nombreagentenue,
                            'noticket' => $servicio->servicio_id,
                            'LinkTicket' => $LinkTicket

                        ]);

                    try {
                        $email2->send();
                        $this->Flash->success('El correo de notificación se envió correctamente.');
                    } catch (Exception $e) {
                        $this->Flash->error('Error al enviar el correo de notificación: ' . $e->getMessage());
                    }
                }

                if ($estadonuevo != $estadoanterior &&  $estadonuevo==6) {
                    //enviar correo al director general
                    

                    $agentes = $this->Servicios->CoUsers->get(14);
                    $emailagentenue = $agentes->email;
                    $nombreagentenue = $agentes->nombre;

                    $LinkTicket = RUTA_PRINCIPAL . 'servicios/view/' . $servicio->id;


                    //Envio de Correo de Notificacion
                    $email2 = new Email('default');
                    $email2->setTo($emailagentenue)
                        ->setSubject('Ticket Cerrado')
                        ->setEmailFormat('html')
                        ->setTemplate('reasignaage')
                        ->setViewVars([
                            'servicio' => $servicio,
                            'username' => $nombreagentenue,
                            'noticket' => $servicio->servicio_id,
                            'LinkTicket' => $LinkTicket

                        ]);

                    try {
                        $email2->send();
                        $this->Flash->success('El correo de cerrar se envió correctamente.');
                    } catch (Exception $e) {
                        $this->Flash->error('Error al enviar el correo de notificación: ' . $e->getMessage());
                    }
                }

                if ($this->Servicios->save($servicio2)) {
                    $this->Flash->success(__('El Servicio fué actualizado con éxito.'));

                    return $this->redirect(['action' => 'view/' . $id]);
                }
                $this->Flash->error(__('El Servicio NO fué actualizado. Por favor, intente otra vez.'));
            }
        }

        /*$agentes = $this->Servicios->CoUsers->find('list', array(
            'contain' => array('CoGroups'),
            'conditions' => array(
                'CoGroups.tipo IN' => array(1, 2, 3)
            ),
            'order' => array('CoUsers.nombre' => 'ASC')
        ))->toArray();*/
        $agentes = $this->Servicios->CoUsers->find('list', array(
            'fields' => array('co_user_id', 'nombre'),
            'conditions' => array('co_group_id' => $servicio->co_group_id),
            'order' => array('nombre' => 'ASC')
        ))->toArray();


        $status = $this->Servicios->Status->find('list', ['limit' => 200]);
        $prioridades = $this->Servicios->Prioridades->find('list', ['limit' => 200]);
        $tipoIncidencias = $this->Servicios->TipoIncidencias->find('list', ['limit' => 200]);
        $coGroups = $this->Servicios->CoGroups->find('list', array(
            'conditions' => array(
                'tipo IN' => array(1, 2, 3)
            ),
            'order' => array('name' => 'ASC')
        ));
        $dependencias = $this->Servicios->Dependencias->find('list', ['limit' => 200]);
        $direcciones = $this->Servicios->Direcciones->find('list', ['limit' => 200]);
        $solicitantes = $this->Servicios->Solicitantes->find('list', ['limit' => 200]);
        //$grupos = $this->Servicios->Grupos->find('list', ['limit' => 200]);

        $this->loadModel('CoGroups');
        $grupos3 = $this->CoGroups->find('all', ['conditions' => ['co_group_id' => $servicio->co_group_id]]);
        foreach ($grupos3 as $grupo3) {
            $tipo2 = $grupo3->tipo;
            $padre2 = $grupo3->supervisor_padre;
        }

        if ($tipo2 == 3) {
            $grupos = $this->Servicios->Grupos->find('list', array(
                'conditions' => array('co_group_id' => $padre2),
                'order' => array('descripcion' => 'ASC')
            ));
        } else {
            $grupos = $this->Servicios->Grupos->find('list', array(
                'conditions' => array('co_group_id' => $servicio->co_group_id),
                'order' => array('descripcion' => 'ASC')
            ));
        }

        $this->set(compact('servicio', 'comentarios', 'adjuntos', 'user', 'agentes', 'status', 'prioridades', 'tipoIncidencias', 'coGroups', 'dependencias', 'direcciones', 'solicitantes', 'grupos', 'tipo'));
    }

    public function fusionar($id = null)
    {

        $servicio = $this->Servicios->get($id, [
            'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $recibido = $this->request->getData();
            $servicioB = $recibido['servicio'];



            $data = [
                'servicio_id' => $id,
                'texto' => "Se fusiona Servicio #" . $servicioB,
                'co_user_id' => 1,
                'tipo' => 1,
                'usuario_notificar' => 1,
            ];
            $comentarios = TableRegistry::get('comentarios');
            $entidades = $comentarios->newEntity($data);
            if ($result = $comentarios->save($entidades)) {
            }

            $this->loadModel('Comentarios');
            $query = $this->Comentarios->query();
            $query->update()
                ->set(['servicio_id' => $id])
                ->where(['servicio_id' => $servicioB])
                ->execute();

            $this->loadModel('Adjuntos');
            $query2 = $this->Adjuntos->query();
            $query2->update()
                ->set(['servicio_id' => $id])
                ->where(['servicio_id' => $servicioB])
                ->execute();

            $this->moverContenidoCarpeta('upload/archivos/' . $servicioB, 'upload/archivos/' . $id);


            $this->Flash->success(__('Se Fusionaron los Servicios con éxito.'));
            return $this->redirect(['action' => 'view/' . $id]);
        }


        $this->set(compact('servicio'));
    }

    function moverContenidoCarpeta($origen, $destino)
    {
        // Verificar si la carpeta de origen existe
        if (!file_exists($origen)) {
            $this->Flash->error(__('La carpeta de Origen No existe.'));
        }

        // Verificar si la carpeta de destino existe
        if (!file_exists($destino)) {
            mkdir($destino, 0777, true);
        }

        // Mover el contenido de la carpeta de origen a la carpeta de destino
        $contenido = scandir($origen);
        foreach ($contenido as $archivo) {
            if ($archivo != "." && $archivo != "..") {
                $rutaOrigen = $origen . "/" . $archivo;
                $rutaDestino = $destino . "/" . $archivo;
                if (is_file($rutaOrigen)) {
                    rename($rutaOrigen, $rutaDestino);
                }
            }
        }

        // Eliminar la carpeta de origen
        //rmdir($origen);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //Para evitar Cache
        $this->response->header('Cache-Control', 'no-cache');

        //VALIDAR EL PESO DE LOS ARCHIVOS
        if ($_SERVER['CONTENT_LENGTH'] > 30 * 1024 * 1024) { // 30 MB
            $this->Flash->error('El archivo excede el límite de tamaño permitido (30 MB).');
            return $this->redirect(['action' => 'add']);
        }

        $user = $this->Auth->User('co_user_id');
        $grupo = $this->Auth->User('co_group_id');
        $dependencia = $this->Auth->User('dependencia_id');
        $direccion = $this->Auth->User('direccione_id');
        $nombreuser = $this->Auth->User('nombre');
        $emailuser = $this->Auth->User('email');

        $this->loadModel('CoGroups');
        $grupos2 = $this->CoGroups->find('all', ['conditions' => ['co_group_id' => $grupo]]);
        foreach ($grupos2 as $grupo2) {
            $tipo = $grupo2->tipo;
        }

        $servicio = $this->Servicios->newEntity();
        if ($this->request->is('post')) {

            $arrRecibido = $this->request->getData();
            if ($arrRecibido['usuarios'] != '') {
                $arrRecibido['co_user_id'] = $arrRecibido['usuarios'];

                $depdir = $this->Servicios->CoUsers->find('all', array(
                    'conditions' => array(
                        'co_user_id' => $arrRecibido['usuarios']
                    )
                ))->toArray();
                $arrRecibido['dependencia_id'] = $depdir[0]['dependencia_id'];
                $arrRecibido['direccione_id'] = $depdir[0]['direccione_id'];
            }
            //$arrRecibido['estado'] = 1;


            $agente = $arrRecibido['agente'];
            $agentes = $this->Servicios->CoUsers->find('all', array(
                'conditions' => array(
                    'co_user_id' => $agente
                )
            ));

            foreach ($agentes as $agente1):
                $emailagente = $agente1['email'];
                $nombreagente = $agente1['nombre'];
            endforeach;




            $servicio = $this->Servicios->patchEntity($servicio, $arrRecibido);


            //dd($arrRecibido);
            // Filtrado del asunto
            $asunto = $this->request->getData('asunto');
            //Listado de Palabras a Bloquear
            $palabrasProhibidas = ['spam', 'phishing', 'virus', 'test', 'prueba', '', 'sql', 'trojan', 'hack', 'malware', 'ataque'];
            if (in_array(strtolower($asunto), $palabrasProhibidas)) {
                $this->Flash->error('Asunto no válido.');
                return $this->redirect(['action' => 'add']);
            }

            if ($result = $this->Servicios->save($servicio)) {
                //---------------
                // Verificamos si se seleccionaron archivos
                //if (isset($_FILES['archivos']) && !empty($_FILES['archivos']['name'][0])) {
                $entro = 0;
                if (!empty($this->request->data['archivos'][0]['name'])) {
                    $entro = 1;
                    if (!is_dir('upload/archivos/' . $result->servicio_id)) {
                        mkdir('upload/archivos/' . $result->servicio_id, 0777, true);
                    }

                    $archivosSubidos = $this->request->data['archivos'];
                    $numArchivos = count($archivosSubidos) - 1;

                    $archivosGuardados = [];

                    $cont = 0;
                    // Iteramos sobre los archivos subidos
                    for ($i = 0; $i < $numArchivos; $i++) {
                        $nombreArchivo = $archivosSubidos[$i]['name'];
                        $tmpArchivo = $archivosSubidos[$i]['tmp_name'];
                        $errorArchivo = $archivosSubidos[$i]['error'];

                        //armamos los datos de los archivos para la DB
                        $data[$cont] = [
                            'servicio_id' => $result->servicio_id,
                            'comentario_id' => 0,
                            'descripcion' => 0,
                            'archivo' => $nombreArchivo
                        ];

                        $cont++;


                        if ($errorArchivo === 0) {
                            $rutaDestino = 'upload/archivos/' . $result->servicio_id . '/' . basename($nombreArchivo);

                            // Movemos el archivo al directorio de destino
                            if (move_uploaded_file($tmpArchivo, $rutaDestino)) {
                                $archivosGuardados[] = $rutaDestino;
                            } else {
                                echo "Error al mover el archivo $nombreArchivo.<br>";
                            }
                        } else {
                            echo "Error al subir el archivo $nombreArchivo. Código de error: $errorArchivo.<br>";
                        }
                    }

                    // Si se subieron archivos con éxito
                    if (!empty($archivosGuardados)) {
                        echo "Los siguientes archivos se subieron con éxito:<br>";
                        foreach ($archivosGuardados as $archivo) {
                            echo "<a href='$archivo' target='_blank'>$archivo</a><br>";
                        }
                    }
                }

                $adjuntos = TableRegistry::get('adjuntos');

                if ($entro == 1) {
                    $entidades = $adjuntos->newEntities($data);
                    if ($result3 = $adjuntos->saveMany($entidades)) {
                        //$this->Flash->success(__('The servicio has been saved.'));
                        //return $this->redirect(['action' => 'index']);
                    };
                }

                $LinkTicket = RUTA_PRINCIPAL . 'servicios/view/' . $result->servicio_id;

                //Envio de Correo de Notificacion
                $email = new Email('default');
                $email->setTo($emailuser)
                    ->setSubject('Nueva Incidencia Registrada')
                    ->setEmailFormat('html')
                    ->setTemplate('newticket')
                    ->setViewVars([
                        'servicio' => $servicio,
                        'username' => $nombreuser,
                        'noticket' => $servicio->servicio_id,
                        'LinkTicket' => $LinkTicket

                    ]);

                //Envio de Correo de Notificacion
                $email2 = new Email('default');
                $email2->setTo($emailagente)
                    ->setSubject('Nueva Incidencia Registrada')
                    ->setEmailFormat('html')
                    ->setTemplate('newticketage')
                    ->setViewVars([
                        'servicio' => $servicio,
                        'username' => $nombreagente,
                        'noticket' => $servicio->servicio_id,
                        'LinkTicket' => $LinkTicket

                    ]);
                try {
                    $email->send();
                    $email2->send();
                    $this->Flash->success('El correo de notificación se envió correctamente.');
                } catch (Exception $e) {
                    $this->Flash->error('Error al enviar el correo de notificación: ' . $e->getMessage());
                }

                $this->Flash->success(__('El Servicio fué guardado con éxito.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El Servicio NO fué guardado. Por favor, intente otra vez.'));
        }
        $status = $this->Servicios->Status->find('list', ['limit' => 200]);
        $prioridades = $this->Servicios->Prioridades->find('list', ['limit' => 200]);
        $tipoIncidencias = $this->Servicios->TipoIncidencias->find('list', ['limit' => 200]);
        if ($tipo == 4) {
            $coGroups = $this->Servicios->CoGroups->find('list', array(
                'conditions' => array(
                    'tipo IN' => array(2)
                ),
                'order' => array('name' => 'ASC')
            ));
        } else {
            $coGroups = $this->Servicios->CoGroups->find('list', array(
                'conditions' => array(
                    'tipo IN' => array(1, 2, 3)
                ),
                'order' => array('name' => 'ASC')
            ));
        }

        $dependencias = $this->Servicios->Dependencias->find('list', ['limit' => 200]);
        $direcciones = $this->Servicios->Direcciones->find('list', ['limit' => 200]);
        $solicitantes = $this->Servicios->Solicitantes->find('list', ['limit' => 200]);
        $grupos = $this->Servicios->Grupos->find('list', ['limit' => 200]);
        $coUsers = $this->Servicios->CoUsers->find('list', ['limit' => 200]);

        $usuarios = $this->Servicios->CoUsers->find('list', array(
            'contain' => array('CoGroups'),
            'conditions' => array(
                'CoGroups.tipo IN' => array(4)
            ),
            'order' => array('CoUsers.nombre' => 'ASC')
        ));

        /*
        $schools->where([
    'A IN' => $arrayOfAOptions,
    'B IN' => $arrayOfBOptions,
    'C IN' => $arrayOfCOptions,
        'OR' => [
        'D IN' => $arrayOfDOptions,
        'E IN' => $arrayOfEOptions
    ]*/
        /*$agentes = $this->Servicios->CoUsers->find('list', array(
            'contain' => array('CoGroups'),
            'conditions' => array(
                'CoGroups.tipo IN' => array(2, 3)
            ),
            'order' => array('CoUsers.nombre' => 'ASC')
        ));*/

        $user = $this->Auth->User('co_user_id');
        $this->set(compact('servicio', 'status', 'prioridades', 'tipoIncidencias', 'coGroups', 'dependencias', 'direcciones', 'solicitantes', 'grupos', 'coUsers', 'user', 'tipo', 'dependencia', 'direccion', 'usuarios'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Servicio id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $servicio = $this->Servicios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $servicio = $this->Servicios->patchEntity($servicio, $this->request->getData());
            if ($this->Servicios->save($servicio)) {
                $this->Flash->success(__('El Servicio fué actualizado con éxito.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El Servicio NO fué guardado. Por favor, intente otra vez.'));
        }
        $status = $this->Servicios->Status->find('list', ['limit' => 200]);
        $prioridades = $this->Servicios->Prioridades->find('list', ['limit' => 200]);
        $tipoIncidencias = $this->Servicios->TipoIncidencias->find('list', ['limit' => 200]);
        $coGroups = $this->Servicios->CoGroups->find('list', ['limit' => 200]);
        $dependencias = $this->Servicios->Dependencias->find('list', ['limit' => 200]);
        $direcciones = $this->Servicios->Direcciones->find('list', ['limit' => 200]);
        $solicitantes = $this->Servicios->Solicitantes->find('list', ['limit' => 200]);
        $grupos = $this->Servicios->Grupos->find('list', ['limit' => 200]);
        $coUsers = $this->Servicios->CoUsers->find('list', ['limit' => 200]);

        $agentes = $this->Servicios->CoUsers->find('list', array(
            'contain' => array('CoGroups'),
            'conditions' => array(
                'CoGroups.tipo IN' => array(2, 3)
            ),
            'order' => array('CoUsers.nombre' => 'ASC')
        ));

        $usuarios = $this->Servicios->CoUsers->find('list', array(
            'contain' => array('CoGroups'),
            'conditions' => array(
                'CoGroups.tipo IN' => array(4)
            ),
            'order' => array('CoUsers.nombre' => 'ASC')
        ));

        $this->set(compact('servicio', 'status', 'prioridades', 'tipoIncidencias', 'coGroups', 'dependencias', 'direcciones', 'solicitantes', 'grupos', 'coUsers', 'agentes', 'usuarios'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Servicio id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $servicio = $this->Servicios->get($id);
        if ($this->Servicios->delete($servicio)) {
            $this->Flash->success(__('The servicio has been deleted.'));
        } else {
            $this->Flash->error(__('The servicio could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getFiltro()
    {
        $session = $this->request->session(); //Manejo de sesiones en la version 3
        $argumentos = null;
        $conditions = [];
        if ($session->check('argumentos' . $this->name)) {
            $argumentos = $session->read('argumentos' . $this->name);
            $this->request->data = $argumentos;    //Para los datos en el view
            if (!empty($argumentos['asunto'])) {
                $conditions['Servicios.asunto like'] = '%' . $argumentos['asunto'] . '%';
            }
            if (!empty($argumentos['descripcion'])) {
                $conditions['Servicios.descripcion like'] = '%' . $argumentos['descripcion'] . '%';
            }
            /*if(!empty($argumentos['cat_adscripcione_id'])){
               $conditions['Servicios.cat_adscripcione_id']=$argumentos['cat_adscripcione_id'];
           }*/
            if (!empty($argumentos['statu_id'])) {
                $conditions['Servicios.statu_id IN'] = $argumentos['statu_id'];
            }
            if (!empty($argumentos['tipo_incidencia_id'])) {
                $conditions['Servicios.tipo_incidencia_id'] = $argumentos['tipo_incidencia_id'];
            }
            if (!empty($argumentos['folio'])) {
                $conditions['Servicios.servicio_id like'] = $argumentos['folio'] . '%';
            }
            if (!empty($argumentos['grupo_id'])) {
                $conditions['Servicios.grupo_id IN'] = $argumentos['grupo_id'];
            }
            if (!empty($argumentos['co_group_id'])) {
                $conditions['Servicios.co_group_id'] = $argumentos['co_group_id'];
            }
            if (!empty($argumentos['agente'])) {
                $conditions['Servicios.agente'] = $argumentos['agente'];
            }
            if (!empty($argumentos['usuario'])) {
                $conditions['Servicios.co_user_id'] = $argumentos['usuario'];
            }
            if (!empty($argumentos['referencia'])) {
                $conditions['Servicios.referencia like'] = $argumentos['referencia'] . '%';
            }
        }

        $this->set(compact('argumentos'));
        return $conditions;
    }

    public function buscar($borrarFiltro = 0)
    {
        $session = $this->request->session(); //Manejo de sesiones en la version 3
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $url = [];
                $url['action'] = (isset($this->request->data['destino'])) ? $this->request->data['destino'] : 'index';
                foreach ($this->request->data as $k => $v) {
                    $url[$k] = $v;
                }
                $argumentos = $url;

                $session->write('argumentos' . $this->name, $argumentos);
                $this->redirect($url, null, true);
            }
        }
        if ($borrarFiltro == 1) //Borrado del filtro de busqueda
        {
            $session->delete('argumentos' . $this->name);
            if ($this->referer() != '/') {
                $this->redirect($this->referer());
            } else {
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function serviciosExcel()
    {

        $conditions = $this->getFiltro(); //Filtro de la consulta

        $user = $this->Auth->User('co_user_id');
        $grupo = $this->Auth->User('co_group_id');

        $this->loadModel('CoGroups');
        $grupos2 = $this->CoGroups->find('all', ['conditions' => ['co_group_id' => $grupo]]);
        foreach ($grupos2 as $grupo2) {
            $tipo = $grupo2->tipo;
        }



        $this->viewBuilder()->layout('excel'); //Establecemos el Layout aqui
        //$query = $this->Servicios->find("all",['contain'=>['TipoServicios','CatAdscripciones','CoUsers','Status']]);

        if ($tipo == 1) {
            $query = $this->Servicios->find("all", [
                'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers'],
                'order' => ['servicio_id DESC'],
                'conditions' => $conditions
            ]);
            //$servicios = $this->paginate($this->Servicios);
        } elseif ($tipo == 2) {
            $grupoB[] = $grupo;
            $grupos3 = $this->CoGroups->find('all', ['conditions' => ['supervisor_padre' => $grupo]])->toArray();
            foreach ($grupos3 as $grupo3) {
                $grupoB[] = $grupo3->co_group_id;
            }
            $conditions['Servicios.co_group_id IN'] = $grupoB;
            $query = $this->Servicios->find("all", [
                'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers'],
                'order' => ['servicio_id DESC'],
                'conditions' => $conditions

            ]);
            //$servicios = $this->paginate($this->Servicios);
        } elseif ($tipo == 3) {
            $conditions['Servicios.co_group_id'] = $grupo;
            $query = $this->Servicios->find("all", [
                'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers'],
                'order' => ['servicio_id DESC'],
                'conditions' => $conditions

            ]);
            //$servicios = $this->paginate($this->Servicios);
        } elseif ($tipo == 4) {
            $conditions['Servicios.co_user_id'] = $user;
            $query = $this->Servicios->find("all", [
                'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers'],
                'order' => ['servicio_id DESC'],
                'conditions' => $conditions
            ]);
            //$servicios = $this->paginate($this->Servicios);
        }

        $servicios = $query->all();
        $agentes = $this->Servicios->CoUsers->find('list', array(
            'contain' => array('CoGroups'),
            'conditions' => array(
                'CoGroups.tipo IN' => array(1, 2, 3)
            ),
            'order' => array('CoUsers.nombre' => 'ASC')
        ))->toArray();


        $this->set(compact('servicios', 'agentes'));
    }

    public function ajaxproceso()
    {

        $this->request->allowMethod('ajax');

        $institucion = $this->request->query('institucion');

        $this->loadModel('CoGroups');
        $grupos2 = $this->CoGroups->find('all', ['conditions' => ['co_group_id' => $institucion]]);
        $tipo = 0;
        foreach ($grupos2 as $grupo2) {
            $tipo = $grupo2->tipo;
            $padre = $grupo2->supervisor_padre;
        }

        $query = $this->Servicios->CoUsers->find('all', array(
            'fields' => array('co_user_id', 'nombre'),
            'conditions' => array('co_group_id' => $institucion),
            'order' => array('nombre' => 'ASC')
        ));

        if ($tipo == 3) {
            $query2 = $this->Servicios->Grupos->find('all', array(
                'fields' => array('grupo_id', 'descripcion'),
                'conditions' => array('co_group_id' => $padre),
                'order' => array('descripcion' => 'ASC')
            ));
        } else {
            $query2 = $this->Servicios->Grupos->find('all', array(
                'fields' => array('grupo_id', 'descripcion'),
                'conditions' => array('co_group_id' => $institucion),
                'order' => array('descripcion' => 'ASC')
            ));
        }




        $this->set('agente', $query);
        $this->set('_serialize', ['agente']);
        $this->set('grupo', $query2);
        $this->set('_serialize', ['grupo']);
        $this->set('coGroup', $institucion);
        $this->set('_serialize', ['coGroup']);
    }
    public function ajaxproceso2()
    {


        $this->request->allowMethod('ajax');

        $institucion = $this->request->query('institucion');

        $this->loadModel('CoGroups');
        $grupos2 = $this->CoGroups->find('all', ['conditions' => ['co_group_id' => $institucion]]);
        $tipo = 0;
        foreach ($grupos2 as $grupo2) {
            $tipo = $grupo2->tipo;
            $padre = $grupo2->supervisor_padre;
        }

        $query = $this->Servicios->CoUsers->find('all', array(
            'fields' => array('co_user_id', 'nombre'),
            'conditions' => array('co_group_id' => $institucion),
            'order' => array('nombre' => 'ASC')
        ));

        if ($tipo == 3) {
            $query2 = $this->Servicios->Grupos->find('all', array(
                'fields' => array('grupo_id', 'descripcion'),
                'conditions' => array('co_group_id' => $padre),
                'order' => array('descripcion' => 'ASC')
            ));
        } else {
            $query2 = $this->Servicios->Grupos->find('all', array(
                'fields' => array('grupo_id', 'descripcion'),
                'conditions' => array('co_group_id' => $institucion),
                'order' => array('descripcion' => 'ASC')
            ));
        }



        $this->set('agente', $query);
        $this->set('_serialize', ['agente']);
        $this->set('grupo', $query2);
        $this->set('_serialize', ['grupo']);
        $this->set('coGroup', $institucion);
        $this->set('_serialize', ['coGroup']);
    }

    public function ajaxproceso3()
    {


        $this->request->allowMethod('ajax');

        $institucion = $this->request->query('institucion');

        $this->loadModel('CoGroups');
        $grupos2 = $this->CoGroups->find('all', ['conditions' => ['co_group_id' => $institucion]]);
        $tipo = 0;
        foreach ($grupos2 as $grupo2) {
            $tipo = $grupo2->tipo;
            $padre = $grupo2->supervisor_padre;
        }

        $query = $this->Servicios->CoUsers->find('all', array(
            'fields' => array('co_user_id', 'nombre'),
            'conditions' => array('co_group_id' => $institucion, 'super' => 1),
            'order' => array('nombre' => 'ASC')
        ));

        if ($tipo == 3) {
            $query2 = $this->Servicios->Grupos->find('all', array(
                'fields' => array('grupo_id', 'descripcion'),
                'conditions' => array('co_group_id' => $padre),
                'order' => array('descripcion' => 'ASC')
            ));
        } else {
            $query2 = $this->Servicios->Grupos->find('all', array(
                'fields' => array('grupo_id', 'descripcion'),
                'conditions' => array('co_group_id' => $institucion),
                'order' => array('descripcion' => 'ASC')
            ));
        }




        $this->set('agente', $query);
        $this->set('_serialize', ['agente']);
        $this->set('grupo', $query2);
        $this->set('_serialize', ['grupo']);
        $this->set('coGroup', $institucion);
        $this->set('_serialize', ['coGroup']);
    }

    public function refrescar()
    {
        $this->request->allowMethod('ajax');

        $conditions = $this->getFiltro(); //Filtro de la consulta

        $user = $this->Auth->User('co_user_id');
        $grupo = $this->Auth->User('co_group_id');

        $this->loadModel('CoGroups');
        $grupos2 = $this->CoGroups->find('all', ['conditions' => ['co_group_id' => $grupo]]);
        foreach ($grupos2 as $grupo2) {
            $tipo = $grupo2->tipo;
        }

        $conditions['Servicios.estado'] = 0;
        if ($tipo == 1) {
            $this->paginate = [
                'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers'],
                'order' => ['servicio_id DESC'],
                'conditions' => $conditions
            ];
            $servicios = $this->paginate($this->Servicios);
        } elseif ($tipo == 2) {
            $grupoB[] = $grupo;
            $grupos3 = $this->CoGroups->find('all', ['conditions' => ['supervisor_padre' => $grupo]])->toArray();
            foreach ($grupos3 as $grupo3) {
                $grupoB[] = $grupo3->co_group_id;
            }
            $conditions['Servicios.co_group_id IN'] = $grupoB;
            $this->paginate = [
                'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers'],
                'order' => ['servicio_id DESC'],
                'conditions' => $conditions

            ];
            $servicios = $this->paginate($this->Servicios);
        } elseif ($tipo == 3) {
            $conditions['Servicios.co_group_id'] = $grupo;
            $this->paginate = [
                'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers'],
                'order' => ['servicio_id DESC'],
                'conditions' => $conditions

            ];
            $servicios = $this->paginate($this->Servicios);
        } elseif ($tipo == 4) {
            $conditions['Servicios.co_user_id'] = $user;
            $this->paginate = [
                'contain' => ['Status', 'Prioridades', 'TipoIncidencias', 'CoGroups', 'Dependencias', 'Direcciones', 'Solicitantes', 'Grupos', 'CoUsers'],
                'order' => ['servicio_id DESC'],
                'conditions' => $conditions
            ];
            $servicios = $this->paginate($this->Servicios);
        }

        $coGroups = $this->Servicios->CoGroups->find('list', array(
            'conditions' => array(
                'tipo IN' => array(2, 3)
            ),
            'order' => array('name' => 'ASC')
        ));

        $agentes = $this->Servicios->CoUsers->find('list', array(
            'contain' => array('CoGroups'),
            'conditions' => array(
                'CoGroups.tipo IN' => array(2, 3)
            ),
            'order' => array('CoUsers.nombre' => 'ASC')
        ))->toArray();

        $status = $this->Servicios->Status->find('list');
        $tipoIncidencias = $this->Servicios->TipoIncidencias->find('list');
        $grupos = $this->Servicios->Grupos->find('list');


        $this->set(compact('servicios', 'agentes', 'status', 'tipoIncidencias', 'grupos', 'tipo', 'coGroups'));




        //$this->set('servicios', $servicios);
    }
}
