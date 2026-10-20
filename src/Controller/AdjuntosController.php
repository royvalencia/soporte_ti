<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Adjuntos Controller
 *
 * @property \App\Model\Table\AdjuntosTable $Adjuntos
 *
 * @method \App\Model\Entity\Adjunto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdjuntosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Servicios']
        ];
        $adjuntos = $this->paginate($this->Adjuntos);

        $this->set(compact('adjuntos'));
    }

    /**
     * View method
     *
     * @param string|null $id Adjunto id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $adjunto = $this->Adjuntos->get($id, [
            'contain' => ['Servicios']
        ]);

        $this->set('adjunto', $adjunto);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($idservicio = null)
    {
        $success = false;  
        $data = array('message'=>'Ocurrio un error al procesar la imagen','errors'=>array());  
        $imageFileName = false;  

        $adjunto = $this->Adjuntos->newEntity();
        if ($this->request->is('post')) {
            /*
            $adjunto = $this->Adjuntos->patchEntity($adjunto, $this->request->getData());
            if ($this->Adjuntos->save($adjunto)) {
                $this->Flash->success(__('The adjunto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The adjunto could not be saved. Please, try again.'));
            */

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
                        
                        $adjunto = $this->Adjuntos->patchEntity($adjunto, $this->request->getData());
                        $adjunto->archivo = $imageFileName;
                        $adjunto->servicio_id = $this->request->data['idservicio'];
                        $adjunto->descripcion = $this->request->data['descripcion'];
                        if ($this->Adjuntos->save($adjunto)) {
                          $success =true;
                          
                          $this->Flash->success('Imagen de Perfil actualizada con éxito');
                          return $this->redirect(['controller' => 'Servicios','action' => 'view',$this->request->data['idservicio']]);
                       } else {
                          $success =false;
                          $this->Flash->error('La imagen de perfil no fue actualizada, intente de nuevo');
                       }                  
                      
                    }
                
              } 


        }
        $servicios = $this->Adjuntos->Servicios->find('list', ['limit' => 200]);
        $this->set(compact('adjunto', 'servicios','idservicio'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Adjunto id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $adjunto = $this->Adjuntos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $adjunto = $this->Adjuntos->patchEntity($adjunto, $this->request->getData());
            if ($this->Adjuntos->save($adjunto)) {
                $this->Flash->success(__('The adjunto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The adjunto could not be saved. Please, try again.'));
        }
        $servicios = $this->Adjuntos->Servicios->find('list', ['limit' => 200]);
        $this->set(compact('adjunto', 'servicios'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Adjunto id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        


        $this->request->allowMethod(['post', 'delete']);
       $adjunto = $this->Adjuntos->get($id, [
            'contain' => []
        ]);
        if ($this->Adjuntos->delete($adjunto)) {
             @unlink( WWW_ROOT . DS.'upload'.DS.'archivos'.DS .$adjunto['archivo']);  
            $this->Flash->success(__('El Archivo fué eliminado.'));
            return $this->redirect(['controller' => 'Servicios','action' => 'view',$adjunto['servicio_id']]);
        } else {
            $this->Flash->error(__('The adjunto could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
