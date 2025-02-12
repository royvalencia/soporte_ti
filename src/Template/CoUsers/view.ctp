<?php

 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Usuarios') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle del Usuario');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $coUser->co_user_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',$coUser->co_user_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', $coUser->co_user_id)); ?> 
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Usuarios','escape' => false)); ?> 
                     </div>
                               
                                                 
                   </div> 
                </div>
            </div>
            <br>      
             <div class="">
                 <table class="table table-striped table-detalle" style="width: 100%;">
                  <tbody>
                    <tr>
                        <td class="field"><?= __('ID') ?></td>
                        <td><?= h($coUser->co_user_id) ?></td>
                    </tr>
                   
                    <tr>
                        <td class="field"><?= __('Login') ?></td>
                        <td><?= h($coUser->login) ?></td>
                    </tr>
                   
                    <tr>
                        <td class="field"><?= __('Nombre') ?></td>
                        <td><?= h($coUser->nombre) ?></td>
                    </tr>
                    
                    <tr>
                        <td class="field"><?= __('Grupo') ?></td>
                        <td><?= $coUser->has('co_group') ? $this->Html->link($coUser->co_group->name, ['controller' => 'CoGroups', 'action' => 'view', $coUser->co_group->co_group_id]) : '' ?></td>
                    </tr>
                    
                        <tr>
                        <td class="field"><?= __('Activo') ?></td>
                        <td><?= $coUser->active ? 'Si' : 'No' ?></td>
                    </tr>
                    
                    <tr>
                        <td class="field"><?= __('Ult. imicio de sesión') ?></td>
                        <td><?= h($coUser->last_login) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Email') ?></td>
                        <td><?= h($coUser->email) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('F. Alta') ?></td>
                        <td><?= h($coUser->created) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('F. Modificado') ?></td>
                        <td><?= h($coUser->modified) ?></td>
                    </tr>
              </tbody>  
            </table>
             </div>

             </div>
          </div>
               
        </div>
    </div>
</div>    