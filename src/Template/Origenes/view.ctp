<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Origenes') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle de  Origene');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $origene->id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',$origene->id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', $origene->id)); ?> 
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Origenes','escape' => false)); ?> 
                     </div>
                             <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'Vehiculos', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Vehiculos'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'Vehiculos', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Vehiculo '));
                                   
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
                        <td><?= h($origene->id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Descripcion') ?></td>
                        <td><?= h($origene->descripcion) ?></td>
                    </tr>
              </tbody>  
            </table>
             </div>
      <div class="row">
        <div class="related col-sm-10 col-sm-offset-2">
            <h3><?= __('Related Vehiculos') ?></h3>
            <?php if (!empty($origene->vehiculos)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                        <th><?= __('Id') ?></th>
                        <th><?= __('Contrato Id') ?></th>
                        <th><?= __('Clave Tarifa') ?></th>
                        <th><?= __('Marca') ?></th>
                        <th><?= __('Modelo') ?></th>
                        <th><?= __('Placas') ?></th>
                        <th><?= __('No Serie') ?></th>
                        <th><?= __('Servicio Id') ?></th>
                        <th><?= __('Uso Id') ?></th>
                        <th><?= __('Origene Id') ?></th>
                        <th><?= __('Conductor') ?></th>
                        <th><?= __('Created') ?></th>
                        <th><?= __('Modified') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($origene->vehiculos as $vehiculos): ?>
                <tr>
                    <td><?= h($vehiculos->id) ?></td>
                    <td><?= h($vehiculos->contrato_id) ?></td>
                    <td><?= h($vehiculos->clave_tarifa) ?></td>
                    <td><?= h($vehiculos->marca) ?></td>
                    <td><?= h($vehiculos->modelo) ?></td>
                    <td><?= h($vehiculos->placas) ?></td>
                    <td><?= h($vehiculos->no_serie) ?></td>
                    <td><?= h($vehiculos->servicio_id) ?></td>
                    <td><?= h($vehiculos->uso_id) ?></td>
                    <td><?= h($vehiculos->origene_id) ?></td>
                    <td><?= h($vehiculos->conductor) ?></td>
                    <td><?= h($vehiculos->created) ?></td>
                    <td><?= h($vehiculos->modified) ?></td>
                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                            <?= $this->Html->link(__('Ver'), ['controller' => 'Vehiculos', 'action' => 'view', $vehiculos->id],['class' => 'btn btn-default btn-sm']) ?>
                            <?= $this->Html->link(__('Editar'), ['controller' => 'Vehiculos', 'action' => 'edit', $vehiculos->id],['class' => 'btn btn-default btn-sm']) ?>
                            <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Vehiculos', 'action' => 'delete', $vehiculos->id], ['class' => 'btn btn-default btn-sm','confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $vehiculos->id)]) ?>
                          </div>  
                       </div> 
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
       </div> 
    
             </div>
          </div>
               
        </div>
    </div>
</div>    