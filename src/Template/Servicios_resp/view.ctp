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
                 <h5><i class="fa fa-th"></i> <?= __('Detalle de  Servicio');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $servicio->servicio_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                       
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Servicios','escape' => false)); ?> 
                     </div>
                              
                     <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-file-pdf-o"></i>', array('action' => 'dictamen', $servicio->servicio_id,'_ext'=>'pdf'), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Dictamen','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-file-pdf-o"></i>', array('action' => 'reporte', $servicio->servicio_id,'_ext'=>'pdf'), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Reporte','escape' => false)); ?>
                     </div>                                
                                                 
                   </div> 
                </div>
            </div>
            <br> 

             <div class="">
                 <table class="table table-striped table-detalle" style="width: 100%;">
                  <tbody>
                    <tr>
                        <td class="field"><?= __('Folio') ?></td>
                        <td><?= h($servicio->servicio_id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Fecha Solicitud') ?></td>
                        <td><?= date_format($servicio->fecha_solicitud,'Y-m-d') ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Descripción Corta') ?></td>
                        <td><?= h($servicio->descripcion_corta) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Tipo Servicio') ?></td>
                        <td><?= $servicio->tipo_servicio->descripcion ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Tipo Incidencia') ?></td>
                        <td><?= $servicio->tipo_incidencia->descripcion ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Problemática') ?></td>
                        <td><?= h($servicio->problematica) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('No Inventario') ?></td>
                        <td><?= h($servicio->no_inventario) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Prioridad') ?></td>
                        <td><?= $servicio->prioridade->descripcion ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Área Solicitante') ?></td>
                        <td><?= $servicio->cat_adscripcione->nom_ads ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Nombre Solicitante') ?></td>
                        <td><?= h($servicio->nombre_solicitante) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Cargo Solicitante') ?></td>
                        <td><?= h($servicio->cargo_solicitante) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Teléfono Solicitante') ?></td>
                        <td><?= h($servicio->telefono_solicitante) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Email Solicitante') ?></td>
                        <td><?= h($servicio->email_solicitante) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Fecha Límite Solución') ?></td>
                        <td><?= date_format($servicio->fecha_limite_solucion,'Y-m-d') ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Responsable') ?></td>
                        <td><?= $servicio->co_user->clave_nombre ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Esfuerzo Requerido') ?></td>
                        <td><?= h($servicio->esfuerzo) ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Solución') ?></td>
                        <td><?= h($servicio->solucion) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Fecha Solución') ?></td>
                        <td><?php 
                        if ($servicio->fecha_solucion!=NULL){
                            echo date_format($servicio->fecha_solucion,'Y-m-d'); 
                        }
                            ?></td>
                        
                    </tr>
                    <tr>
                        <td class="field"><?= __('Status') ?></td>
                        <td><Font color="<?= $servicio->status->color ?>"><?= $servicio->status->descripcion ?></Font></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Notas') ?></td>
                        <td><?= h($servicio->notas) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Creado') ?></td>
                        <td><?= date_format($servicio->created,'Y-m-d h:i') ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Modificado') ?></td>
                        <td><?= date_format($servicio->modified,'Y-m-d h:i') ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Creado por') ?></td>
                        <td><?= $servicio->Creador['nombre'] ?></td>
                        <?php //pr($servicio) ?>
                    </tr>
              </tbody>  
            </table>
             </div>

   <div class="row">
        <div class="related col-sm-10 col-sm-offset-2">
            <h3><?= __('Bitacora') ?></h3>
            <?php if (!empty($servicio->bitacoraservs)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                        <th><?= __('Id') ?></th>
                        <th><?= __('Servicio Id') ?></th>
                        <th><?= __('Descripcion Evento') ?></th>
                        <th><?= __('Creado') ?></th>
                        
                </tr>
                <?php foreach ($servicio->bitacoraservs as $bitacoraservs): ?>
                <tr>
                    <td><?= h($bitacoraservs->bitacoraserv_id) ?></td>
                    <td><?= h($bitacoraservs->servicio_id) ?></td>
                    <td><?= h($bitacoraservs->descripcion_evento) ?></td>
                    <td><?= h($bitacoraservs->created) ?></td>
                    
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
       </div> 
          <div class="row">
        <div class="related col-sm-10 col-sm-offset-2">
            <h3><?= __('Adjuntos') ?></h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-toolbar pull-right">
                         <?php echo $this->Html->link(__('Adjuntar Archivo'), array('controller' => 'adjuntos', 'action' => 'add', $servicio->servicio_id), array('class'=>'btn btn-default btn-sm'));?>                    </div>
                </div>
            </div>        
            <br>
            <?php if (!empty($servicio->adjuntos)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                        <th><?= __('Id') ?></th>
                        <th><?= __('Descripción') ?></th>
                        <th><?= __('Archivo') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($servicio->adjuntos as $adjuntos): ?>
                <tr>
                    <td><?= h($adjuntos->adjunto_id) ?></td>
                    <td><?= h($adjuntos->descripcion) ?></td>
                    <td><?= h($adjuntos->archivo); ?></td>
                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                          <?php  echo $this->Html->link(__('<i class="fa fa-arrow-down" ></i>'), ['action' => 'download', $adjuntos->adjunto_id],['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Descargar','escape' => false]); 
                     ?>
                            <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Adjuntos', 'action' => 'delete', $adjuntos->adjunto_id], ['class' => 'btn btn-default btn-sm','confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $adjuntos->adjunto_id)]) ?>
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