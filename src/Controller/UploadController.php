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
class UploadController extends AppController
{


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function archivos($id,$archivo)
    {
        $this->Flash->error('Archivo Dañado, favor de subirlo nuevamente.');
        return $this->redirect(['controller'=>'Servicios','action' => 'view',$id]);
    }

}