<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Vehiculos') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle de  Vehiculo');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $vehiculo->id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',$vehiculo->id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', $vehiculo->id)); ?> 
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Vehiculos','escape' => false)); ?> 
                     </div>
                             <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'Contratos', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Contratos'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'Contratos', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Contrato '));
                                   
                                 ?>                               
                              </div>    
                                                        <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'Servicios', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Servicios'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'Servicios', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Servicio '));
                                   
                                 ?>                               
                              </div>    
                                                        <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'Usos', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Usos'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'Usos', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Uso '));
                                   
                                 ?>                               
                              </div>    
                                                        <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'Origenes', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Origenes'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'Origenes', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Origene '));
                                   
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
                        <td class="field"><?= __('Id') ?></td>
                        <td><?= h($vehiculo->id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Contrato') ?></td>
                        <td><?= $vehiculo->has('contrato') ? $this->Html->link($vehiculo->contrato->id, ['controller' => 'Contratos', 'action' => 'view', $vehiculo->contrato->id]) : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Clave Tarifa') ?></td>
                        <td><?= h($vehiculo->clave_tarifa) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Marca') ?></td>
                        <td><?= h($vehiculo->marca) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Modelo') ?></td>
                        <td><?= h($vehiculo->modelo) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Placas') ?></td>
                        <td><?= h($vehiculo->placas) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('No Serie') ?></td>
                        <td><?= h($vehiculo->no_serie) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Servicio') ?></td>
                        <td><?= $vehiculo->has('servicio') ? $this->Html->link($vehiculo->servicio->id, ['controller' => 'Servicios', 'action' => 'view', $vehiculo->servicio->id]) : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Uso') ?></td>
                        <td><?= $vehiculo->has('uso') ? $this->Html->link($vehiculo->uso->id, ['controller' => 'Usos', 'action' => 'view', $vehiculo->uso->id]) : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Origene') ?></td>
                        <td><?= $vehiculo->has('origene') ? $this->Html->link($vehiculo->origene->id, ['controller' => 'Origenes', 'action' => 'view', $vehiculo->origene->id]) : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Conductor') ?></td>
                        <td><?= h($vehiculo->conductor) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Created') ?></td>
                        <td><?= h($vehiculo->created) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Modified') ?></td>
                        <td><?= h($vehiculo->modified) ?></td>
                    </tr>
              </tbody>  
            </table>
             </div>

             </div>
          </div>
               
        </div>
    </div>
</div>    