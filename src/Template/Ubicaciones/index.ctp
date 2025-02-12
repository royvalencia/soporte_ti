 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Ubicaciones') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><?= __('Lista de Ubicaciones') ?></h5>                    
               </div>               
            <div class="ibox-content">   
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar">
                           <div class="btn-group pull-right">
                          <?php echo $this->Html->link( '<i class="fa fa-plus"></i> Nuevo', array('action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Agregar')); ?>                                   
                         </div>
    
                                                         <div class="btn-group pull-right"  >
                                <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> Clientes'), ['controller' => 'Clientes', 'action' => 'index'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista Clientes')); ?>
                                <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> Agregar Cliente'), ['controller' => 'Clientes', 'action' => 'add'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Cliente')) ?>
                             </div>   
                                                      <div class="btn-group pull-right"  >
                                <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> Tipo Ubicaciones'), ['controller' => 'TipoUbicaciones', 'action' => 'index'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista Tipo Ubicaciones')); ?>
                                <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> Agregar Tipo Ubicacione'), ['controller' => 'TipoUbicaciones', 'action' => 'add'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Tipo Ubicacione')) ?>
                             </div>   
                                               </div> 
                    </div>
               </div>
            <br>
            <table class="table table-striped table-hover table-index">
              <thead>
                <tr>                 
                                   <th><?= $this->Paginator->sort('id') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('cliente_id') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('calle') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('no_ext') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('no_int') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('codigo_postal') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('colonia') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('ciudad_municipio') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('estado') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('direccion_confidencial') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('tipo_ubicacione_id') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('correo_electronico') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('telefono_casa') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('telefono_celular') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('telefono_oficina') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('extension') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('fax') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('extension_fax') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('created') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('modified') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('created_by') ?> <i class="fa fa-sort fa-1"></i></th>
                                <th class="actions"><?= __('Acciones') ?></th>
                </tr>
             </thead>
             <tbody>
          <?php foreach ($ubicaciones as $ubicacione): ?>
            <tr>
                <td><?= $this->Number->format($ubicacione->id) ?></td>
                <td><?= $ubicacione->has('cliente') ? $this->Html->link($ubicacione->cliente->id, ['controller' => 'Clientes', 'action' => 'view', $ubicacione->cliente->id]) : '' ?></td>
                <td><?= h($ubicacione->calle) ?></td>
                <td><?= h($ubicacione->no_ext) ?></td>
                <td><?= h($ubicacione->no_int) ?></td>
                <td><?= $this->Number->format($ubicacione->codigo_postal) ?></td>
                <td><?= h($ubicacione->colonia) ?></td>
                <td><?= h($ubicacione->ciudad_municipio) ?></td>
                <td><?= h($ubicacione->estado) ?></td>
                <td><?= h($ubicacione->direccion_confidencial) ?></td>
                <td><?= $ubicacione->has('tipo_ubicacione') ? $this->Html->link($ubicacione->tipo_ubicacione->id, ['controller' => 'TipoUbicaciones', 'action' => 'view', $ubicacione->tipo_ubicacione->id]) : '' ?></td>
                <td><?= h($ubicacione->correo_electronico) ?></td>
                <td><?= h($ubicacione->telefono_casa) ?></td>
                <td><?= h($ubicacione->telefono_celular) ?></td>
                <td><?= h($ubicacione->telefono_oficina) ?></td>
                <td><?= h($ubicacione->extension) ?></td>
                <td><?= h($ubicacione->fax) ?></td>
                <td><?= h($ubicacione->extension_fax) ?></td>
                <td><?= h($ubicacione->created) ?></td>
                <td><?= h($ubicacione->modified) ?></td>
                <td><?= $this->Number->format($ubicacione->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-th" ></i>'), ['action' => 'view', $ubicacione->id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Ver','escape' => false]) ?>
                    <?= $this->Html->link(__('<i class="fa fa-edit" ></i>'), ['action' => 'edit', $ubicacione->id],['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Editar','escape' => false]) ?>
                    <?= $this->Form->postLink(__('<i class="fa fa-trash-o" ></i>'), ['action' => 'delete', $ubicacione->id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Eliminar','escape' => false,'confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $ubicacione->id)]) ?>
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