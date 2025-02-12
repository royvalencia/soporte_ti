<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
    <h2><i class="fa fa-ban"></i></i>&nbsp;<?= __('Ban IPs') ?></h2>
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalles del BAN');?> </h5>                    
               </div>               
            <div class="ibox-content">   
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar">
                            <div class="btn-group pull-right"> 
                                <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $banip->banip_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                            
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
                            <td class="field"><?= __('No de BAN') ?></td>
                            <td><?= h($banip->banip_id) ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('IP ') ?></td>
                            <td><?= $banip->ip ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Amenaza') ?></td>
                            <td><?= $banip->amenanza ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Fuente') ?></td>
                            <td><?= $banip->fuente ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Destino') ?></td>
                            <td><?= $banip->destino ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Fecha Hora') ?></td>
                            <td><?= $banip->fecha_hora ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Registró') ?></td>
                            <td><?= $banip->co_user->clave_nombre ?></td>
                        </tr>
                    </tbody>  
                  </table>
                </div>
            </div> 
          </div>
        </div>
    </div>
</div>   