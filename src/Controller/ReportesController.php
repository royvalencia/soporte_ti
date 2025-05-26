<?php

namespace App\Controller;

use App\Controller\AppController;


/**
 * Servicios Controller
 *
 * @property \App\Model\Table\ServiciosTable $Servicios
 *
 * @method \App\Model\Entity\Servicio[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReportesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Servicios');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */


    public function index()
    {


        if ($this->request->is('post')) {

            $inicio = $this->request->data['data']['Seguimiento']['inicio'];
            $fin =   $this->request->data['data']['Seguimiento']['fin'];
        } else {
            $inicio = date('Y-m-01');
            $fin = date('Y-m-31');
        }


        /*$serviciosArea = $this->Servicios->find('all',
                                                ['contain'=>['CatAdscripciones'],
                                                'fields'=>['Servicios.cat_adscripcione_id','CatAdscripciones.nom_ads'],
                                                'conditions'=>['Servicios.fecha_solicitud >='=>$inicio,'Servicios.fecha_solicitud <='=>$fin],                                                
                                                'order'=>['count ASC'],   
                                                'group'=>['Servicios.cat_adscripcione_id']])->select(['Servicios.cat_adscripcione_id','count' => $this->Servicios->find()->func()->count('*')]);
                                                   */
        /*$serviciosUsuarios = $this->Servicios->find(
            'all',
            [
                'contain' => ['CoUsers', 'CoGroups'],
                'fields' => ['Servicios.co_user_id', 'CoUsers.nombre', 'CoUsers.co_user_id', 'CoGroups.co_group_id', 'CoGroups.tipo'],
                'conditions' => ['Servicios.fecha_creacion >=' => $inicio, 'Servicios.fecha_creacion <=' => $fin, 'CoGroups.tipo IN' => array(2)],
                'group' => ['Servicios.co_user_id']
            ]
        )->select([
            'Servicios.co_user_id',
            'count' => $this->Servicios->find()->func()->count('*')
        ])->order(['count' => 'ASC']);*/

        $serviciosTotal = $this->Servicios->find()
            ->select([
                'count' => $this->Servicios->find()->func()->count('*'),
                'finalizados' => $this->Servicios->find()->func()->count('CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END'),
                'abiertos' => $this->Servicios->find()->newExpr('COUNT(*) - COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END)'),
                'eficacia' => $this->Servicios->find()->newExpr('COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END) * 100 / COUNT(*)'),
            ])
            ->order(['eficacia' => 'DESC']);


        $serviciosModulos = $this->Servicios->find()
            ->select([

                'count' => $this->Servicios->find()->func()->count('*'),
                'finalizados' => $this->Servicios->find()->func()->count('CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END'),
                'abiertos' => $this->Servicios->find()->newExpr('COUNT(*) - COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END)'),
                'eficacia' => $this->Servicios->find()->newExpr('COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END) * 100 / COUNT(*)'),
                'Grupos.descripcion'
            ])
            ->join([
                'Grupos' => [
                    'table' => 'grupos',
                    'type' => 'INNER',
                    'conditions' => 'Servicios.grupo_id = Grupos.grupo_id'
                ]
            ])
            ->where([
                'Servicios.fecha_creacion >=' => $inicio,
                'Servicios.fecha_creacion <=' => $fin,
                'Servicios.grupo_id IN' => [1,2,3,4,5,6,7,8,9,34]
            ])
            ->group(['Servicios.grupo_id'])
            ->order([
                'eficacia' => 'DESC',
                'Servicios.grupo_id' => 'DESC'
            ]);



        $serviciosUsuariosDSI = $this->Servicios->find()
            ->select([
                'Servicios.agente',
                'count' => $this->Servicios->find()->func()->count('*'),
                'finalizados' => $this->Servicios->find()->func()->count('CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END'),
                'abiertos' => $this->Servicios->find()->newExpr('COUNT(*) - COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END)'),
                'eficacia' => $this->Servicios->find()->newExpr('COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END) * 100 / COUNT(*)'),
                'CoUsers.nombre'
            ])
            ->join([
                'CoUsers' => [
                    'table' => 'co_users',
                    'type' => 'INNER',
                    'conditions' => 'Servicios.agente = CoUsers.co_user_id'
                ]
            ])
            ->where([
                'Servicios.fecha_creacion >=' => $inicio,
                'Servicios.fecha_creacion <=' => $fin,
                'Servicios.co_group_id' => 4
            ])
            ->group(['Servicios.agente'])
            ->order([
                'eficacia' => 'DESC',
                'Servicios.agente' => 'DESC'
            ]);

        $serviciosUsuariosDTI = $this->Servicios->find()
            ->select([
                'Servicios.agente',
                'count' => $this->Servicios->find()->func()->count('*'),
                'finalizados' => $this->Servicios->find()->func()->count('CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END'),
                'abiertos' => $this->Servicios->find()->newExpr('COUNT(*) - COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END)'),
                'eficacia' => $this->Servicios->find()->newExpr('COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END) * 100 / COUNT(*)'),
                'CoUsers.nombre'
            ])
            ->join([
                'CoUsers' => [
                    'table' => 'co_users',
                    'type' => 'INNER',
                    'conditions' => 'Servicios.agente = CoUsers.co_user_id'
                ]
            ])
            ->where([
                'Servicios.fecha_creacion >=' => $inicio,
                'Servicios.fecha_creacion <=' => $fin,
                'Servicios.co_group_id' => 3
            ])
            ->group(['Servicios.agente'])
            ->order([
                'eficacia' => 'DESC',
                'Servicios.agente' => 'DESC'
            ]);

        $serviciosUsuariosDST = $this->Servicios->find()
            ->select([
                'Servicios.agente',
                'count' => $this->Servicios->find()->func()->count('*'),
                'finalizados' => $this->Servicios->find()->func()->count('CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END'),
                'abiertos' => $this->Servicios->find()->newExpr('COUNT(*) - COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END)'),
                'eficacia' => $this->Servicios->find()->newExpr('COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END) * 100 / COUNT(*)'),
                'CoUsers.nombre'
            ])
            ->join([
                'CoUsers' => [
                    'table' => 'co_users',
                    'type' => 'INNER',
                    'conditions' => 'Servicios.agente = CoUsers.co_user_id'
                ]
            ])
            ->where([
                'Servicios.fecha_creacion >=' => $inicio,
                'Servicios.fecha_creacion <=' => $fin,
                'Servicios.co_group_id' => 6
            ])
            ->group(['Servicios.agente'])
            ->order([
                'eficacia' => 'DESC',
                'Servicios.agente' => 'DESC'
            ]);





        $serviciosUsuariosADM = $this->Servicios->find()
            ->select([
                'Servicios.agente',
                'count' => $this->Servicios->find()->func()->count('*'),
                'finalizados' => $this->Servicios->find()->func()->count('CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END'),
                'abiertos' => $this->Servicios->find()->newExpr('COUNT(*) - COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END)'),
                'eficacia' => $this->Servicios->find()->newExpr('COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END) * 100 / COUNT(*)'),
                'CoUsers.nombre'
            ])
            ->join([
                'CoUsers' => [
                    'table' => 'co_users',
                    'type' => 'INNER',
                    'conditions' => 'Servicios.agente = CoUsers.co_user_id'
                ]
            ])
            ->where([
                'Servicios.fecha_creacion >=' => $inicio,
                'Servicios.fecha_creacion <=' => $fin,
                'Servicios.co_group_id' => 5
            ])
            ->group(['Servicios.agente'])
            ->order([
                'eficacia' => 'DESC',
                'Servicios.agente' => 'DESC'
            ]);





        $serviciosSinasignar = $this->Servicios->find()
            ->select([
                'Servicios.servicio_id',
                'Servicios.agente',
                'CoUsers.nombre',
                'Servicios.created'
            ])
            ->join([
                'CoUsers' => [
                    'table' => 'co_users',
                    'type' => 'INNER',
                    'conditions' => 'Servicios.agente = CoUsers.co_user_id'
                ]
            ])
            ->where([
                'Servicios.agente IN' => [4, 12, 243],
                'Servicios.statu_id' => 1
            ])
            ->order(['Servicios.created' => 'ASC'])
            ->limit(10);





        $serviciosSinatender = $this->Servicios->find()
            ->select([
                'Servicios.servicio_id',
                'Servicios.agente',
                'Servicios.co_group_id',
                'CoUsers.nombre',
                'Servicios.fecha_creacion'
            ])
            ->join([
                'CoUsers' => [
                    'table' => 'co_users',
                    'type' => 'INNER',
                    'conditions' => 'Servicios.agente = CoUsers.co_user_id'
                ]
            ])
            ->where([
                'Servicios.statu_id IN' => [1, 2, 3, 4, 7, 8]
            ])
            ->order(['Servicios.fecha_creacion' => 'ASC'])
            ->limit(10);


        //pr($serviciosUsuarios->toArray());

        /*$serviciosUsuarios = $this->Servicios->CoUsers->find('all', array(
            'contain' => array('CoGroups'),
            'conditions' => array(
                'CoGroups.tipo IN' => array(2, 3)
            ),
            'order' => array('CoUsers.nombre' => 'ASC'),
            'select' => array('Servicios.co_user_id','CoUsers.nombre', 'CoUsers.co_user_id', 'CoGroups.co_group_id', 'CoGroups.tipo',
            'count' => $this->Servicios->find()->func()->count('*')
        ),
        'group' => array('co_user_id'),
        ));*/



        /*$serviciosEstatus = $this->Servicios->find('all',
                                                ['contain'=>['Status'],
                                                'fields'=>['Servicios.statu_id','Status.descripcion'],
                                                'conditions'=>['Servicios.fecha_solicitud >='=>$inicio,'Servicios.fecha_solicitud <='=>$fin],
                                                'group'=>['Servicios.statu_id']])->select(['Servicios.statu_id',
                                                                                                        'count' => $this->Servicios->find()->func()->count('*')])->order(['count'=>'ASC']);  */




        /*$serviciosTipoGrupo = $this->Servicios->find('all',
                                                ['contain'=>['TipoServicios'=>['Grupos']],
                                                'fields'=>['Servicios.tipo_servicio_id','Grupos.descripcion','TipoServicios.descripcion','esfuerzo'=>'SUM(Servicios.esfuerzo)'],
                                                'conditions'=>['Servicios.fecha_solicitud >='=>$inicio,'Servicios.fecha_solicitud <='=>$fin],
                                                'group'=>['TipoServicios.grupo_id']])->select(['Servicios.tipo_servicio_id',
                                                                                                        'count' => $this->Servicios->find()->func()->count('*')])->order(['count'=>'ASC']);*/




        //pr($serviciosTipoGrupo);
        //exit;


        //$arrayServicioUsuario = $serviciosUsuarios->toArray();
        //pr($arrayServicioUsuario);
        //exit;





        $user = $this->Auth->User('co_user_id');
        $grupo = $this->Auth->User('co_group_id');



        $this->paginate = [
            'contain' => ['CoUsers', 'Status'],
            'order' => ['servicio_id DESC'],
            'conditions' => ['Servicios.co_user_id' => $user]
        ];
        $servicios = $this->paginate($this->Servicios);






        $this->set(compact('servicios', 'inicio', 'fin', 'serviciosUsuariosDSI', 'serviciosUsuariosDTI', 'serviciosUsuariosDST', 'serviciosUsuariosADM', 'serviciosSinasignar', 'serviciosSinatender', 'serviciosTotal', 'serviciosModulos'));
    }

    public function index2()
    {


        if ($this->request->is('post')) {

            $inicio = $this->request->data['data']['Seguimiento']['inicio'];
            $fin =   $this->request->data['data']['Seguimiento']['fin'];
        } else {
            $inicio = date('Y-m-01');
            $fin = date('Y-m-31');
        }


        /*$serviciosArea = $this->Servicios->find('all',
                                                ['contain'=>['CatAdscripciones'],
                                                'fields'=>['Servicios.cat_adscripcione_id','CatAdscripciones.nom_ads'],
                                                'conditions'=>['Servicios.fecha_solicitud >='=>$inicio,'Servicios.fecha_solicitud <='=>$fin],                                                
                                                'order'=>['count ASC'],   
                                                'group'=>['Servicios.cat_adscripcione_id']])->select(['Servicios.cat_adscripcione_id','count' => $this->Servicios->find()->func()->count('*')]);
                                                   */
        /*$serviciosUsuarios = $this->Servicios->find(
            'all',
            [
                'contain' => ['CoUsers', 'CoGroups'],
                'fields' => ['Servicios.co_user_id', 'CoUsers.nombre', 'CoUsers.co_user_id', 'CoGroups.co_group_id', 'CoGroups.tipo'],
                'conditions' => ['Servicios.fecha_creacion >=' => $inicio, 'Servicios.fecha_creacion <=' => $fin, 'CoGroups.tipo IN' => array(2)],
                'group' => ['Servicios.co_user_id']
            ]
        )->select([
            'Servicios.co_user_id',
            'count' => $this->Servicios->find()->func()->count('*')
        ])->order(['count' => 'ASC']);*/

        $serviciosTotal = $this->Servicios->find()
            ->select([
                'count' => $this->Servicios->find()->func()->count('*'),
                'finalizados' => $this->Servicios->find()->func()->count('CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END'),
                'abiertos' => $this->Servicios->find()->newExpr('COUNT(*) - COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END)'),
                'eficacia' => $this->Servicios->find()->newExpr('COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END) * 100 / COUNT(*)'),
            ])
            ->order(['eficacia' => 'DESC']);



        $serviciosUsuariosDSI = $this->Servicios->find()
            ->select([
                'Servicios.agente',
                'count' => $this->Servicios->find()->func()->count('*'),
                'finalizados' => $this->Servicios->find()->func()->count('CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END'),
                'abiertos' => $this->Servicios->find()->newExpr('COUNT(*) - COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END)'),
                'eficacia' => $this->Servicios->find()->newExpr('COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END) * 100 / COUNT(*)'),
                'CoUsers.nombre'
            ])
            ->join([
                'CoUsers' => [
                    'table' => 'co_users',
                    'type' => 'INNER',
                    'conditions' => 'Servicios.agente = CoUsers.co_user_id'
                ]
            ])
            ->where([
                'Servicios.fecha_creacion >=' => $inicio,
                'Servicios.fecha_creacion <=' => $fin,
                'Servicios.co_group_id' => 4
            ])
            ->group(['Servicios.agente'])
            ->order([
                'eficacia' => 'DESC',
                'Servicios.agente' => 'DESC'
            ]);

        $serviciosUsuariosDTI = $this->Servicios->find()
            ->select([
                'Servicios.agente',
                'count' => $this->Servicios->find()->func()->count('*'),
                'finalizados' => $this->Servicios->find()->func()->count('CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END'),
                'abiertos' => $this->Servicios->find()->newExpr('COUNT(*) - COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END)'),
                'eficacia' => $this->Servicios->find()->newExpr('COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END) * 100 / COUNT(*)'),
                'CoUsers.nombre'
            ])
            ->join([
                'CoUsers' => [
                    'table' => 'co_users',
                    'type' => 'INNER',
                    'conditions' => 'Servicios.agente = CoUsers.co_user_id'
                ]
            ])
            ->where([
                'Servicios.fecha_creacion >=' => $inicio,
                'Servicios.fecha_creacion <=' => $fin,
                'Servicios.co_group_id' => 3
            ])
            ->group(['Servicios.agente'])
            ->order([
                'eficacia' => 'DESC',
                'Servicios.agente' => 'DESC'
            ]);

        $serviciosUsuariosDST = $this->Servicios->find()
            ->select([
                'Servicios.agente',
                'count' => $this->Servicios->find()->func()->count('*'),
                'finalizados' => $this->Servicios->find()->func()->count('CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END'),
                'abiertos' => $this->Servicios->find()->newExpr('COUNT(*) - COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END)'),
                'eficacia' => $this->Servicios->find()->newExpr('COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END) * 100 / COUNT(*)'),
                'CoUsers.nombre'
            ])
            ->join([
                'CoUsers' => [
                    'table' => 'co_users',
                    'type' => 'INNER',
                    'conditions' => 'Servicios.agente = CoUsers.co_user_id'
                ]
            ])
            ->where([
                'Servicios.fecha_creacion >=' => $inicio,
                'Servicios.fecha_creacion <=' => $fin,
                'Servicios.co_group_id' => 6
            ])
            ->group(['Servicios.agente'])
            ->order([
                'eficacia' => 'DESC',
                'Servicios.agente' => 'DESC'
            ]);





        $serviciosUsuariosADM = $this->Servicios->find()
            ->select([
                'Servicios.agente',
                'count' => $this->Servicios->find()->func()->count('*'),
                'finalizados' => $this->Servicios->find()->func()->count('CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END'),
                'abiertos' => $this->Servicios->find()->newExpr('COUNT(*) - COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END)'),
                'eficacia' => $this->Servicios->find()->newExpr('COUNT(CASE WHEN statu_id = 5 OR statu_id = 6 THEN 1 END) * 100 / COUNT(*)'),
                'CoUsers.nombre'
            ])
            ->join([
                'CoUsers' => [
                    'table' => 'co_users',
                    'type' => 'INNER',
                    'conditions' => 'Servicios.agente = CoUsers.co_user_id'
                ]
            ])
            ->where([
                'Servicios.fecha_creacion >=' => $inicio,
                'Servicios.fecha_creacion <=' => $fin,
                'Servicios.co_group_id' => 5
            ])
            ->group(['Servicios.agente'])
            ->order([
                'eficacia' => 'DESC',
                'Servicios.agente' => 'DESC'
            ]);





        $serviciosSinasignar = $this->Servicios->find()
            ->select([
                'Servicios.servicio_id',
                'Servicios.agente',
                'CoUsers.nombre',
                'Servicios.created'
            ])
            ->join([
                'CoUsers' => [
                    'table' => 'co_users',
                    'type' => 'INNER',
                    'conditions' => 'Servicios.agente = CoUsers.co_user_id'
                ]
            ])
            ->where([
                'Servicios.agente IN' => [4, 12, 243],
                'Servicios.statu_id' => 1
            ])
            ->order(['Servicios.created' => 'ASC'])
            ->limit(10);





        $serviciosSinatender = $this->Servicios->find()
            ->select([
                'Servicios.servicio_id',
                'Servicios.agente',
                'Servicios.co_group_id',
                'CoUsers.nombre',
                'Servicios.fecha_creacion'
            ])
            ->join([
                'CoUsers' => [
                    'table' => 'co_users',
                    'type' => 'INNER',
                    'conditions' => 'Servicios.agente = CoUsers.co_user_id'
                ]
            ])
            ->where([
                'Servicios.statu_id IN' => [1, 2, 3, 4, 7, 8]
            ])
            ->order(['Servicios.fecha_creacion' => 'ASC'])
            ->limit(20);


        //pr($serviciosUsuarios->toArray());

        /*$serviciosUsuarios = $this->Servicios->CoUsers->find('all', array(
            'contain' => array('CoGroups'),
            'conditions' => array(
                'CoGroups.tipo IN' => array(2, 3)
            ),
            'order' => array('CoUsers.nombre' => 'ASC'),
            'select' => array('Servicios.co_user_id','CoUsers.nombre', 'CoUsers.co_user_id', 'CoGroups.co_group_id', 'CoGroups.tipo',
            'count' => $this->Servicios->find()->func()->count('*')
        ),
        'group' => array('co_user_id'),
        ));*/



        /*$serviciosEstatus = $this->Servicios->find('all',
                                                ['contain'=>['Status'],
                                                'fields'=>['Servicios.statu_id','Status.descripcion'],
                                                'conditions'=>['Servicios.fecha_solicitud >='=>$inicio,'Servicios.fecha_solicitud <='=>$fin],
                                                'group'=>['Servicios.statu_id']])->select(['Servicios.statu_id',
                                                                                                        'count' => $this->Servicios->find()->func()->count('*')])->order(['count'=>'ASC']);  */




        /*$serviciosTipoGrupo = $this->Servicios->find('all',
                                                ['contain'=>['TipoServicios'=>['Grupos']],
                                                'fields'=>['Servicios.tipo_servicio_id','Grupos.descripcion','TipoServicios.descripcion','esfuerzo'=>'SUM(Servicios.esfuerzo)'],
                                                'conditions'=>['Servicios.fecha_solicitud >='=>$inicio,'Servicios.fecha_solicitud <='=>$fin],
                                                'group'=>['TipoServicios.grupo_id']])->select(['Servicios.tipo_servicio_id',
                                                                                                        'count' => $this->Servicios->find()->func()->count('*')])->order(['count'=>'ASC']);*/




        //pr($serviciosTipoGrupo);
        //exit;


        //$arrayServicioUsuario = $serviciosUsuarios->toArray();
        //pr($arrayServicioUsuario);
        //exit;





        $user = $this->Auth->User('co_user_id');
        $grupo = $this->Auth->User('co_group_id');



        $this->paginate = [
            'contain' => ['CoUsers', 'Status'],
            'order' => ['servicio_id DESC'],
            'conditions' => ['Servicios.co_user_id' => $user]
        ];
        $servicios = $this->paginate($this->Servicios);






        $this->set(compact('servicios', 'inicio', 'fin', 'serviciosUsuariosDSI', 'serviciosUsuariosDTI', 'serviciosUsuariosDST', 'serviciosUsuariosADM', 'serviciosSinasignar', 'serviciosSinatender', 'serviciosTotal'));
    }
}
