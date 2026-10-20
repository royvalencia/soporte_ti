<div><img src="/anexos/html/soporte_ti/webroot/img/encabezado_oficio.png" /></div>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10" align="center">
        <h2><?= __('Reporte Servicio') ?></h2>                     
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
                 <h5><?= __('Solicitud de servicio');?> </h5>                                          
               </div> 
          </div>          
          
          <table class="table table-striped table-detalle" border="0" style="width: 100%;">
            <tbody>             
                <tr>
                    <td class="field"><?= __('Tipo Servicio') ?></td>
                    <td><?= $servicio->tipo_servicio->descripcion ?></td>
                </tr>    
                <tr>
                    <td class="field"><?= __('Fecha Límite') ?></td>
                    <td><?= date_format($servicio->fecha_limite_solucion,'Y-m-d') ?></td>
                </tr>   
                    
              
            </tbody>  
          </table>
                              
        </div>    
    </div>
    
    
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
               <div align="center">
                 <h5><?= __('Datos del servicio');?> </h5>                                          
               </div> 
          </div>   
                    
                 <table class="table table-striped table-detalle" border="0" style="width: 100%;">
                  <tbody>
                    <tr>
                        <td class="field"><?= __('Estado') ?></td>
                        <td><Font color="<?= $servicio->status->color ?>"><?= $servicio->status->descripcion ?></Font></td>
                    </tr>                                    
                    <tr>
                        <td class="field"><?= __('Problemática') ?></td>
                        <td><?= h($servicio->problematica) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Solución') ?></td>
                        <td><?= h($servicio->solucion) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Notas') ?></td>
                        <td><?= h($servicio->notas) ?></td>
                    </tr>
                                                                       
                    <tr>
                        <td class="field"><?= __('Responsable') ?></td>
                        <td><?= $servicio->co_user->clave_nombre ?></td>
                    </tr>
                   
              </tbody>  
            </table>
             
               
        </div>
    </div>
  
    
    
</div>    