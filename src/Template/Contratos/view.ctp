<?php 
echo $this->Html->script('inspinia/plugins/emodal/eModal.min', array('inline' => true)); 

    echo $this->Html->css('inspinia/plugins/jasny/jasny-bootstrap.min');
      echo $this->Html->script('inspinia/plugins/jasny/jasny-bootstrap.min', array('inline' => true)); 
 ?>
 
 <?php
     switch ($contrato->producto->vista_mostrar) 
     {
        case "add":
            $clase = $contrato->producto->icono;;
            $titulo1 = $contrato->producto->etiqueta;            
            $encabezadoTabla = array(0=>'Clave Tarifa',1=>'Marca',2=>'Modelo');
            $datosProducto = array(0=>'clave_tarifa',1=>'marca',2=>'modelo');
            $editar = 'edit';
            break;
        case "addEstanciaInfantil":
            $clase = $contrato->producto->icono;;
            $titulo1 = $contrato->producto->etiqueta;             
            $encabezadoTabla = array(0=>'CIS',1=>'Cap. Infantes',2=>'Emisor');
            $datosProducto = array(0=>'cis',1=>'capacidad_infantes',2=>'emisor');
            $editar = 'editEstanciaInfantil';
            break;
        case "addVarias":
            $clase = $contrato->producto->icono;;
            $titulo1 = $contrato->producto->etiqueta;             
            $encabezadoTabla = array(0=>'CIS',1=>'Año Contratación',2=>'Emisor');
            $datosProducto = array(0=>'cis',1=>'anio_contratacion',2=>'emisor');
            $editar = 'editVarias';
            break;
        case "addMedico":
            $clase = $contrato->producto->icono;;
            $titulo1 = $contrato->producto->etiqueta;             
            $encabezadoTabla = array(0=>'CIS',1=>'Año Contratación',2=>'Emisor');
            $datosProducto = array(0=>'cis',1=>'anio_contratacion',2=>'emisor');
            $editar = 'editMedico';
            break;
        case "addVida":
            $clase = $contrato->producto->icono;;
            $titulo1 = $contrato->producto->etiqueta;             
            $encabezadoTabla = array(0=>'Emisor',1=>'Año Contratación',2=>'Observaciones');
            $datosProducto = array(0=>'emisor',1=>'anio_contratacion',2=>'observaciones');
            $editar = 'editVida';
            break;
    }
 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Contratos') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle del  Contrato Folio # '.$contrato->id);?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $contrato->id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',$contrato->id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', $contrato->id)); ?> 
                        
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Contratos','escape' => false)); ?> 
                     </div>
                          
                                                        
                                                 
                   </div> 
                </div>
            </div>
            <br>      
             <div class="table-responsive">
             <table class="table table-striped table-detalle" style="width: 100%;">
                  <tbody>
                  <tr>
                        <td class="field"><?= __('Cliente') ?></td>
                        <td><?= $contrato->has('cliente') ? $this->Html->link($contrato->cliente->full_name, ['controller' => 'Clientes', 'action' => 'view', $contrato->cliente->id]) : '' ?></td>
                    
                        <td class="field"><?= __('Ubicación') ?></td>
                        <td><?= $contrato->has('ubicacione') ? $contrato->ubicacione->full_dir : '' ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('No. Contrato/Poliza') ?></td>
                        <td><?= h($contrato->no_contrato) ?></td>                    
                        <td class="field"><?= __('No. Renovacion / Año') ?></td>
                        <td><?= h($contrato->no_renovacion) .' / '.h($contrato->anio); ?></td>
                    </tr>                   
                  </tbody>
               </table>  
               <h3><?= __('Información del contrato') ?></h3> 
                 <table class="table table-striped table-detalle" style="width: 100%;">
                  <tbody>               
                    <tr>
                        <td class="field"><?= __('Empresa') ?></td>
                        <td><?= $contrato->has('empresa') ? $contrato->empresa->nombre : '' ?></td>                    
                        <td class="field"><?= __('Sector') ?></td>
                        <td><?= $contrato->has('sectore') ? $contrato->sectore->descripcion : '' ?></td>      
                        <td class="field"><?= __('Operación') ?></td>
                        <td><?= $contrato->has('operacione') ? $contrato->operacione->descripcion : '' ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Ramo') ?></td>
                        <td><?= $contrato->has('ramo') ? $contrato->ramo->descripcion : '' ?></td>
                 
                        <td class="field"><?= __('Producto') ?></td>
                        <td><?= $contrato->has('producto') ? $contrato->producto->descripcion : '' ?></td>
                    
                        <td class="field"><?= __('Sub Ramo') ?></td>
                        <td><?= $contrato->has('sub_ramo') ?$contrato->sub_ramo->descripcion : '' ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Beneficios Adicionales') ?></td>
                        <td><?php 
                             if (!empty($contrato->beneficios)){
                                 foreach($contrato->beneficios as $beneficio){
                                     echo "- ".$beneficio->descripcion.' ';
                                 }
                             }
                        ?></td>
                  
                        <td class="field"><?= __('Asesor') ?></td>
                        <td colspan="3"><?= $contrato->has('co_user') ? $contrato->co_user->clave_nombre : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Fecha Inicio') ?></td>
                        <td><?= h($contrato->fecha_inicio) ?></td>
                  
                        <td class="field"><?= __('Fecha Termino') ?></td>
                        <td><?= h($contrato->fecha_termino) ?></td>
                   
                        <td class="field"><?= __('Fecha Emision') ?></td>
                        <td><?= h($contrato->fecha_emision) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Generar Desde') ?></td>
                        <td colspan="5"><?= h($contrato->generar_desde) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Observaciones') ?></td>
                        <td colspan="5"><?= h($contrato->observaciones) ?></td>
                    </tr>
                </tbody>  
            </table>
            </div>
            <div class="row">
               <div class="col-md-6">
                     <h3>Prima</h3>  
                     <table class="table table-striped table-detalle" style="width: 100%;">
                     <tbody>
                        <tr>
                            <td class="field"><?= __('Prima Neta Anual') ?></td>
                            <td class="text-right"><?= '$ '.$this->Number->format($contrato->prima_neta_anual) ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Descuento') ?></td>
                            <td class="text-right"><?= '$ '.$this->Number->format($contrato->descuento) ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Gasto Expedicion') ?></td>
                            <td class="text-right"> <?= '$ '.$this->Number->format($contrato->gasto_expedicion) ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Iva') ?></td>
                            <td class="text-right"><?= '$ '.$this->Number->format($contrato->iva) ?></td>
                        </tr>
                        <tr>
                            <td class="field"><?= __('Prima Total') ?></td>
                            <td class="text-right"><?= '$ '.$this->Number->format($contrato->prima_total) ?></td>
                        </tr>
                     </tbody>
                     </table>      
               </div>   
               <div class="col-md-6">
                   <h3>Otros Datos</h3> 
                   <table class="table table-striped table-detalle" style="width: 100%;">
                     <tbody>
                        <tr>
                            <td class="field"><?= __('Tipo Cliente') ?></td>
                            <td><?= $contrato->has('tipo_cliente') ? $contrato->tipo_cliente->descripcion : '' ?></td>
                        </tr>
                                    <tr>
                            <td class="field"><?= __('Modalidad') ?></td>
                            <td><?= $contrato->has('modalidade') ? $contrato->modalidade->descripcion : '' ?></td>
                        </tr>
                                    <tr>
                            <td class="field"><?= __('Estatus') ?></td>
                            <td><?= $contrato->has('estatus') ? '<span class="label '. $contrato->estatus->color.' ">'. $contrato->estatus->descripcion.'</span>' : '' ?></td>
                        </tr>
                                    <tr>
                            <td class="field"><?= __('Conducto Cobro') ?></td>
                            <td><?= $contrato->has('conducto_cobro') ? $contrato->conducto_cobro->descripcion : '' ?></td>
                        </tr>
                                    <tr>
                            <td class="field"><?= __('Moneda') ?></td>
                            <td><?= $contrato->has('moneda') ? $contrato->moneda->descripcion : '' ?></td>
                        </tr>
                                    <tr>
                            <td class="field"><?= __('Forma Pago') ?></td>
                            <td><?= $contrato->has('forma_pago') ? $contrato->forma_pago->descripcion : '' ?></td>
                        </tr>
                                
                     </tbody>
                    </table>            
               </div>           
            </div>           
                    
                  
            
             
      <div class="row">
        <div class="related col-sm-6">
            <h4><i class="fa fa-usd" aria-hidden="true"></i> <?= __('Desglose de Cobranza') ?></h4>
            <?php if (!empty($contrato->recibos)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                      
                        <th><?= __('Vencimiento') ?></th>
                        <th><?= __('Estatus') ?></th>
                        <th><?= __('Forma Pago ') ?></th>
                        <th><?= __('Fecha Pago') ?></th>
                        
                        <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($contrato->recibos as $recibos): ?>
                <tr>
                    
                    <td><?= h($recibos->vencimiento) ?></td>
                    <td><?= '<span class="label '. $contrato->estatus->color.' ">'. h($recibos->estatus->descripcion).'</span>' ?></td>
                    <td><?= h($recibos->forma_pago->descripcion) ?></td>
                    <td><?= h($recibos->fecha_pago) ?></td>
                   
                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                            <?= $this->Html->link(__('Ver'), '#',['class' => 'btn btn-default btn-sm']) ?>
                            
                            
                          </div>  
                       </div> 
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
        <div class="related col-sm-6">
        
        
                <h4> <i class="<?php echo $clase; ?>" aria-hidden="true"></i> <?php echo $titulo1; ?></h4>                
                 <div class="row">
                        <div class="col-md-12">
                            <div class="btn-toolbar" role="toolbar">
                               <div class="btn-group pull-right">
                              <?php echo $this->Html->link( '<i class="fa fa-plus"></i> Nuevo', 'javascript:nuevoVehiculo('.$contrato->id.')', array('class' => 'btn btn-default btn-sm','escape'=>false,'rel'=>'tooltip', 'title'=>'Agregar Nuevo')); ?>                                   
                             </div>       
                         </div> 
                        </div>
                   </div>
                <?php if (!empty($contrato->vehiculos)): ?>
                <table class="table" cellpadding="0" cellspacing="0">
                    <tr>                       
                            <th><?= __($encabezadoTabla[0]) ?></th>
                            <th><?= __($encabezadoTabla[1]) ?></th>                        .
                            <th><?= __($encabezadoTabla[2]) ?></th>                                   
                            <th class="actions"><?= __('Acciones') ?></th>
                    </tr>
                    <?php foreach ($contrato->vehiculos as $vehiculo): ?>
                    <tr>                   
                        <td><?= h($vehiculo->$datosProducto[0]) ?></td>
                        <td><?= h($vehiculo->$datosProducto[1]) ?></td>                 
                        <td><?= h($vehiculo->$datosProducto[2]) ?></td>
                        <td class="actions">
                           <div class="btn-toolbar">
                              <div class="btn-group">                           
                                <?= $this->Html->link(__('Ver/Editar'),'javascript:detalleVehiculo('.$vehiculo->id.','.$vehiculo->contrato_id.')' ,['class' => 'btn btn-default btn-sm']) ?>
                                <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Vehiculos', 'action' => 'delete', $vehiculo->id], ['class' => 'btn btn-default btn-sm','confirm' => __('¿Seguro que desea eliminarlo?')]) ?>
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
           <div class="col-md-12"><small><?='F. Alta '. $contrato->created .' -  F. Modificado '.$contrato->modified ?></small></div>                  
     </div>
    
             </div>
          </div>
               
        </div>
    </div>
</div>  
<?php 
echo $this->Html->script('contratos-view.js');
?>
<script type="text/javascript">
    
     var urlDetalleVehiculo ="<?php echo $this->Url->build(array('controller' => 'vehiculos', 'action' => $editar)); ?>";
     var urlNuevoVehiculo="<?php echo $this->Url->build(array('controller' => 'vehiculos', 'action' => $contrato->producto->vista_mostrar)); ?>";
</script>     