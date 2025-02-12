<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Ramos') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle de  Ramo');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $ramo->id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',$ramo->id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', $ramo->id)); ?> 
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Ramos','escape' => false)); ?> 
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
                        <td><?= h($ramo->id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Descripcion') ?></td>
                        <td><?= h($ramo->descripcion) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Operación') ?></td>
                        <td><?= $ramo->has('operacione') ? $this->Html->link($ramo->operacione->descripcion, ['controller' => 'Operaciones', 'action' => 'view', $ramo->operacione->id]) : '' ?></td>
                    </tr>
                          </tbody>  
            </table>
             </div>

          <div class="row">
        <div class="related col-sm-10 col-sm-offset-2">
            <h3><?= __('Productos') ?></h3>
            <?php if (!empty($ramo->productos)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                       
                        <th><?= __('Descripcion') ?></th>                     
                        <th class="actions"><?= __('Acciones') ?></th>
                </tr>
                <?php foreach ($ramo->productos as $productos): ?>
                <tr>
                   
                    <td><?= h($productos->descripcion) ?></td>
                    
                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                            <?= $this->Html->link(__('Ver'), ['controller' => 'Productos', 'action' => 'view', $productos->id],['class' => 'btn btn-default btn-sm']) ?>
                           
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