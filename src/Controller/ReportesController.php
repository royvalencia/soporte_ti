<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\CoUsersTable;
use App\Model\Table\CoGroupsTable;


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
                'conditions' => ['Servicios.fecha_creacion >=' => $inicio, 'Servicios.fecha_creacion <=' => $fin, 'CoGroups.tipo IN' => array(3,4,6)],
                'group' => ['Servicios.co_user_id']
            ]
        )->select([
            'Servicios.co_user_id',
            'count' => $this->Servicios->find()->func()->count('*')
        ])->order(['count' => 'ASC']);*/

        $serviciosUsuarios = $this->Servicios->CoUsers->find('all', array(
            'contain' => array('CoGroups'),
            'conditions' => array(
                'CoGroups.tipo IN' => array(2, 3)
            ),
            'order' => array('CoUsers.nombre' => 'ASC'),
            'select' => array('Servicios.co_user_id','CoUsers.nombre', 'CoUsers.co_user_id', 'CoGroups.co_group_id', 'CoGroups.tipo',
            'count' => $this->Servicios->find()->func()->count('*')
        ),
        'group' => array('co_user_id'),
        ));

        

$CoUsersTable = new CoUsersTable();
$CoGroupsTable = new CoGroupsTable();

$query = $CoUsersTable->find()
    ->select(['CoUsers.co_user_id']);
    //->leftJoin('products', ['Categories.id = Products.category_id']) // Relación entre categorías y productos
    //->group('Categories.id');

    $serviciosUsuarios = $query->all();





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






        $this->set(compact('servicios', 'inicio', 'fin', 'serviciosUsuarios'));
    }
}
