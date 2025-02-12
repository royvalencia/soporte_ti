 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Recibos') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><?= __('Lista de Recibos') ?></h5>                    
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
                                <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> Estatus'), ['controller' => 'Estatus', 'action' => 'index'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista Estatus')); ?>
                                <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> Agregar Estatus'), ['controller' => 'Estatus', 'action' => 'add'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Estatus')) ?>
                             </div>   
                                                      <div class="btn-group pull-right"  >
                                <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> Forma Pagos'), ['controller' => 'FormaPagos', 'action' => 'index'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista Forma Pagos')); ?>
                                <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> Agregar Forma Pago'), ['controller' => 'FormaPagos', 'action' => 'add'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Forma Pago')) ?>
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
                                  <th><?= $this->Paginator->sort('vencimiento') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('estatu_id') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('forma_pago_id') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('fecha_pago') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('created') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('modified') ?> <i class="fa fa-sort fa-1"></i></th>
                                <th class="actions"><?= __('Acciones') ?></th>
                </tr>
             </thead>
             <tbody>
          <?php foreach ($recibos as $recibo): ?>
            <tr>
                <td><?= $this->Number->format($recibo->id) ?></td>
                <td><?= $recibo->has('contrato') ? $this->Html->link($recibo->contrato->id, ['controller' => 'Contratos', 'action' => 'view', $recibo->contrato->id]) : '' ?></td>
                <td><?= h($recibo->vencimiento) ?></td>
                <td><?= $recibo->has('estatus') ? $this->Html->link($recibo->estatus->id, ['controller' => 'Estatus', 'action' => 'view', $recibo->estatus->id]) : '' ?></td>
                <td><?= $recibo->has('forma_pago') ? $this->Html->link($recibo->forma_pago->id, ['controller' => 'FormaPagos', 'action' => 'view', $recibo->forma_pago->id]) : '' ?></td>
                <td><?= h($recibo->fecha_pago) ?></td>
                <td><?= h($recibo->created) ?></td>
                <td><?= h($recibo->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-th" ></i>'), ['action' => 'view', $recibo->id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Ver','escape' => false]) ?>
                    <?= $this->Html->link(__('<i class="fa fa-edit" ></i>'), ['action' => 'edit', $recibo->id],['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Editar','escape' => false]) ?>
                    <?= $this->Form->postLink(__('<i class="fa fa-trash-o" ></i>'), ['action' => 'delete', $recibo->id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Eliminar','escape' => false,'confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $recibo->id)]) ?>
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