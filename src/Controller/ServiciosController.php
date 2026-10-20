<?php

namespace App\Controller;

use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use DateTime;

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

        // Obtener valores del formulario (POST o GET)
        $inicio = $this->request->getData('inicio') ?: $this->request->getQuery('inicio');
        $fin    = $this->request->getData('fin') ?: $this->request->getQuery('fin');

        // Si no se recibieron valores, usar los predeterminados
        if (empty($inicio) || empty($fin)) {
            $inicio = date('2025-01-01');
            $fin = date('Y-12-31');
        }

        // horas habiles
        $fechaHoraActual = new DateTime();
        $diasFestivos = ['2026-02-02', '2026-02-16', '2026-02-17', '2026-03-16', '2026-04-02', '2026-04-03', '2026-05-01', '2026-09-16', '2026-10-12', '2026-11-02', '2026-11-03', '2026-11-16', '2026-12-25'];
        $fecha72HorasAtras = $this->restarHorasHabiles($fechaHoraActual, 72, $diasFestivos); //2025-04-15 16:11:58

        $tablename = TableRegistry::get("Servicios");
        $conditions = array('modified <' => $fecha72HorasAtras, 'statu_id' => 5);
        $fields = array('statu_id' => 6);
        $tablename->updateAll($fields, $conditions);

        $conditions = $this->getFiltro(); //Filtro de la consulta
        if (empty($conditions)) {
            $conditions['Servicios.fecha_creacion >='] = $inicio;
            $conditions['Servicios.fecha_creacion <='] = $fin;
        }

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
                'CoGroups.tipo IN' => array(2, 3, 4)
            ),
            'order' => array('CoUsers.nombre' => 'ASC')
        ))->toArray();

        $status = $this->Servicios->Status->find('list')->toArray();
        $status = $status + [9999 => 'No Cerrado/No Resuelto'];
        $tipoIncidencias = $this->Servicios->TipoIncidencias->find('list');
        $grupos = $this->Servicios->Grupos->find('list');
        $prioridades = $this->Servicios->Prioridades->find('list');

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


        $this->set(compact('servicios', 'agentes', 'usuarios', 'status', 'tipoIncidencias', 'grupos', 'tipo', 'coGroups', 'inicio', 'fin', 'prioridades'));
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
            if (isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > 30 * 1024 * 1024) { // 30 MB
                $this->Flash->error('El archivo excede el límite de tamaño permitido (30 MB).');
                return $this->redirect(['action' => 'view/' . $id]);
            }
            if (isset($_POST['Responder'])) {
                /*
                 * MODIFICACIÓN: reglas para responder tickets cerrados (statu_id = 6).
                 * - El usuario solicitante (tipo 4) no puede enviar mensajes.
                 * - El agente (tipo 3) solamente puede registrar una nota privada.
                 * Esta validación se realiza también en el controlador para impedir que
                 * la restricción de la vista pueda evadirse mediante una petición manual.
                 */
                if ((int)$servicio->statu_id === 6 && (int)$tipo === 4) {
                    $this->Flash->error(__('El ticket está cerrado y ya no permite enviar mensajes.'));
                    return $this->redirect(['action' => 'view/' . $id]);
                }

                // MODIFICACIÓN: los datos sensibles del comentario se establecen en el servidor.
                $datosComentario = $this->request->getData();
                $datosComentario['servicio_id'] = $servicio->servicio_id;
                $datosComentario['co_user_id'] = $user;
                $datosComentario['usuario_notificar'] = 1;
                $datosComentario['fecha_creacion'] = date('Y-m-d H:i:s');

                if ((int)$servicio->statu_id === 6 && (int)$tipo === 3) {
                    // MODIFICACIÓN: en un ticket cerrado, el agente sólo puede guardar nota privada.
                    $datosComentario['tipo'] = 2;
                }

                $comentario = $this->Comentarios->patchEntity($comentario, $datosComentario);
                $nuevosValores = array(
                    "servicio_id" => $servicio->servicio_id,
                    "fecha_creacion" => $datosComentario['fecha_creacion']
                );

                $actualizacion = $this->Servicios->get($servicio->servicio_id, [
                    'contain' => []
                ]);
                $actualizacion = $this->Servicios->patchEntity($actualizacion, $nuevosValores);

                /*$tamaniotexto = strlen($comentario->texto);
                if ($tamaniotexto > 2147000000) {
                    $this->Flash->error('No se guardó el servicio ya que las imagenes anexadas directamente en el texto sobrepasan el límite. Por favor Anexe sus Imagenes como adjuntos');
                } else { */

                try {

                    if ($result2 = $this->Comentarios->save($comentario)) {
                        if (!$this->Servicios->save($actualizacion)) {
                            $this->Flash->error(
                                __('El comentario fue guardado, pero no se pudo actualizar la fecha del servicio.')
                            );
                        }
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
                                    // Obtenemos la extensión del archivo
                                    $ext = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
                                    // Que Extensiones permitidas
                                    $allowExtensions = ['jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'xls', 'xlsx', 'pdf', 'csv'];
                                    //Validamos la extension del Archivo
                                    if (in_array($ext, $allowExtensions)) {
                                        $rutaDestino = 'upload/archivos/' . $id . '/' . basename($nombreArchivo);

                                        // Movemos el archivo al directorio de destino
                                        if (move_uploaded_file($tmpArchivo, $rutaDestino)) {
                                            $archivosGuardados[] = $rutaDestino;
                                        } else {
                                            echo "Error al mover el archivo $nombreArchivo.<br>";
                                        }
                                    } else {
                                        $this->Flash->error('Extensión de archivo no válida.');
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
                            if (!$adjuntos->saveMany($entidades)) {
                                $this->Flash->error(
                                    __('El comentario fue guardado, pero no se pudieron registrar todos los adjuntos.')
                                );
                            }
                        }

                        /*
                         * El comentario, la fecha del servicio y los adjuntos ya fueron
                         * procesados. El correo se intenta al final y dentro de un bloque
                         * aislado para que cualquier falla de destinatario, plantilla o
                         * transporte SMTP no afecte lo que ya se guardó.
                         */
                        try {
                            $LinkTicket = RUTA_PRINCIPAL . 'servicios/view/' . $id;
                            $email = null;

                            if ((int)$comentario->tipo === 1) {
                                // Comentario público: notificar a la contraparte.
                                $registradoPorUsuario = $this->Servicios->CoUsers->get($servicio->co_user_id);

                                if ((int)$comentario->co_user_id === (int)$registradoPorUsuario->co_user_id) {
                                    $agenteAsignado = $this->Servicios->CoUsers->get($servicio->agente);

                                    $email = new Email('default');
                                    $email->setTo($agenteAsignado->email)
                                        ->setSubject('Nuevo Comentario en la Incidencia')
                                        ->setEmailFormat('html')
                                        ->setTemplate('replyticket')
                                        ->setViewVars([
                                            'servicio' => $servicio,
                                            'username' => $agenteAsignado->nombre,
                                            'numeroServicio' => $servicio->servicio_id,
                                            'comentario' => $this->request->getData('texto'),
                                            'atendidoPor' => $nombreuser,
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
                                            'atendidoPor' => $nombreuser,
                                            'LinkTicket' => $LinkTicket
                                        ]);
                                }
                            } elseif ((int)$comentario->tipo === 2) {
                                // Nota privada: notificar únicamente al agente asignado.
                                $agenteAsignado = $this->Servicios->CoUsers->get($servicio->agente);

                                $email = new Email('default');
                                $email->setTo($agenteAsignado->email)
                                    ->setSubject('Nueva Nota Privada')
                                    ->setEmailFormat('html')
                                    ->setTemplate('replyticket')
                                    ->setViewVars([
                                        'servicio' => $servicio,
                                        'username' => $agenteAsignado->nombre,
                                        'numeroServicio' => $servicio->servicio_id,
                                        'comentario' => $this->request->getData('texto'),
                                        'atendidoPor' => $nombreuser,
                                        'LinkTicket' => $LinkTicket
                                    ]);
                            }

                            if ($email !== null) {
                                $email->send();
                                $this->Flash->success('El correo de notificación se envió correctamente.');
                            }
                        } catch (\Exception $e) {
                            $this->Flash->error(
                                'El comentario sí fue guardado, pero no se pudo enviar el correo de notificación: ' 
                            );
                        }


                        $this->Flash->success(__('El Comentario fué guardado con éxito.'));

                        return $this->redirect(['action' => 'view/' . $id]);
                    }
                    $this->Flash->error(__('El Comentario NO fué guardado. Por favor, intente otra vez.'));
                } catch (\Exception $e) {
                    $this->Flash->error('Error: las imagenes ingresadas en el area de texto exceden el limite permitido. favor de agregarlas como archivos adjuntos: ' . $e->getMessage());
                }

                //}
            } elseif (isset($_POST['GuardarE'])) {
                $servicio2 = $this->Servicios->patchEntity($servicio, $this->request->getData());
                $agentenuevo = $this->request->getData('agente');
                $estadonuevo = $this->request->getData('statu_id');

                /*
                 * Primero se construye la bitácora y se guarda el servicio.
                 * El envío de correos se realiza después para que una falla del
                 * servidor SMTP no impida actualizar el estado, agente u otros datos.
                 */
                $bitacora = "";
                if ($servicio2->dirty()) {
                    $bitacora .= $this->Auth->user()['login'] . "||{";
                    if ($servicio2->isDirty('statu_id')) {
                        $bitacora .= "estado:" . $servicio2->getOriginal('statu_id') . "|" . $servicio2->get('statu_id') . ",";
                    }
                    if ($servicio2->isDirty('prioridade_id')) {
                        $bitacora .= "prioridad:" . $servicio2->getOriginal('prioridade_id') . "|" . $servicio2->get('prioridade_id') . ",";
                    }
                    if ($servicio2->isDirty('tipo_incidencia_id')) {
                        $bitacora .= "tipo:" . $servicio2->getOriginal('tipo_incidencia_id') . "|" . $servicio2->get('tipo_incidencia_id') . ",";
                    }
                    if ($servicio2->isDirty('dependencia_id')) {
                        $bitacora .= "dependencia:" . $servicio2->getOriginal('dependencia_id') . "|" . $servicio2->get('dependencia_id') . ",";
                    }
                    if ($servicio2->isDirty('direccione_id')) {
                        $bitacora .= "dirección:" . $servicio2->getOriginal('direccione_id') . "|" . $servicio2->get('direccione_id') . ",";
                    }
                    if ($servicio2->isDirty('co_group_id')) {
                        $bitacora .= "grupo:" . $servicio2->getOriginal('co_group_id') . "|" . $servicio2->get('co_group_id') . ",";
                    }
                    if ($servicio2->isDirty('agente')) {
                        $bitacora .= "agente:" . $servicio2->getOriginal('agente') . "|" . $servicio2->get('agente') . ",";
                    }
                    if ($servicio2->isDirty('grupo_id')) {
                        $bitacora .= "modulo:" . $servicio2->getOriginal('grupo_id') . "|" . $servicio2->get('grupo_id') . ",";
                    }
                    if ($servicio2->isDirty('referencia')) {
                        $bitacora .= "referencia:" . $servicio2->getOriginal('referencia') . "|" . $servicio2->get('referencia') . ",";
                    }
                    $bitacora = rtrim($bitacora, ',') . "}";
                }

                if (!$this->Servicios->save($servicio2)) {
                    $this->Flash->error(__('El Servicio NO fué actualizado. Por favor, intente otra vez.'));
                } else {
                    // Guardar bitácora únicamente cuando existieron cambios.
                    if ($bitacora !== "") {
                        $data5 = [
                            'servicio_id' => $id,
                            'descripcion_evento' => $bitacora,
                        ];
                        $bitacoraservs = TableRegistry::get('bitacoraservs');
                        $entidadBitacora = $bitacoraservs->newEntity($data5);
                        if (!$bitacoraservs->save($entidadBitacora)) {
                            $this->Flash->error(__('El Servicio se actualizó, pero no se pudo guardar la bitácora.'));
                        }
                    }

                    $LinkTicket = RUTA_PRINCIPAL . 'servicios/view/' . $id;

                    // Notificar la reasignación después de guardar el servicio.
                    if ($agentenuevo != $agenteanterior) {
                        try {
                            $agenteNuevo = $this->Servicios->CoUsers->get($agentenuevo);

                            $email2 = new Email('default');
                            $email2->setTo($agenteNuevo->email)
                                ->setSubject('Nueva Asignación de Incidencia')
                                ->setEmailFormat('html')
                                ->setTemplate('reasignaage')
                                ->setViewVars([
                                    'servicio' => $servicio2,
                                    'username' => $agenteNuevo->nombre,
                                    'noticket' => $servicio2->servicio_id,
                                    'LinkTicket' => $LinkTicket
                                ]);

                            $email2->send();
                            $this->Flash->success('El correo de reasignación se envió correctamente.');
                        } catch (\Exception $e) {
                            $this->Flash->error(
                                'El Servicio sí se actualizó, pero no se pudo enviar el correo de reasignación '
                            );
                        }
                    }

                    // Notificar el cierre después de guardar el nuevo estado.
                    if ($estadonuevo != $estadoanterior && (int)$estadonuevo === 6) {
                        try {
                            $directorGeneral = $this->Servicios->CoUsers->get(14);

                            $email2 = new Email('default');
                            $email2->setTo($directorGeneral->email)
                                ->setSubject('Ticket Cerrado')
                                ->setEmailFormat('html')
                                ->setTemplate('closedticket')
                                ->setViewVars([
                                    'servicio' => $servicio2,
                                    'username' => $directorGeneral->nombre,
                                    'noticket' => $servicio2->servicio_id,
                                    'agente_cierra' => $this->Auth->user()['nombre'],
                                    'LinkTicket' => $LinkTicket
                                ]);

                            $email2->send();
                            $this->Flash->success('El correo de cierre se envió correctamente.');
                        } catch (\Exception $e) {
                            $this->Flash->error(
                                'El Servicio sí se actualizó, pero no se pudo enviar el correo de cierre: '
                            );
                        }
                    }

                    $this->Flash->success(__('El Servicio fué actualizado con éxito.'));
                    return $this->redirect(['action' => 'view/' . $id]);
                }
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
            'conditions' => array('co_group_id' => $servicio->co_group_id,'active'=>1),
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


        /*
         * BITÁCORA DEL SERVICIO
         * Sólo puede ser consultada por los usuarios autorizados.
         * Además, siempre se filtra por el servicio/ticket actual.
         */
        $loginActual = (string)$this->Auth->user()['login'];
        $usuariosBitacoraPermitidos = [
            'administrador.rodrigo',
            'francisco.albornoz',
            'admin.linda'
        ];

        $puedeVerBitacora = in_array($loginActual, $usuariosBitacoraPermitidos, true);
        $detalleBitacora = [];

        if ($puedeVerBitacora) {
            $bitacoraservs = TableRegistry::get('bitacoraservs');
            $bitacoras = $bitacoraservs->find()
                ->where(['servicio_id' => $id])
                ->order(['created' => 'DESC'])
                ->all();

            // Catálogos completos para poder resolver también valores históricos.
            $catalogosBitacora = [
                'estado' => $this->Servicios->Status->find('list')->toArray(),
                'prioridad' => $this->Servicios->Prioridades->find('list')->toArray(),
                'tipo' => $this->Servicios->TipoIncidencias->find('list')->toArray(),
                'dependencia' => $this->Servicios->Dependencias->find('list')->toArray(),
                'dirección' => $this->Servicios->Direcciones->find('list')->toArray(),
                'direccion' => $this->Servicios->Direcciones->find('list')->toArray(),
                'grupo' => $this->Servicios->CoGroups->find('list')->toArray(),
                'agente' => $this->Servicios->CoUsers->find('list', [
                    'keyField' => 'co_user_id',
                    'valueField' => 'nombre'
                ])->toArray(),
                'modulo' => $this->Servicios->Grupos->find('list')->toArray(),
            ];

            // Permite mostrar el nombre de la persona que hizo el cambio,
            // conservando también el login almacenado en la bitácora.
            $usuariosBitacora = $this->Servicios->CoUsers->find('list', [
                'keyField' => 'login',
                'valueField' => 'nombre'
            ])->toArray();

            $etiquetasBitacora = [
                'estado' => 'Estado',
                'prioridad' => 'Prioridad',
                'tipo' => 'Tipo',
                'dependencia' => 'Dependencia',
                'dirección' => 'Dirección',
                'direccion' => 'Dirección',
                'grupo' => 'Grupo',
                'agente' => 'Agente',
                'modulo' => 'Módulo',
                'referencia' => 'Ticket OperGob',
            ];

            $traducirValorBitacora = function ($campo, $valor) use ($catalogosBitacora) {
                $valor = trim((string)$valor);

                if ($valor === '') {
                    return 'Sin asignar';
                }

                // Referencia no es un catálogo: se guarda como texto.
                if ($campo === 'referencia') {
                    return $valor;
                }

                if (isset($catalogosBitacora[$campo][$valor])) {
                    return (string)$catalogosBitacora[$campo][$valor];
                }

                // Si el registro del catálogo ya no existe, evitamos mostrar sólo el ID.
                return 'No disponible';
            };

            foreach ($bitacoras as $eventoBitacora) {
                $descripcion = (string)$eventoBitacora->descripcion_evento;
                $partesDescripcion = explode('||', $descripcion, 2);

                $loginBitacora = trim($partesDescripcion[0] ?? ' ');
                $nombreBitacora = $usuariosBitacora[$loginBitacora] ?? $loginBitacora;

                if (!isset($partesDescripcion[1])) {
                    continue;
                }

                $contenidoCambios = trim($partesDescripcion[1]);
                $contenidoCambios = trim($contenidoCambios, "{} \t\n\r\0\x0B");

                if ($contenidoCambios === '') {
                    continue;
                }

                /*
                 * Se separa únicamente cuando la coma introduce otro campo conocido.
                 * Así una referencia que contenga una coma no rompe el historial.
                 */
                $cambios = preg_split(
                    '/,(?=(?:estado|prioridad|tipo|dependencia|dirección|direccion|grupo|agente|modulo|referencia):)/u',
                    $contenidoCambios
                );

                foreach ($cambios as $cambio) {
                    $partesCambio = explode(':', $cambio, 2);

                    if (count($partesCambio) !== 2) {
                        continue;
                    }

                    $campo = trim($partesCambio[0]);
                    $valores = explode('|', $partesCambio[1], 2);

                    if (count($valores) !== 2) {
                        continue;
                    }

                    $fechaBitacora = '';
                    if ($eventoBitacora->created instanceof \DateTimeInterface) {
                        $fechaBitacora = $eventoBitacora->created->format('d/m/Y H:i:s');
                    } elseif (!empty($eventoBitacora->created)) {
                        $timestampBitacora = strtotime((string)$eventoBitacora->created);
                        $fechaBitacora = $timestampBitacora
                            ? date('d/m/Y H:i:s', $timestampBitacora)
                            : (string)$eventoBitacora->created;
                    }

                    $detalleBitacora[] = [
                        'fecha' => $fechaBitacora,
                        'usuario' => $nombreBitacora !== '' ? $nombreBitacora : 'Usuario no disponible',
                        'login' => $loginBitacora,
                        'campo' => $etiquetasBitacora[$campo] ?? ucfirst($campo),
                        'anterior' => $traducirValorBitacora($campo, $valores[0]),
                        'nuevo' => $traducirValorBitacora($campo, $valores[1]),
                    ];
                }
            }
        }

        $this->set(compact('servicio', 'comentarios', 'adjuntos', 'user', 'agentes', 'status', 'prioridades', 'tipoIncidencias', 'coGroups', 'dependencias', 'direcciones', 'solicitantes', 'grupos', 'tipo', 'detalleBitacora', 'puedeVerBitacora'));
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
    public function add($grupoN = null, $moduloN = null)
    {
        //Para evitar Cache
        $this->response->header('Cache-Control', 'no-cache');

        //VALIDAR EL PESO DE LOS ARCHIVOS
        //if ($_SERVER['CONTENT_LENGTH'] > 30 * 1024 * 1024) { // 30 MB
        if (isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > 30 * 1024 * 1024) {
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
            if (!empty($arrRecibido['usuarios'])) {
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

            /*
             * Los datos del destinatario del agente no se consultan aquí.
             * Se obtendrán únicamente al final, cuando corresponda intentar
             * las notificaciones por correo.
             */
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

                            // Obtenemos la extensión del archivo
                            $ext = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
                            // Que Extensiones permitidas
                            $allowExtensions = ['jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'xls', 'xlsx', 'pdf', 'csv'];
                            //Validamos la extension del Archivo
                            if (in_array($ext, $allowExtensions)) {

                                $rutaDestino = 'upload/archivos/' . $result->servicio_id . '/' . basename($nombreArchivo);

                                // Movemos el archivo al directorio de destino
                                if (move_uploaded_file($tmpArchivo, $rutaDestino)) {
                                    $archivosGuardados[] = $rutaDestino;
                                } else {
                                    echo "Error al mover el archivo $nombreArchivo.<br>";
                                }
                            } else {
                                $this->Flash->error('Extensión de archivo no válida.');
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
                    if (!$adjuntos->saveMany($entidades)) {
                        $this->Flash->error(
                            __('El Servicio fue guardado, pero no se pudieron registrar todos los adjuntos.')
                        );
                    }
                }

                $LinkTicket = RUTA_PRINCIPAL . 'servicios/view/' . $result->servicio_id;

                /*
                 * MODIFICACIÓN: al crear el ticket se registra automáticamente un
                 * mensaje público para informar al solicitante que ya está siendo atendido.
                 * Se registra como comentario del agente asignado para que aparezca en
                 * la conversación del ticket y pueda generar su notificación por correo.
                 */
                $mensajeAutomatico = '<p>Estimado(a) usuario(a):</p>

<p>
    Le informamos que su ticket ha sido recibido correctamente y ha sido canalizado para su atención.
</p>

<p>
    Nuestro equipo revisará la información proporcionada y dará seguimiento a su solicitud a la brevedad posible. En caso de requerirse información adicional, nos pondremos en contacto con usted por este mismo medio.
</p>

<p>Agradecemos su paciencia y comprensión.</p>


';
                $this->loadModel('Comentarios');
                $comentarioAutomatico = $this->Comentarios->newEntity([
                    'servicio_id' => $result->servicio_id,
                    'texto' => $mensajeAutomatico,
                    'co_user_id' => 1,
                    'tipo' => 1, // Mensaje público; no es nota privada.
                    'usuario_notificar' => 1,
                    'fecha_creacion' => date('Y-m-d H:i:s')
                ]);

                /*
                 * Primero se guarda el mensaje automático. Su correo se enviará
                 * al final, después de concluir todas las operaciones de base de datos
                 * y archivos relacionadas con la creación del ticket.
                 */
                $comentarioAutomaticoGuardado = (bool)$this->Comentarios->save($comentarioAutomatico);

                if (!$comentarioAutomaticoGuardado) {
                    $this->Flash->error(
                        __('El ticket fue creado, pero no se pudo guardar el mensaje automático de atención.')
                    );
                }

                /*
                 * Todas las operaciones de persistencia ya concluyeron:
                 * servicio, archivos, registros de adjuntos y comentario automático.
                 * A partir de aquí sólo se intentan las notificaciones por correo.
                 * Cada envío es independiente para que la falla de uno no impida los demás.
                 */

                // 1. Correo correspondiente al mensaje automático.
                if ($comentarioAutomaticoGuardado) {
                    try {
                        $usuarioTicket = $this->Servicios->CoUsers->get($result->co_user_id);
                        $agenteAsignado = $this->Servicios->CoUsers->get($result->agente);

                        $emailMensajeAutomatico = new Email('default');
                        $emailMensajeAutomatico->setTo($usuarioTicket->email)
                            ->setSubject('Nuevo mensaje en su incidencia')
                            ->setEmailFormat('html')
                            ->setTemplate('replyticket')
                            ->setViewVars([
                                'servicio' => $result,
                                'username' => $usuarioTicket->nombre,
                                'numeroServicio' => $result->servicio_id,
                                'comentario' => $mensajeAutomatico,
                                'atendidoPor' => $agenteAsignado->nombre,
                                'LinkTicket' => $LinkTicket
                            ]);

                        $emailMensajeAutomatico->send();
                        $this->Flash->success('El correo del mensaje automático se envió correctamente.');
                    } catch (\Exception $e) {
                        $this->Flash->error(
                            'El ticket y el mensaje automático sí fueron guardados, pero no se pudo enviar su correo: ' 
                        );
                    }
                }

                // 2. Correo para el usuario que registró la incidencia.
                try {
                    $email = new Email('default');
                    $email->setTo($emailuser)
                        ->setSubject('Nueva Incidencia Registrada')
                        ->setEmailFormat('html')
                        ->setTemplate('newticket')
                        ->setViewVars([
                            'servicio' => $result,
                            'username' => $nombreuser,
                            'noticket' => $result->servicio_id,
                            'LinkTicket' => $LinkTicket
                        ]);

                    $email->send();
                    $this->Flash->success('El correo para el usuario se envió correctamente.');
                } catch (\Exception $e) {
                    $this->Flash->error(
                        'El Servicio sí fue guardado, pero no se pudo enviar el correo al usuario' 
                    );
                }

                // 3. Correo para el agente asignado.
                try {
                    $agenteAsignado = $this->Servicios->CoUsers->get($result->agente);

                    $email2 = new Email('default');
                    $email2->setTo($agenteAsignado->email)
                        ->setSubject('Nueva Incidencia Registrada')
                        ->setEmailFormat('html')
                        ->setTemplate('newticketage')
                        ->setViewVars([
                            'servicio' => $result,
                            'username' => $agenteAsignado->nombre,
                            'noticket' => $result->servicio_id,
                            'LinkTicket' => $LinkTicket
                        ]);

                    $email2->send();
                    $this->Flash->success('El correo para el agente se envió correctamente.');
                } catch (\Exception $e) {
                    $this->Flash->error(
                        'El Servicio sí fue guardado, pero no se pudo enviar el correo al agente: ' 
                    );
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
        if ($grupoN == null) {
            $grupos = $this->Servicios->Grupos->find('list', ['limit' => 200]);
        } else {
            $grupos = $this->Servicios->Grupos->find('list', array(
                'conditions' => array(
                    'co_group_id IN' => array($grupoN)
                ),
                'order' => array('descripcion' => 'ASC')
            ));
        }


        $coUsers = $this->Servicios->CoUsers->find('list', ['limit' => 200]);

        $usuarios = $this->Servicios->CoUsers->find('list', array(
            'contain' => array('CoGroups'),
            'conditions' => array(
                'CoGroups.tipo IN' => array(4)
            ),
            'order' => array('CoUsers.nombre' => 'ASC')
        ));


        $agenteX = 0;
        if ($grupoN != null) {
            $agenteArr = $this->Servicios->CoUsers->find('all', array(
                'fields' => array('co_user_id', 'nombre'),
                'conditions' => array('co_group_id' => $grupoN, 'super' => 1),
                'order' => array('nombre' => 'ASC')
            ));
            foreach ($agenteArr as $agenteX1)
                $agenteX = $agenteX1['co_user_id'];
        }

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
        $this->set(compact('servicio', 'status', 'prioridades', 'tipoIncidencias', 'coGroups', 'dependencias', 'direcciones', 'solicitantes', 'grupos', 'coUsers', 'user', 'tipo', 'dependencia', 'direccion', 'usuarios', 'grupoN', 'moduloN', 'agenteX'));
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

                $statuIds = $argumentos['statu_id'] ?? []; // aseguramos que sea arreglo

                if (in_array(9999, $statuIds)) {
                    // Si existe el 9999 en el arreglo, usar NOT IN
                    $conditions['Servicios.statu_id NOT IN'] = [5, 6];
                } else {
                    // Si no existe, usar IN con los valores originales
                    $conditions['Servicios.statu_id IN'] = $statuIds;
                }
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
             if (!empty($argumentos['prioridade_id'])) {
                $conditions['Servicios.prioridade_id IN'] = $argumentos['prioridade_id'];
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
            if (!empty($argumentos['inicio'])) {
                $conditions['Servicios.fecha_creacion >='] = $argumentos['inicio'];
            }
            if (!empty($argumentos['fin'])) {
                $conditions['Servicios.fecha_creacion <='] = $argumentos['fin'];
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

            // Reiniciar las fechas por defecto

            //    $inicio = date('Y-10-01');
            // $fin = date('Y-12-31');

            /*  if ($this->referer() != '/') {
                $this->redirect($this->referer());
            } else {
                $this->redirect(array('action' => 'index'));
            } */
            $this->redirect(array('action' => 'index'));
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

    function restarHorasHabiles($fechaHoraActual, $horasARestar, $diasFestivos = [])
    {
        // Convertimos a objeto DateTime
        //$fecha = new DateTime($fechaHoraActual);
        $fecha = $fechaHoraActual;

        // Convertimos el array de festivos a formato Y-m-d para comparación
        $festivos = array_map(function ($dia) {
            return (new DateTime($dia))->format('Y-m-d');
        }, $diasFestivos);

        $horasRestadas = 0;

        while ($horasRestadas < $horasARestar) {
            // Restamos 1 hora
            $fecha->modify('-1 hour');

            // Verificamos si el día es sábado (6), domingo (0) o festivo
            $diaSemana = (int)$fecha->format('w');
            $esFinDeSemana = ($diaSemana === 0 || $diaSemana === 6);
            $esFestivo = in_array($fecha->format('Y-m-d'), $festivos);

            if (!$esFinDeSemana && !$esFestivo) {
                $horasRestadas++;
            }
        }

        return $fecha->format('Y-m-d H:i:s');
    }

    public function index2()
    {
        //Para evitar Cache
        $this->response->header('Cache-Control', 'no-cache');

        // horas habiles
        $fechaHoraActual = new DateTime();
        $diasFestivos = ['2025-04-17', '2025-04-18', '2025-05-01', '2025-05-05', '2025-06-12', '2025-09-16', '2025-11-17'];
        $fecha72HorasAtras = $this->restarHorasHabiles($fechaHoraActual, 72, $diasFestivos); //2025-04-15 16:11:58

        $tablename = TableRegistry::get("Servicios");
        $conditions = array('modified <' => $fecha72HorasAtras, 'statu_id' => 5);
        $fields = array('statu_id' => 6);
        //$tablename->updateAll($fields, $conditions);

        $conditions = $this->getFiltro(); //Filtro de la consulta
        $conditions = array('fecha_creacion >=' => '2025-07-01');
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
                'CoGroups.tipo IN' => array(2, 4)
            ),
            'order' => array('CoUsers.nombre' => 'ASC')
        ))->toArray();

        $status = $this->Servicios->Status->find('list')->toArray();
        $status = $status + [9999 => 'No Cerrado/No Resuelto'];
        $tipoIncidencias = $this->Servicios->TipoIncidencias->find('list');
        $grupos = $this->Servicios->Grupos->find('list');




        $this->set(compact('servicios', 'agentes', 'usuarios', 'status', 'tipoIncidencias', 'grupos', 'tipo', 'coGroups'));
    }

    public function prev() {}

    public function procesarSolicitud()
    {
        $servicio = $this->request->getData('servicio');

        list($valor1, $valor2) = explode('|', $servicio);

        if ($valor1 != '') {
            return $this->redirect([
                'action' => 'add',
                $valor1,
                $valor2
            ]);
        } else {
            $this->Flash->error(__('Debe seleccionar una opción'));
            return $this->redirect([
                'action' => 'prev'
            ]);
            //$this->Flash->error(__('Debe seleccionar una opción'));
        }
    }
}