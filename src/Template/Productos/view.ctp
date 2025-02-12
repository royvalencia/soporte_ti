<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Productos') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle de  Producto');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $producto->id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',$producto->id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', $producto->id)); ?> 
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Productos','escape' => false)); ?> 
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
                        <td><?= h($producto->id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Descripcion') ?></td>
                        <td><?= h($producto->descripcion) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Ramo') ?></td>
                        <td><?= $producto->has('ramo') ? $this->Html->link($producto->ramo->descripcion, ['controller' => 'Ramos', 'action' => 'view', $producto->ramo->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Vista Mostrar') ?></td>
                        <td><?= h($producto->vista_mostrar) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Etiqueta') ?></td>
                        <td><?= h($producto->etiqueta) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Icono') ?></td>
                        <td><?= h($producto->icono) ?></td>
                    </tr>
                    
                          </tbody>  
            </table>
             </div>

          <div class="row">
        <div class="related col-sm-10 col-sm-offset-2">
            <h3><?= __('Sub Ramos') ?></h3>
            <?php if (!empty($producto->sub_ramos)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                       
                        <th><?= __('Descripcion') ?></th>
                     
                        <th class="actions"><?= __('Acciones') ?></th>
                </tr>
                <?php foreach ($producto->sub_ramos as $subRamos): ?>
                <tr>
                    
                    <td><?= h($subRamos->descripcion) ?></td>
                  
                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                            <?= $this->Html->link(__('Ver'), ['controller' => 'SubRamos', 'action' => 'view', $subRamos->id],['class' => 'btn btn-default btn-sm']) ?>
                            
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