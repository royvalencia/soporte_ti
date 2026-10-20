<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Menús del Sistema') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle del Menú');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $coMenu->co_menu_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',$coMenu->co_menu_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', $coMenu->co_menu_id)); ?> 
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Menus','escape' => false)); ?> 
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
                        <td><?= h($coMenu->co_menu_id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Id Padre') ?></td>
                        <td><?= h($coMenu->id_padre) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Posicion') ?></td>
                        <td><?= h($coMenu->posicion) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Nombre') ?></td>
                        <td><?= h($coMenu->nombre) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Destino') ?></td>
                        <td><?= h($coMenu->destino) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Icono') ?></td>
                        <td><?= h($coMenu->icono) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Etiqueta') ?></td>
                        <td><?= h($coMenu->etiqueta) ?></td>
                    </tr>
              </tbody>  
            </table>
             </div>
      <div class="row">
        <div class="related col-sm-10 col-sm-offset-2">
            <h3><?= __('Related Co Groups') ?></h3>
            <?php if (!empty($coMenu->co_groups)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                        <th><?= __('Co Group Id') ?></th>
                        <th><?= __('Name') ?></th>
                        <th><?= __('Home Page') ?></th>
                        <th><?= __('Created') ?></th>
                        <th><?= __('Modified') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($coMenu->co_groups as $coGroups): ?>
                <tr>
                    <td><?= h($coGroups->co_group_id) ?></td>
                    <td><?= h($coGroups->name) ?></td>
                    <td><?= h($coGroups->home_page) ?></td>
                    <td><?= h($coGroups->created) ?></td>
                    <td><?= h($coGroups->modified) ?></td>
                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                            <?= $this->Html->link(__('Ver'), ['controller' => 'CoGroups', 'action' => 'view', $coGroups->co_group_id],['class' => 'btn btn-default btn-sm']) ?>
                            <?= $this->Html->link(__('Editar'), ['controller' => 'CoGroups', 'action' => 'edit', $coGroups->co_group_id],['class' => 'btn btn-default btn-sm']) ?>
                            <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'CoGroups', 'action' => 'delete', $coGroups->co_group_id], ['class' => 'btn btn-default btn-sm','confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $coGroups->co_group_id)]) ?>
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