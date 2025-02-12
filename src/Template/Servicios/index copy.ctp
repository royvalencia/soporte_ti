 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
       <h2><?= __('Servicios') ?></h2>
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
       <div class="col-lg-12">
          <div class="ibox float-e-margins">
             <div class="ibox-title">
                <h5><?= __('Lista de Servicios') ?></h5>
             </div>
             <div class="ibox-content">
                <div class="row">
                   <div class="col-md-12">
                      <div class="btn-toolbar" role="toolbar">
                         <div class="btn-group pull-right">
                            <?php echo $this->Html->link('<i class="fa fa-plus"></i> Nuevo', array('action' => 'add'), array('class' => 'btn btn-default', 'escape' => false, 'rel' => 'tooltip', 'title' => 'Agregar')); ?>
                         </div>

                  
                      </div>
                   </div>
                </div>
                <br>
                <table class="table table-striped table-hover table-index">
                   <thead>
                      <tr>
                         <th><?= $this->Paginator->sort('servicio_id') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th><?= $this->Paginator->sort('asunto') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th><?= $this->Paginator->sort('statu_id') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th><?= $this->Paginator->sort('fuente') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th><?= $this->Paginator->sort('prioridade_id') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th><?= $this->Paginator->sort('fecha_creacion') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th><?= $this->Paginator->sort('tipo_incidencia_id') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th><?= $this->Paginator->sort('co_group_id') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th><?= $this->Paginator->sort('dependencia_id') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th><?= $this->Paginator->sort('direccione_id') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th><?= $this->Paginator->sort('solicitante_id') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th><?= $this->Paginator->sort('grupo_id') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th><?= $this->Paginator->sort('co_user_id') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th><?= $this->Paginator->sort('agente') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th><?= $this->Paginator->sort('created') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th><?= $this->Paginator->sort('modified') ?> <i class="fa fa-sort fa-1"></i></th>
                         <th class="actions"><?= __('Acciones') ?></th>
                      </tr>
                   </thead>
                   <tbody>
                      <?php foreach ($servicios as $servicio): ?>
                         <tr>
                            <td><?= $this->Number->format($servicio->servicio_id) ?></td>
                            <td><?= h($servicio->asunto) ?></td>
                            <td><?= $servicio->has('status') ? $this->Html->link($servicio->status->descripcion, ['controller' => 'Status', 'action' => 'view', $servicio->status->statu_id]) : '' ?></td>
                            <td><?= $this->Number->format($servicio->fuente) ?></td>
                            <td><?= $servicio->has('prioridade') ? $this->Html->link($servicio->prioridade->descripcion, ['controller' => 'Prioridades', 'action' => 'view', $servicio->prioridade->prioridade_id]) : '' ?></td>
                            <td><?= h($servicio->fecha_creacion) ?></td>
                            <td><?= $servicio->has('tipo_incidencia') ? $this->Html->link($servicio->tipo_incidencia->descripcion, ['controller' => 'TipoIncidencias', 'action' => 'view', $servicio->tipo_incidencia->tipo_incidencia_id]) : '' ?></td>
                            <td><?= $servicio->has('co_group') ? $this->Html->link($servicio->co_group->name, ['controller' => 'CoGroups', 'action' => 'view', $servicio->co_group->co_group_id]) : '' ?></td>
                            <td><?= $servicio->has('dependencia') ? $this->Html->link($servicio->dependencia->dependencia_id, ['controller' => 'Dependencias', 'action' => 'view', $servicio->dependencia->dependencia_id]) : '' ?></td>
                            <td><?= $servicio->has('direccione') ? $this->Html->link($servicio->direccione->direccione_id, ['controller' => 'Direcciones', 'action' => 'view', $servicio->direccione->direccione_id]) : '' ?></td>
                            <td><?= $servicio->has('solicitante') ? $this->Html->link($servicio->solicitante->solicitante_id, ['controller' => 'Solicitantes', 'action' => 'view', $servicio->solicitante->solicitante_id]) : '' ?></td>
                            <td><?= $servicio->has('grupo') ? $this->Html->link($servicio->grupo->descripcion, ['controller' => 'Grupos', 'action' => 'view', $servicio->grupo->grupo_id]) : '' ?></td>
                            <td><?= $servicio->has('co_user') ? $this->Html->link($servicio->co_user->clave_nombre, ['controller' => 'CoUsers', 'action' => 'view', $servicio->co_user->co_user_id]) : '' ?></td>
                            <td><?= $this->Number->format($servicio->agente) ?></td>
                            <td><?= h($servicio->created) ?></td>
                            <td><?= h($servicio->modified) ?></td>
                            <td class="actions">
                               <?= $this->Html->link(__('<i class="fa fa-th" ></i>'), ['action' => 'view', $servicio->servicio_id], ['class' => 'btn btn-default btn-sm', 'rel' => 'tooltip', 'title' => 'Ver', 'escape' => false]) ?>
                               <?= $this->Html->link(__('<i class="fa fa-edit" ></i>'), ['action' => 'edit', $servicio->servicio_id], ['class' => 'btn btn-default btn-sm', 'rel' => 'tooltip', 'title' => 'Editar', 'escape' => false]) ?>
                               <?= $this->Form->postLink(__('<i class="fa fa-trash-o" ></i>'), ['action' => 'delete', $servicio->servicio_id], ['class' => 'btn btn-default btn-sm', 'rel' => 'tooltip', 'title' => 'Eliminar', 'escape' => false, 'confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $servicio->servicio_id)]) ?>
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