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
                 <h5><?= __('Lista de Vehiculos') ?></h5>                    
               </div>               
            <div class="ibox-content">   
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar">
                           <div class="btn-group pull-right">
                          <?php echo $this->Html->link( '<i class="fa fa-plus"></i> Nuevo', array('action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Agregar')); ?>                                   
                         </div>
    
                                                         <div class="btn-group pull-right"  >
                                <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> Contratos'), ['controller' => 'Contratos', 'action' => 'index'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista Contratos')); ?>
                                <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> Agregar Contrato'), ['controller' => 'Contratos', 'action' => 'add'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Contrato')) ?>
                             </div>   
                                                      <div class="btn-group pull-right"  >
                                <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> Servicios'), ['controller' => 'Servicios', 'action' => 'index'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista Servicios')); ?>
                                <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> Agregar Servicio'), ['controller' => 'Servicios', 'action' => 'add'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Servicio')) ?>
                             </div>   
                                                      <div class="btn-group pull-right"  >
                                <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> Usos'), ['controller' => 'Usos', 'action' => 'index'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista Usos')); ?>
                                <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> Agregar Uso'), ['controller' => 'Usos', 'action' => 'add'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Uso')) ?>
                             </div>   
                                                      <div class="btn-group pull-right"  >
                                <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> Origenes'), ['controller' => 'Origenes', 'action' => 'index'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista Origenes')); ?>
                                <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> Agregar Origene'), ['controller' => 'Origenes', 'action' => 'add'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Origene')) ?>
                             </div>   
                                               </div> 
                    </div>
               </div>
            <br>
            <table class="table table-striped table-hover table-index">
              <thead>
                <tr>                 
                                   <th><?= $this->Paginator->sort('id') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('contrato_id') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('clave_tarifa') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('marca') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('modelo') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('placas') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('no_serie') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('servicio_id') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('uso_id') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('origene_id') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('conductor') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('created') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('modified') ?> <i class="fa fa-sort fa-1"></i></th>
                                <th class="actions"><?= __('Acciones') ?></th>
                </tr>
             </thead>
             <tbody>
          <?php foreach ($vehiculos as $vehiculo): ?>
            <tr>
                <td><?= $this->Number->format($vehiculo->id) ?></td>
                <td><?= $vehiculo->has('contrato') ? $this->Html->link($vehiculo->contrato->id, ['controller' => 'Contratos', 'action' => 'view', $vehiculo->contrato->id]) : '' ?></td>
                <td><?= $this->Number->format($vehiculo->clave_tarifa) ?></td>
                <td><?= h($vehiculo->marca) ?></td>
                <td><?= h($vehiculo->modelo) ?></td>
                <td><?= h($vehiculo->placas) ?></td>
                <td><?= h($vehiculo->no_serie) ?></td>
                <td><?= $vehiculo->has('servicio') ? $this->Html->link($vehiculo->servicio->id, ['controller' => 'Servicios', 'action' => 'view', $vehiculo->servicio->id]) : '' ?></td>
                <td><?= $vehiculo->has('uso') ? $this->Html->link($vehiculo->uso->id, ['controller' => 'Usos', 'action' => 'view', $vehiculo->uso->id]) : '' ?></td>
                <td><?= $vehiculo->has('origene') ? $this->Html->link($vehiculo->origene->id, ['controller' => 'Origenes', 'action' => 'view', $vehiculo->origene->id]) : '' ?></td>
                <td><?= h($vehiculo->conductor) ?></td>
                <td><?= h($vehiculo->created) ?></td>
                <td><?= h($vehiculo->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-th" ></i>'), ['action' => 'view', $vehiculo->id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Ver','escape' => false]) ?>
                    <?= $this->Html->link(__('<i class="fa fa-edit" ></i>'), ['action' => 'edit', $vehiculo->id],['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Editar','escape' => false]) ?>
                    <?= $this->Form->postLink(__('<i class="fa fa-trash-o" ></i>'), ['action' => 'delete', $vehiculo->id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Eliminar','escape' => false,'confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $vehiculo->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
              </tbody>  
            </table>
            <div class="row">
             <div class="col-md-6" style="margin-bottom: 10px;">
                  <?php 
                    echo $this->Paginator->counter(array(
                     'format' => __('Mostrando del {{start}} al {{end}} de un total de {{count}}')
                    ));
                  ?>
              </div>
             <div class="col-md-6">
                <div class="pagination borderless pull-right custom-pagination">
                    <?php
                      echo $this->Paginator->prev(' << ' . __('Anterior'), array('class' => 'prev btn'), null, array('class' => 'prev disabled btn'));
                      echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn', 'currentClass' => 'active'));
                      echo $this->Paginator->next(__('Siguiente') . ' >> ', array('class' => 'next btn'), null, array('class' => 'next disabled btn'));
                    ?>
                 </div>
             </div>   
            </div>
            
         </div>
       </div>         
      </div>
    </div>
</div>    