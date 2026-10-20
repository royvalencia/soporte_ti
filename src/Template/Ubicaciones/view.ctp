<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Ubicaciones') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle de  Ubicacione');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $ubicacione->id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',$ubicacione->id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', $ubicacione->id)); ?> 
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Ubicaciones','escape' => false)); ?> 
                     </div>
                             <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'Clientes', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Clientes'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'Clientes', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Cliente '));
                                   
                                 ?>                               
                              </div>    
                                                        <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'TipoUbicaciones', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Tipo Ubicaciones'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'TipoUbicaciones', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Tipo Ubicacione '));
                                   
                                 ?>                               
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
                        <td><?= h($ubicacione->id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Cliente') ?></td>
                        <td><?= $ubicacione->has('cliente') ? $this->Html->link($ubicacione->cliente->id, ['controller' => 'Clientes', 'action' => 'view', $ubicacione->cliente->id]) : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Calle') ?></td>
                        <td><?= h($ubicacione->calle) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('No Ext') ?></td>
                        <td><?= h($ubicacione->no_ext) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('No Int') ?></td>
                        <td><?= h($ubicacione->no_int) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Codigo Postal') ?></td>
                        <td><?= h($ubicacione->codigo_postal) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Colonia') ?></td>
                        <td><?= h($ubicacione->colonia) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Ciudad Municipio') ?></td>
                        <td><?= h($ubicacione->ciudad_municipio) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Estado') ?></td>
                        <td><?= h($ubicacione->estado) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Direccion Confidencial') ?></td>
                        <td><?= h($ubicacione->direccion_confidencial) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Tipo Ubicacione') ?></td>
                        <td><?= $ubicacione->has('tipo_ubicacione') ? $this->Html->link($ubicacione->tipo_ubicacione->id, ['controller' => 'TipoUbicaciones', 'action' => 'view', $ubicacione->tipo_ubicacione->id]) : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Correo Electronico') ?></td>
                        <td><?= h($ubicacione->correo_electronico) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Telefono Casa') ?></td>
                        <td><?= h($ubicacione->telefono_casa) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Telefono Celular') ?></td>
                        <td><?= h($ubicacione->telefono_celular) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Telefono Oficina') ?></td>
                        <td><?= h($ubicacione->telefono_oficina) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Extension') ?></td>
                        <td><?= h($ubicacione->extension) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Fax') ?></td>
                        <td><?= h($ubicacione->fax) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Extension Fax') ?></td>
                        <td><?= h($ubicacione->extension_fax) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Created') ?></td>
                        <td><?= h($ubicacione->created) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Modified') ?></td>
                        <td><?= h($ubicacione->modified) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Created By') ?></td>
                        <td><?= h($ubicacione->created_by) ?></td>
                    </tr>
              </tbody>  
            </table>
             </div>

             </div>
          </div>
               
        </div>
    </div>
</div>    