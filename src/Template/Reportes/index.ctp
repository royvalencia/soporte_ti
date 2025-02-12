 
 <?php echo $this->Html->css('inspinia/plugins/datapicker/datepicker3'); ?>
<?php echo $this->Html->script('inspinia/plugins/datapicker/bootstrap-datepicker');?>
<?php echo $this->Html->script('inspinia/plugins/datapicker/bootstrap-datepicker.es');?>

<?php
    //Highcharts
    echo   $this->Html->script('highcharts/highcharts');
     echo   $this->Html->script('highcharts/modules/exporting');
     echo   $this->Html->script('highcharts/modules/offline-exporting');
      
 ?>
 
 
 
 <div class="wrapper wrapper-content animated fadeInRight">     
 
   <div class="ibox float-e-margins">                                                                                                                                                   
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Estadísticas</h2>       
                        </div>  
                          
                                         
                         
                         <div class="col-sm-12">   
                                                                                          
                             <?php
                                             echo $this->Form->create();                                
                                        ?>
                            <p>
                            <b>Periodo.</b>  <div class="input-daterange input-group" id="datepicker"><span class="input-group-addon" > De </span>
                                            <input id="SeguimientoInicio"  type="text" value="<?php echo $inicio ?>" class="input-sm form-control" name="data[Seguimiento][inicio]" />
                                            <span class="input-group-addon" > A </span>
                                            <input id="SeguimientoFin" type="text" value="<?php echo $fin ?>" class="input-sm form-control" name="data[Seguimiento][fin]" />
                                            <span class="input-group-btn">
                                            <button type="submit" class="btn btn-sm btn-primary" style="margin-bottom: 0px;"> Ver</button> 
                                            </span>
                                        </div>
                            </p>
                              <?php echo $this->Form->end();?>
                        </div>
                    </div> 
                </div>
        </div>
        
        
        
        <div class="ibox float-e-margins">                                                                                                                                                   
                <div class="ibox-content">  
                  <div class="row">                                                           
                    <div class="col-lg-12">
                            <h2>Incidencias por Usuario</h2>
                    </div>                      
                  </div>        
                                                                    
                  <div class="row">                                                           
                    <div class="col-lg-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="40%">Usuario</th>
                                        <th width="10%">Total</th>
                                        <th width="10%">Esfuerzo</th>
                                        <th width="10%">Esfuerzo Promedio</th>
                                        <th width="30%">Porcentaje</th>                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                         $totalIncidencias = 0;
                                         $totalEsfuerzo = 0;
                                         $totalEsfuerzoPromedio = 0;
                                         foreach ($serviciosUsuarios as $serviciosUsuarios2)
                                         {
                                            $totalIncidencias = $totalIncidencias + $serviciosUsuarios2->count; 
                                            $totalEsfuerzo = $totalEsfuerzo + $serviciosUsuarios2->esfuerzo;
                                            $totalEsfuerzoPromedio = $totalEsfuerzoPromedio + round($serviciosUsuarios2->esfuerzo/$serviciosUsuarios2->count);
                                         }
                                         
                                         ?>
                                   <?php foreach ($serviciosUsuarios as $serviciosUsuarios2): ?>
                                     <tr>
                                        <td><?php //echo $serviciosUsuarios2->co_user->co_user_id;  ?>
                                                <?php echo $this->Html->link(__($serviciosUsuarios2->co_user->nombre),array('controller'=>'servicios','action' => 'index',$inicio,$fin,1,$serviciosUsuarios2->co_user->co_user_id),array('class'=>'','escape'=>false)); ?>
                                        </td>
                                        <td><?php echo $serviciosUsuarios2->count;  ?></td>
                                        <td><?php echo $serviciosUsuarios2->esfuerzo;  ?></td>
                                        <td><?php echo round($serviciosUsuarios2->esfuerzo/$serviciosUsuarios2->count);  ?></td>
                                        <td>
                                              <h6><?php echo number_format(($serviciosUsuarios2->count * 100) / $totalIncidencias,2);?> %</h6>
                                              <div class="progress progress-mini">                                                
                                                <div style="width: <?php echo number_format(($serviciosUsuarios2->count * 100) / $totalIncidencias,2);?>%;" class="progress-bar"></div>
                                              </div>
  
                                        </td>                                     
                                    </tr>
                                   <?php endforeach; ?>
                                   
                                   <tr>
                                        <td>TOTALES</td>
                                        <td><?php echo $totalIncidencias;  ?></td>
                                        <td><?php echo $totalEsfuerzo;  ?></td>
                                        <td><?php echo $totalEsfuerzoPromedio;  ?></td>
                                        <td>
                                              <h6>100 %</h6>
                                              <div class="progress progress-mini">                                                
                                                <div style="width: 100%;" class="progress-bar"></div>
                                              </div>
  
                                        </td>                                     
                                    </tr>
                                   
                                </tbody>
                            </table>
                    </div>                      
                  </div>                                                    
                </div>              
        </div>  
 
                         <!--
    <div class="ibox float-e-margins">                                                                                                                                                   
                <div class="ibox-content">  
                  <div class="row">                                                           
                    <div class="col-lg-12">
                            <h2>Incidencias por Área</h2>
                    </div>                      
                  </div> 
                                                                    
                  <div class="row">                                                           
                     <div class="col-sm-12"> 
                    
                            <div id="estadisticas" style="min-width: 310px;"></div>
                    </div>                      
                  </div>                                                    
                </div>              
        </div>        -->
        
        
        <div class="ibox float-e-margins">                                                                                                                                                   
                <div class="ibox-content">  
                  <div class="row">                                                           
                    <div class="col-lg-12">
                            <h2>Incidencias por Área</h2>
                    </div>                      
                  </div> 
                                                                    
                  <div class="row">                                                           
                     <div class="col-sm-12"> 
                    
                            <div id="estadisticas2" style="min-width: 310px; height: 600px"></div>
                    </div>                      
                  </div>                                                    
                </div>              
        </div> 
 
     
        
        <div class="ibox float-e-margins">                                                                                                                                                   
                <div class="ibox-content">  
                  <div class="row">                                                           
                    <div class="col-lg-12">
                            <h2>Incidencias por Estatus</h2>
                    </div>                      
                  </div>        
                                                                    
                  <div class="row">                                                           
                    <div class="col-lg-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="50%">Estatus</th>
                                        <th width="20%">Total</th>
                                        <th width="30%">Porcentaje</th>                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                         $totalIncidencias = 0;
                                         foreach ($serviciosEstatus as $serviciosEstatus2)
                                            $totalIncidencias = $totalIncidencias + $serviciosEstatus2->count; ?>
                                   
                                   <?php foreach ($serviciosEstatus as $serviciosEstatus2): ?>
                                     <tr>
                                        <td><?php echo $serviciosEstatus2->status->descripcion;  ?></td>
                                        <td><?php echo $serviciosEstatus2->count;  ?></td>
                                        <td>
                                              <h6><?php echo number_format(($serviciosEstatus2->count * 100) / $totalIncidencias,2);?> %</h6>
                                              <div class="progress progress-mini">                                                
                                                <div style="width: <?php echo number_format(($serviciosEstatus2->count * 100) / $totalIncidencias,2);?>%;" class="progress-bar"></div>
                                              </div>
  
                                        </td>                                     
                                    </tr>
                                   <?php endforeach; ?>
                                   
                                   <tr>
                                        <td>TOTALES</td>
                                        <td><?php echo $totalIncidencias;  ?></td>
                                        <td>
                                              <h6>100 %</h6>
                                              <div class="progress progress-mini">                                                
                                                <div style="width: 100%;" class="progress-bar"></div>
                                              </div>
  
                                        </td>                                     
                                    </tr>
                                   
                                </tbody>
                            </table>
                    </div>                      
                  </div>                                                    
                </div>              
        </div>   
        
        
        <div class="ibox float-e-margins">                                                                                                                                                   
                <div class="ibox-content">  
                  <div class="row">                                                           
                    <div class="col-lg-12">
                            <h2>Incidencias por Tipo de Servicio</h2>
                    </div>                      
                  </div>        
                                                                    
                  <div class="row">                                                           
                    <div class="col-lg-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="20%">Grupo</th>
                                        <th width="30%">Tipo Servicio</th>
                                        <th width="10%">Total</th>
                                        <th width="10%">Esfuerzo</th>
                                        <th width="10%">Esfuerzo Promedio</th>
                                        <th width="20%">Porcentaje</th>                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                         $totalIncidencias = 0;
                                         $totalEsfuerzo = 0;
                                         $totalEsfuerzoPromedio = 0;
                                         foreach ($serviciosTipo as $serviciosTipo2)
                                         {
                                            $totalIncidencias = $totalIncidencias + $serviciosTipo2->count; 
                                            $totalEsfuerzo = $totalEsfuerzo + $serviciosTipo2->esfuerzo;
                                            $totalEsfuerzoPromedio = $totalEsfuerzoPromedio + round($serviciosTipo2->esfuerzo/$serviciosTipo2->count);
                                         }  
                                            ?>
                                   
                                   <?php foreach ($serviciosTipo as $serviciosTipo2): ?>
                                     <tr>
                                        <td><?php echo $serviciosTipo2->tipo_servicio->grupo->descripcion;  ?></td>
                                        <td><?php //echo $serviciosTipo2->tipo_servicio->tipo_servicio_id;  ?>
                                            <?php echo $this->Html->link(__($serviciosTipo2->tipo_servicio->descripcion),array('controller'=>'servicios','action' => 'index',$inicio,$fin,2,$serviciosTipo2->tipo_servicio->tipo_servicio_id),array('class'=>'','escape'=>false)); ?>
                                        </td>
                                        <td><?php echo $serviciosTipo2->count;  ?></td>
                                        <td><?php echo $serviciosTipo2->esfuerzo;  ?></td>
                                        <td><?php echo round($serviciosTipo2->esfuerzo/$serviciosTipo2->count);  ?></td>
                                        <td>
                                              <h6><?php echo number_format(($serviciosTipo2->count * 100) / $totalIncidencias,2);?> %</h6>
                                              <div class="progress progress-mini">                                                
                                                <div style="width: <?php echo number_format(($serviciosTipo2->count * 100) / $totalIncidencias,2);?>%;" class="progress-bar"></div>
                                              </div>
  
                                        </td>                                     
                                    </tr>
                                   <?php endforeach; ?>
                                   
                                   <tr>
                                        <td colspan="2">TOTALES</td>
                                        <td><?php echo $totalIncidencias;  ?></td>
                                        <td><?php echo $totalEsfuerzo;  ?></td>
                                        <td><?php echo $totalEsfuerzoPromedio;  ?></td>
                                        <td>
                                              <h6>100 %</h6>
                                              <div class="progress progress-mini">                                                
                                                <div style="width: 100%;" class="progress-bar"></div>
                                              </div>
  
                                        </td>                                     
                                    </tr>
                                   
                                </tbody>
                            </table>
                    </div>                      
                  </div>                                                    
                </div>              
        </div>  
       
       
        
        <div class="ibox float-e-margins">                                                                                                                                                   
                <div class="ibox-content">  
                  <div class="row">                                                           
                    <div class="col-lg-12">
                            <h2>Incidencias por Grupo</h2>
                    </div>                      
                  </div>        
                                                                    
                  <div class="row">                                                           
                    <div class="col-lg-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="40%">Grupo</th>
                                        <th width="10%">Total</th>
                                        <th width="10%">Esfuerzo</th>
                                        <th width="10%">Esfuerzo Promedio</th>
                                        <th width="30%">Porcentaje</th>                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                         $totalIncidencias = 0;
                                         $totalEsfuerzo = 0;
                                         $totalEsfuerzoPromedio = 0;
                                         foreach ($serviciosTipoGrupo as $serviciosTipo2)
                                         {
                                            $totalIncidencias = $totalIncidencias + $serviciosTipo2->count; 
                                            $totalEsfuerzo = $totalEsfuerzo + $serviciosTipo2->esfuerzo;
                                            $totalEsfuerzoPromedio = $totalEsfuerzoPromedio + round($serviciosTipo2->esfuerzo/$serviciosTipo2->count);
                                         }  
                                            ?>
                                   
                                   <?php foreach ($serviciosTipoGrupo as $serviciosTipo2): ?>
                                     <tr>
                                        <td><?php echo $serviciosTipo2->tipo_servicio->grupo->descripcion;  ?></td>
                                        <td><?php echo $serviciosTipo2->count;  ?></td>
                                        <td><?php echo $serviciosTipo2->esfuerzo;  ?></td>
                                        <td><?php echo round($serviciosTipo2->esfuerzo/$serviciosTipo2->count);  ?></td>
                                        <td>
                                              <h6><?php echo number_format(($serviciosTipo2->count * 100) / $totalIncidencias,2);?> %</h6>
                                              <div class="progress progress-mini">                                                
                                                <div style="width: <?php echo number_format(($serviciosTipo2->count * 100) / $totalIncidencias,2);?>%;" class="progress-bar"></div>
                                              </div>
  
                                        </td>                                     
                                    </tr>
                                   <?php endforeach; ?>
                                   
                                   <tr>
                                        <td>TOTALES</td>
                                        <td><?php echo $totalIncidencias;  ?></td>
                                        <td><?php echo $totalEsfuerzo;  ?></td>
                                        <td><?php echo $totalEsfuerzoPromedio;  ?></td>
                                        <td>
                                              <h6>100 %</h6>
                                              <div class="progress progress-mini">                                                
                                                <div style="width: 100%;" class="progress-bar"></div>
                                              </div>
  
                                        </td>                                     
                                    </tr>
                                   
                                </tbody>
                            </table>
                    </div>                      
                  </div>                                                    
                </div>              
        </div>   
        
</div>    


<script>
 

           
  // setMarkersMap(dataMap);
 $(document).ready(function () {
     $('.input-daterange').datepicker({
         language: 'es'
    });
    
          
 });    

 

Highcharts.setOptions({
    colors: ['#FAE400', '#4C9C40', '#8DB235', '#534534', '#706B67', '#459CC1', '#6EB1B8']
});


         /*
// Build the chart
Highcharts.chart('estadisticas', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Incidencias por Área'
    },
    credits: 
    {
        enabled: false
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true
            },
            showInLegend: false
        }
    },
    series: [{
        name: 'Servicios',
        colorByPoint: true,
        data: [
        <?php foreach($serviciosArea as $serviciosArea2): ?>
            {
                name: '<?php echo $serviciosArea2->cat_adscripcione->nom_ads; ?>',
                y: <?php echo $serviciosArea2->count; ?>,
                dataLabels: {
                    enabled: true,
                    format: '<?php echo $serviciosArea2->cat_adscripcione->nom_ads; ?> {y:,1f}'
                } 
            }, 
        
        <?php endforeach; ?>
        ]
    }]
});              */

Highcharts.chart('estadisticas2', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Servicios por Área'
    },
    credits: 
    {
        enabled: false
    },
    xAxis: {
        type: 'category',
        labels: {
            //rotation: -45,
            style: {
                fontSize: '10px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Número de Servicios'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Servicios: <b>{point.y}</b>'
    },
    series: [{
        name: 'Population',
        colorByPoint: true,
        data: [
            <?php foreach($serviciosArea as $serviciosArea2): ?>
            ['<?php echo $serviciosArea2->cat_adscripcione->nom_ads; ?>',<?php echo $serviciosArea2->count; ?>], 
        
        <?php endforeach; ?>
           
        ],
        dataLabels: {
            enabled: true,
            //rotation: -90,
            //color: '#FFFFFF',
            align: 'right',
            //format: '{point.y:.1f}', // one decimal
            x: 20, // 10 pixels down from the top
            style: {
                fontSize: '10px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
          
 
</script>   