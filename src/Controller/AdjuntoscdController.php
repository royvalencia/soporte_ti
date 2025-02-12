<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Adjuntoscd Controller
 *
 * @property \App\Model\Table\AdjuntoscdTable $Adjuntoscd
 *
 * @method \App\Model\Entity\Adjuntoscd[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdjuntoscdController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Vpns']
        ];
        $adjuntoscd = $this->paginate($this->Adjuntoscd);

        $this->set(compact('adjuntoscd'));
    }

    /**
     * View method
     *
     * @param string|null $id Adjuntoscd id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $adjuntocd = $this->Adjuntoscd->get($id, [
            'contain' => ['Vpns']
        ]);

        $this->set('adjuntocd', $adjuntocd);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idvpn = null)
    {
        $success = false;  
        $data = array('message'=>'Ocurrio un error al procesar la imagen','errors'=>array());  
        $imageFileName = false;  

        $adjuntocd = $this->Adjuntoscd->newEntity();
        if ($this->request->is('post')) {
            /* 
            $adjuntoscd = $this->Adjuntoscd->patchEntity($adjuntoscd, $this->request->getData());
            if ($this->Adjuntoscd->save($adjuntoscd)) {
                $this->Flash->success(__('The adjuntoscd has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The adjuntoscd could not be saved. Please, try again.')); 
            */
            //Codigo para Subida de Archios, se agrega el nombre al Archivo Numeracion Random
            if (!empty($this->request->data['archivo']['name'])) {
                $file = $this->request->data['archivo']; //put the data into a var for easy use

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                //$arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                $setNewFileName = time() . "_" . rand(000000, 999999);
                //do the actual uploading of the file. First arg is the tmp name, second arg is 
                    //where we are putting it
                move_uploaded_file($file['tmp_name'], WWW_ROOT . DS.'upload'.DS.'archivos'.DS . $setNewFileName . '.' . $ext);

                    //prepare the filename for database entry 
                $imageFileName = $setNewFileName . '.' . $ext;
                if($imageFileName){ //Guardamos la imagen en la BD
                        
                    $adjuntocd = $this->Adjuntoscd->patchEntity($adjuntocd, $this->request->getData());
                    $adjuntocd->archivo = $imageFileName;
                    $adjuntocd->vpn_id = $this->request->data['idvpn'];
                    $adjuntocd->descripcion = $this->request->data['descripcion'];
                    if ($this->Adjuntoscd->save($adjuntocd)) {
                        $success =true;
                        
                    $this->Flash->success('Imagen de Perfil actualizada con éxito');
                    return $this->redirect(['controller' => 'Vpns','action' => 'view',$this->request->data['idvpn']]);
                    } else {
                        $success =false;
                        $this->Flash->error('La imagen de perfil no fue actualizada, intente de nuevo');
                    }                  
                      
                    }
                
                }
        }
        $vpns = $this->Adjuntoscd->Vpns->find('list', ['limit' => 200]);
        $this->set(compact('adjuntocd', 'vpns', 'idvpn'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Adjuntoscd id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $adjuntocd = $this->Adjuntoscd->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $adjuntocd = $this->Adjuntoscd->patchEntity($adjuntocd, $this->request->getData());
            if ($this->Adjuntoscd->save($adjuntocd)) {
                $this->Flash->success(__('The adjuntoscd has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The adjuntoscd could not be saved. Please, try again.'));
        }
        $vpns = $this->Adjuntocd->Vpns->find('list', ['limit' => 200]);
        $this->set(compact('adjuntocd', 'vpns'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Adjuntoscd id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $adjuntocd = $this->Adjuntoscd->get($id,[
            'contain' => []
        ]);
        if ($this->Adjuntoscd->delete($adjuntocd)) {
            @unlink( WWW_ROOT . DS.'upload'.DS.'archivos'.DS .$adjuntocd['archivo']);
            $this->Flash->success(__('El Archivo fue Eliminado.'));
            return $this->redirect(['controller' => 'Vpns','action' => 'view',$adjuntocd['vpn_id']]);
        } else {
            $this->Flash->error(__('El Archivo no se pudo eliminar. Intente de Nuevo.!!'));
        }

        return $this->redirect(['action' => 'index']);
    }
}