<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Conf Apps') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle de  Conf App');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $confApp->id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',$confApp->id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', $confApp->id)); ?> 
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Conf Apps','escape' => false)); ?> 
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
                        <td><?= h($confApp->id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Campo') ?></td>
                        <td><?= h($confApp->campo) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Valor') ?></td>
                        <td><?= h($confApp->valor) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Descripcion') ?></td>
                        <td><?= h($confApp->descripcion) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Valor Estatico') ?></td>
                        <td><?= h($confApp->valor_estatico) ?></td>
                    </tr>
              </tbody>  
            </table>
             </div>

             </div>
          </div>
               
        </div>
    </div>
</div>    