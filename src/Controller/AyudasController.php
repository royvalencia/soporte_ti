<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Negocios Controller
 *
 * @property \App\Model\Table\NegociosTable $Negocios
 */
class AyudasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

    }
    /** FUNCION DONDE LLAMA AL PDF, PARA QUE SE PUEDA VISUALIZAR **/
    public function verPDF()
    {
        $archivoPDF = WWW_ROOT . 'upload' .DS. 'manual_soporte_tic.pdf';
        $this->response->type('application/pdf');
        $this->response->file($archivoPDF, ['download' => false]);
        $this->response->send();
        $this->autoRender = false;
    }

    /**
     * View method
     *
     * @param string|null $id Negocio id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
}
