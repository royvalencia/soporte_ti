<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
    <h2><i class="fa fa-wifi"></i>&nbsp;<?= __('VPNs') ?></h2>
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalles del VPN');?> </h5>                    
               </div>               
            <div class="ibox-content">   
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar">
                            <div class="btn-group pull-right"> 
                                <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $vpn->vpn_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                            
                                <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                                <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de VPNS','escape' => false)); ?> 
                            </div>
                        </div> 
                    </div>
                </div>
                <br> 
                <div class="">
                  <table class="table table-striped table-detalle" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td class="field"><?= __('No de VPN') ?></td>
                            <td><?= h($vpn->vpn_id) ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Responsable de la VPN') ?></td>
                            <td><?= $vpn->responsable ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Fecha de Entrega') ?></td>
                            <td><?= date_format($vpn->fecha_entrega,'Y-m-d') ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Dependencia') ?></td>
                            <td><?= $vpn->cat_institucione->nombre ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Usuario') ?></td>
                            <td><?= $vpn->usuario ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Contraseña') ?></td>
                            <td><?= $vpn->pass ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Observaciones') ?></td>
                            <td><?= $vpn->observaciones ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Registró') ?></td>
                            <td><?= $vpn->co_user->clave_nombre ?></td>
                        </tr>
                    </tbody>  
                  </table>
                </div>
                <div class="row">
                    <div class="related col-sm-10 col-sm-offset-2">
                        <h3><?= __('Adjuntos') ?></h3>
                        <div class="row">
                <div class="col-md-12">
                    <div class="btn-toolbar pull-right">
                         <?php echo $this->Html->link(__('Adjuntar Archivo'), array('controller' => 'Adjuntoscd', 'action' => 'add', $vpn->vpn_id), array('class'=>'btn btn-default btn-sm'));?>
                    </div>
                </div>
            </div>        
            <br>
            <?php if (!empty($vpn->adjuntoscd)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                        <th><?= __('Id') ?></th>
                        <th><?= __('Descripción') ?></th>
                        <th><?= __('Archivo') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($vpn->adjuntoscd as $adjuntos): ?>
                <tr>
                    <td><?= h($adjuntos->adjuntocd_id) ?></td>
                    <td><?= h($adjuntos->descripcion) ?></td>
                    <td><?= h($adjuntos->archivo); ?></td>
                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                          <?php  echo $this->Html->link(__('<i class="fa fa-arrow-down" ></i>'), ['action' => 'download', $adjuntos->adjuntocd_id],['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Descargar','escape' => false]); 
                     ?>
                            <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Adjuntoscd', 'action' => 'delete', $adjuntos->adjuntocd_id], ['class' => 'btn btn-default btn-sm','confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $adjuntos->adjuntocd_id)]) ?>
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