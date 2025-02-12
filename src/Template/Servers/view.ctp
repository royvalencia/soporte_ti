<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-server"></i>&nbsp;<?= __('Servidores') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalles del Servidor');?> </h5>                    
               </div>               
            <div class="ibox-content">   
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar">
                            <div class="btn-group pull-right"> 
                                <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $server->server_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                            
                                <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                                <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Servidores','escape' => false)); ?> 
                            </div>
                        </div> 
                    </div>
                </div>
                <br> 
                <div class="">
                  <table class="table table-striped table-detalle" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td class="field"><?= __('No de Servidor') ?></td>
                            <td><?= h($server->server_id) ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Descripción') ?></td>
                            <td><?= $server->descripcion ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Usuario') ?></td>
                            <td><?= $server->user ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Contraseña') ?></td>
                            <td><?= $server->password ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('IP Interna Asignada') ?></td>
                            <td><?= $server->ip_interna ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('IP Externa Asignada') ?></td>
                            <td><?= $server->ip_externa ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Caracteristicas del Servidor') ?></td>
                            <td><?= $server->caracteristicas ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Servidos Intregados') ?></td>
                            <td><?= $server->servicios ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Puertos Asignados') ?></td>
                            <td><?= $server->puertos ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Registró') ?></td>
                            <td><?= $server->co_user->clave_nombre ?></td>
                        </tr>
                    </tbody>  
                  </table>
                </div>
            </div> 
          </div>
        </div>
    </div>
</div>   