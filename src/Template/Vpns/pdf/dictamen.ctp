<style type="text/css"> 
h5 { 
  font-size:14px;
  font-family: Arial;
}
.fieldA { 
  font-size:14px;
  font-weight:bold;
  font-family: Arial;
}
.fieldB { 
  font-size:14px;
  font-family: Arial;
}
</style> 

<div><img src="/anexos/html/soporte_ti/webroot/img/encabezado_oficio.png" /></div>


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10" align="center">
        <h2><?= __('Dictamen') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">    
 
 
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div align="center">
                 <h5><?= __('OFICIALIA MAYOR DE GOBIERNO');?><br><?= __('DEPARTAMENTO DE TECNOLOGÍAS DE LA INFORMACIÓN Y TELECOMUNICACIONES');?><br><?= __('Cédula de Solicitudes');?> </h5>                                          
               </div> 
          </div>
        </div>    
    </div>
    
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div align="center">
                 <h5><?= __('Datos Generales del Solicitante');?> </h5>                                          
               </div> 
          </div>          
          
          <table class="table table-striped table-detalle" border="0" style="width: 100%;">
            <tbody>                                          
                <tr>
                    <td class="fieldA"><?= __('Área Solicitante') ?></td>
                    <td class="fieldB"><?= $servicio->cat_adscripcione->nom_ads ?></td>
                </tr>
                <tr>
                    <td class="fieldA"><?= __('Nombre Solicitante') ?></td>
                    <td class="fieldB"><?= h($servicio->nombre_solicitante) ?></td>
                </tr>
                <tr>
                    <td class="fieldA"><?= __('Cargo Solicitante') ?></td>
                    <td class="fieldB"><?= h($servicio->cargo_solicitante) ?></td>
                </tr>
                <tr>
                    <td class="fieldA"><?= __('Teléfono Solicitante') ?></td>
                    <td class="fieldB"><?= h($servicio->telefono_solicitante) ?></td>
                </tr>
                <tr>
                    <td class="fieldA"><?= __('Email Solicitante') ?></td>
                    <td class="fieldB"><?= h($servicio->email_solicitante) ?></td>
                </tr>                    
            </tbody>  
          </table>
                              
        </div>    
    </div>
    
    
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
               <div align="center">
                 <h5><?= __('Datos Generales del Servicio o Soporte');?> </h5>                                          
               </div> 
          </div>   
                    
                 <table class="table table-striped table-detalle" border="0" style="width: 100%;">
                  <tbody>
                  
                    <tr>
                        <td class="fieldA"><?= __('Tipo Servicio') ?></td>
                        <td class="fieldB"><?= $servicio->tipo_servicio->descripcion ?></td>
                    </tr>                    
                    <tr>
                        <td class="fieldA"><?= __('Fecha Solicitud') ?></td>
                        <td class="fieldB"><?= date_format($servicio->fecha_solicitud,'Y-m-d') ?></td>
                    </tr>
                    <tr>
                        <td class="fieldA"><?= __('Fecha Solución') ?></td>
                        <td class="fieldB"><?php if ($servicio->fecha_solucion) 
                                    echo date_format($servicio->fecha_solucion,'Y-m-d'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="fieldA"><?= __('Folio') ?></td>
                        <td class="fieldB"><?= h($servicio->servicio_id) ?></td>
                    </tr>
                    <tr>
                        <td class="fieldA"><?= __('No Inventario') ?></td>
                        <td class="fieldB"><?= h($servicio->no_inventario) ?></td>
                    </tr>
                    <tr>
                        <td class="fieldA"><?= __('Problemática') ?></td>
                        <td class="fieldB"><?= h($servicio->problematica) ?></td>
                    </tr>
                    <tr>
                        <td class="fieldA"><?= __('Solución') ?></td>
                        <td class="fieldB"><?= h($servicio->solucion) ?></td>
                    </tr>
                    <tr>
                        <td class="fieldA"><?= __('Notas') ?></td>
                        <td class="fieldB"><?= h($servicio->notas) ?></td>
                    </tr>
                                                                       
                    
                   
              </tbody>  
            </table>
             
               
        </div>
    </div>
    
    
    <br>
    <br>
    <br>
     <div class="row">
        <div class="col-xs-6">
            <div class="ibox float-e-margins">
               <div align="center">
                 <h4><?= __('Atendió');?> </h4>                                          
               </div> 
          </div> 
        </div>
        
        <div class="col-xs-6">
            <div class="ibox float-e-margins">
               <div align="center">
                 <h4><?= __('Solicitante');?> </h4>                                          
               </div> 
          </div> 
        </div>
     </div>
     
     
     <div class="row">
        <div class="col-xs-6">
            <div class="ibox float-e-margins">
               <div align="center">
                 <h4><u><?= __($servicio->co_user->clave_nombre);?> </u></h4>  
                 <h4><?= __('Nombre y Firma');?> </h4>                                         
               </div> 
          </div> 
        </div>
        
        <div class="col-xs-6">
            <div class="ibox float-e-margins">
               <div align="center">
                 <h4><u><?= __($servicio->nombre_solicitante);?></u> </h4>  
                 <h4><?= __('Nombre y Firma');?> </h4>                                         
               </div> 
          </div> 
        </div>
     </div>
     
    
    
    
    
    
    
  
    
    
</div>    