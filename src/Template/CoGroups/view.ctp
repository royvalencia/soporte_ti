<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Grupos') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle del Grupo');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $coGroup->co_group_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',$coGroup->co_group_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', $coGroup->co_group_id)); ?> 
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Grupos','escape' => false)); ?> 
                     </div>
                              
                                                        
                                                       
                                                 
                   </div> 
                </div>
            </div>
            <br>      
             <div class="">
                <?php 
                $tipo=array(0=>"Seleccione...",1=>"Administrador",2=>"Supervisor",3=>"de Grupo",4=>"Usuario");
                ?>
                 <table class="table table-striped table-detalle" style="width: 100%;">
                  <tbody>
                    <tr>
                        <td class="field"><?= __('Id') ?></td>
                        <td><?= h($coGroup->co_group_id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Nombre') ?></td>
                        <td><?= h($coGroup->name) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Tipo') ?></td>
                        <td><?= h($tipo[$coGroup->tipo]) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Home Page') ?></td>
                        <td><?= h($coGroup->home_page) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('F. Alta') ?></td>
                        <td><?= h($coGroup->created) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('F. Modificado') ?></td>
                        <td><?= h($coGroup->modified) ?></td>
                    </tr>
              </tbody>  
            </table>
             </div>
      <div class="row">
        <div class="related col-sm-10 col-sm-offset-2">
            <h3><?= __('Usuarios') ?></h3>
            <?php if (!empty($coGroup->co_users)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                        <th><?= __('Id') ?></th>
                       
                        <th><?= __('Login') ?></th>
                       
                        <th><?= __('Nombre') ?></th>
                        
                      
                        <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($coGroup->co_users as $coUsers): ?>
                <tr>
                    <td><?= h($coUsers->co_user_id) ?></td>
                
                    <td><?= h($coUsers->login) ?></td>
                  
                    <td><?= h($coUsers->nombre) ?></td>
                 
                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                            <?= $this->Html->link(__('Ver'), ['controller' => 'CoUsers', 'action' => 'view', $coUsers->co_user_id],['class' => 'btn btn-default btn-sm']) ?>
                            
                          </div>  
                       </div> 
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
       </div> 
          <div class="row">
        <div class="related col-sm-10 col-sm-offset-2">
            <h3><?= __('Permisos') ?></h3>
            <?php if (!empty($coGroup->co_permissions)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                        <th><?= __('Nombre') ?></th>                        
                        <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($coGroup->co_permissions as $coPermissions): ?>
                <tr>
                   
                    <td><?= h($coPermissions->name) ?></td>
                 
                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                            <?= $this->Html->link(__('Ver'), ['controller' => 'CoPermissions', 'action' => 'view', $coPermissions->co_permission_id],['class' => 'btn btn-default btn-sm']) ?>
                            
                          </div>  
                       </div> 
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
       </div> 
          <div class="row">
        <div class="related col-sm-10 col-sm-offset-2">
            <h3><?= __('Menús') ?></h3>
            <?php 
            
            if (!empty($coGroup->co_menus)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                        <th><?= __('Id') ?></th>
                        <th><?= __('Id Padre') ?></th>                       
                        <th><?= __('Nombre') ?></th>
                        
                        
                        <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($coGroup->co_menus as $coMenus): ?>
                <tr>
                    <td><?= h($coMenus->co_menu_id) ?></td>
                    <td><?= h($coMenus->id_padre) ?></td>
                 
                    <td><?= h($coMenus->nombre) ?></td>
                    
                  
                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                            <?= $this->Html->link(__('Ver'), ['controller' => 'CoMenus', 'action' => 'view', $coMenus->co_menu_id],['class' => 'btn btn-default btn-sm']) ?>
                           
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