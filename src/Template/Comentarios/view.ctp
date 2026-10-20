<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Comentarios') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle de  Comentario');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $comentario->comentario_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',$comentario->comentario_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', $comentario->comentario_id)); ?> 
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Comentarios','escape' => false)); ?> 
                     </div>
                             <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'Servicios', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Servicios'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'Servicios', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Servicio '));
                                   
                                 ?>                               
                              </div>    
                                                        <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'CoUsers', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Co Users'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'CoUsers', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Co User '));
                                   
                                 ?>                               
                              </div>    
                                                 
                   </div> 
                </div>
            </div>
            <br>      
             <div class="">
                 <table class="table table-striped table-detalle" style="width: 100%;">
                  <tbody>
                    <tr>
                        <td class="field"><?= __('Comentario Id') ?></td>
                        <td><?= h($comentario->comentario_id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Servicio') ?></td>
                        <td><?= $comentario->has('servicio') ? $this->Html->link($comentario->servicio->servicio_id, ['controller' => 'Servicios', 'action' => 'view', $comentario->servicio->servicio_id]) : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Texto') ?></td>
                        <td><?= h($comentario->texto) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Co User') ?></td>
                        <td><?= $comentario->has('co_user') ? $this->Html->link($comentario->co_user->clave_nombre, ['controller' => 'CoUsers', 'action' => 'view', $comentario->co_user->co_user_id]) : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Tipo') ?></td>
                        <td><?= h($comentario->tipo) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Usuario Notificar') ?></td>
                        <td><?= h($comentario->usuario_notificar) ?></td>
                    </tr>
              </tbody>  
            </table>
             </div>

             </div>
          </div>
               
        </div>
    </div>
</div>    