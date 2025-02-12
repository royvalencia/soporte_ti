 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Usos - Vehículos') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><?= __('Lista de Usos') ?></h5>                    
               </div>               
            <div class="ibox-content">   
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar">
                           <div class="btn-group pull-right">
                          <?php echo $this->Html->link( '<i class="fa fa-plus"></i> Nuevo', array('action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Agregar')); ?>                                   
                         </div>
    
                                                         <div class="btn-group pull-right"  >
                                <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> Orígenes'), ['controller' => 'Origenes', 'action' => 'index'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista Orígenes Vehiculos')); ?>
                                <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> Servicios'), ['controller' => 'Servicios', 'action' => 'index'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Servicios Vehiculos')); ?>
                             </div>   
                                               </div> 
                    </div>
               </div>
            <br>
            <table class="table table-striped table-hover table-index">
              <thead>
                <tr>                 
                                   <th><?= $this->Paginator->sort('id') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('descripcion') ?> <i class="fa fa-sort fa-1"></i></th>
                                <th class="actions"><?= __('Acciones') ?></th>
                </tr>
             </thead>
             <tbody>
          <?php foreach ($usos as $uso): ?>
            <tr>
                <td><?= $this->Number->format($uso->id) ?></td>
                <td><?= h($uso->descripcion) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-th" ></i>'), ['action' => 'view', $uso->id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Ver','escape' => false]) ?>
                    <?= $this->Html->link(__('<i class="fa fa-edit" ></i>'), ['action' => 'edit', $uso->id],['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Editar','escape' => false]) ?>
                    <?= $this->Form->postLink(__('<i class="fa fa-trash-o" ></i>'), ['action' => 'delete', $uso->id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Eliminar','escape' => false,'confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $uso->id)]) ?>
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