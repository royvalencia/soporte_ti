<?php 
echo $this->Html->script('inspinia/plugins/emodal/eModal.min', array('inline' => true)); 

    echo $this->Html->css('inspinia/plugins/jasny/jasny-bootstrap.min');
      echo $this->Html->script('inspinia/plugins/jasny/jasny-bootstrap.min', array('inline' => true)); 
 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Cartera de Clientes') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle del  Cliente');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $cliente->id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar datos generales del cliente','escape' => false)); ?>
                       
                         <?= $this->Form->postLink(__('<i class="fa fa-trash-o" ></i>'), ['action' => 'delete', $cliente->id], ['class' => 'btn btn-default','rel' => 'tooltip','title'=>'Eliminar cliente y toda su información','escape' => false,'confirm' => __('¿Seguro que desea eliminar el cliente # {0}?', $cliente->id)]) ?>
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar nuevo cliente','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Clientes','escape' => false)); ?> 
                     </div>
                      <div class="btn-group pull-right"> 
                           <?php echo $this->Html->link('<i class="fa fa-file-pdf-o"></i>', array('action' => 'view', $cliente->id,'_ext'=>'pdf'), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Imprimir','escape' => false)); ?>
                     
                           
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
                        <td colspan="5"><?= h($cliente->id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Apellido Paterno') ?></td>
                        <td><?= h($cliente->apellido_paterno) ?></td>
                   
                        <td class="field"><?= __('Apellido Materno') ?></td>
                        <td><?= h($cliente->apellido_materno) ?></td>
                 
                        <td class="field"><?= __('Nombre') ?></td>
                        <td><?= h($cliente->nombre) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Razon Social') ?></td>
                        <td colspan="5"><?= h($cliente->razon_social) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('RFC') ?></td>
                        <td><?= h($cliente->rfc) .' - '.$cliente->homoclave ?></td>                   
                        <td class="field"><?= __('CURP') ?></td>
                        <td colspan="3"><?= h($cliente->homoclave) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Genero') ?></td>
                        <td><?= h($cliente->genero) ?></td>                   
                        <td class="field"><?= __('Estado Civil') ?></td>
                        <td colspan="3"><?= h($cliente->estado_civil) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Fecha Nacimiento') ?></td>
                        <td><?= h($cliente->fecha_nacimiento) ?></td>     
                        <td class="field"><?= __('Ocupación') ?></td>
                        <td colspan="3"><?= $cliente->has('ocupacione') ? $cliente->ocupacione->descripcion : '' ?></td>             
                       
                    </tr>
                    <tr>
                         <td class="field"><?= __('Lugar Nacimento') ?></td>
                        <td ><?= h($cliente->lugar_nacimento) ?></td>
                        <td class="field"><?= __('Nacionalidad') ?></td>
                        <td ><?= h($cliente->nacionalidad) ?></td>                 
                        <td class="field"><?= __('Grupo') ?></td>
                        <td><?= h($cliente->grupo) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Observaciones') ?></td>
                        <td colspan="5"><?= h($cliente->observaciones) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('F. Alta') ?></td>
                        <td><?= h($cliente->created) ?></td>
                    
                        <td class="field"><?= __('F. Modificado') ?></td>
                        <td colspan="3"><?= h($cliente->modified) ?></td>
                    </tr>
                    
              </tbody>  
            </table>
             </div>
      <div class="row">
        <div class="related col-sm-10 col-sm-offset-2">
            <h3><?= __('Ubicaciones') ?></h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar">
                           <div class="btn-group pull-right">
                          <?php echo $this->Html->link( '<i class="fa fa-plus"></i> Nueva Ubicación', 'javascript:nuevaUbicacion('.$cliente->id.')', array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Agregar Nueva ubicación')); ?>                                   
                         </div>       
                     </div> 
                    </div>
               </div>
            <?php if (!empty($cliente->ubicaciones)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                       
                        <th><?= __('Calle') ?></th>
                        <th><?= __('No. Ext.') ?></th>
                        .
                        <th><?= __('Colonia') ?></th>
                        <th><?= __('Ciudad Municipio') ?></th>                      
                       
                        <th><?= __('Tel. Casa') ?></th>
                        <th><?= __('Tel. Celular') ?></th>
                        <th><?= __('Tel. Oficina') ?></th>
                        <th><?= __('Extension') ?></th>
                     

                        <th class="actions"><?= __('Acciones') ?></th>
                </tr>
                <?php foreach ($cliente->ubicaciones as $ubicaciones): ?>
                <tr>
                   
                    <td><?= h($ubicaciones->calle) ?></td>
                    <td><?= h($ubicaciones->no_ext) ?></td>                  
             
                    <td><?= h($ubicaciones->colonia) ?></td>
                    <td><?= h($ubicaciones->ciudad_municipio) ?></td>
                   
                    <td><?= h($ubicaciones->telefono_casa) ?></td>
                    <td><?= h($ubicaciones->telefono_celular) ?></td>
                    <td><?= h($ubicaciones->telefono_oficina) ?></td>
                    <td><?= h($ubicaciones->extension) ?></td>
                  

                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                           
                            <?= $this->Html->link(__('Ver/Editar'),'javascript:detalleUbicacion('.$ubicaciones->id.','.$ubicaciones->cliente_id.')' ,['class' => 'btn btn-default btn-sm']) ?>
                            <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Ubicaciones', 'action' => 'delete', $ubicaciones->id], ['class' => 'btn btn-default btn-sm','confirm' => __('¿Seguro que desea eliminar la ubicación?', $ubicaciones->id)]) ?>
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
            <h3><?= __('Contratos') ?></h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar">
                           <div class="btn-group pull-right">
                          <?php echo $this->Html->link( '<i class="fa fa-plus"></i> Nuevo Contrato', ['controller'=>'contratos','action'=>'add',$cliente->id], array('class' => 'btn btn-primary','escape'=>false,'rel'=>'tooltip', 'title'=>'Agregar Nuevo Contrato')); ?>                                   
                         </div>       
                     </div> 
                    </div>
               </div>
           <br>
               <?php if (!empty($cliente->contratos)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                       
                        <th><?= __('No. Contrato/Póliza') ?></th>
                        <th><?= __('Empresa') ?></th>
                        <th><?= __('Sector') ?></th>
                        <th><?= __('Operación') ?></th>                             
                        <th><?= __('F. Emisión') ?></th>
                        <th class="actions"><?= __('Acciones') ?></th>
                </tr>
                <?php foreach ($cliente->contratos as $contrato): ?>
                <tr>                   
                    <td><?= h($contrato->no_contrato) ?></td>      
                    <td><?= h($contrato->empresa->nombre) ?></td>      
                    <td><?= h($contrato->sectore->descripcion) ?></td>      
                    <td><?= h($contrato->operacione->descripcion) ?></td> 
                    <td><?= h($contrato->fecha_emision) ?></td>           
                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                           
                          <?= $this->Html->link(__('Ver'),['controller'=>'Contratos','action'=>'view',$contrato->id] ,['class' => 'btn btn-default btn-sm']) ?>
                            
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
<?php 
echo $this->Html->script('clientes.js');
?>
<script type="text/javascript">
    
     var urlDetalleUbicacion ="<?php echo $this->Url->build(array('controller' => 'ubicaciones', 'action' => 'edit')); ?>";
     var urlNuevaUbicacion ="<?php echo $this->Url->build(array('controller' => 'ubicaciones', 'action' => 'add')); ?>";
</script>   