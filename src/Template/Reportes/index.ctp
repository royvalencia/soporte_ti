 <?php echo $this->Html->css('inspinia/plugins/datapicker/datepicker3'); ?>
 <?php echo $this->Html->script('inspinia/plugins/datapicker/bootstrap-datepicker'); ?>
 <?php echo $this->Html->script('inspinia/plugins/datapicker/bootstrap-datepicker.es'); ?>

 <?php
  //Highcharts
  echo   $this->Html->script('highcharts/highcharts');
  echo   $this->Html->script('highcharts/modules/exporting');
  echo   $this->Html->script('highcharts/modules/offline-exporting');



  use Cake\I18n\FrozenTime;
  ?>




 <div class="wrapper wrapper-content animated fadeInRight">

   <div class="ibox float-e-margins">
     <div class="ibox-content">
       <div class="row">
         <div class="col-sm-12">
           <h2>Estadísticas</h2>
         </div>




       </div>
     </div>
   </div>



   <div class="ibox float-e-margins">
     <div class="ibox-content">
       <?php foreach ($serviciosTotal as $serviciosUsuarios2) { ?>
         <div class="row">
           <div class="col-sm-3">
            <div class="widget style1">
                        <div class="row">
                            <div class="col-xs-4 text-center">
                                <i class="fa fa-trophy fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span> Total Tickets </span>
                                <h2 class="font-bold"><?php echo $serviciosUsuarios2->count; ?></h2>
                            </div>
                        </div>
                </div>
             
           </div>
           <div class="col-sm-3">
            <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-folder-open fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Abiertos</span>
                            <h2 class="font-bold"><?php echo $serviciosUsuarios2->abiertos; ?></h2>
                        </div>
                    </div>
                </div>
             
           </div>
           <div class="col-sm-3">
            <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-folder fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Finalizados </span>
                            <h2 class="font-bold"><?php echo $serviciosUsuarios2->finalizados; ?></h2>
                        </div>
                    </div>
                </div>
             
           </div>
           <div class="col-sm-3">
            <div class="widget style1 yellow-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-star fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Porcentaje </span>
                            <h2 class="font-bold"> <?php echo round($serviciosUsuarios2->eficacia)."%"; ?></h2>
                        </div>
                    </div>
                </div>
             
           </div>
         </div>
       <?php

        }

        ?>

     </div>
   </div>




   <div class="ibox float-e-margins">
     <div class="ibox-content">
       <div class="row">
         <div class="col-lg-12">
           <h2>Top 10 Tickets Sin Asignar</h2>
         </div>
       </div>

       <div class="row">
         <div class="col-lg-12">
           <table class="table table-striped">
             <thead>
               <tr>
                 <th width="10%">Pos</th>
                 <th width="20%">Ticket</th>
                 <th width="40%">Tiempo</th>
                 <th width="30%">Area</th>
               </tr>
             </thead>
             <tbody>
               <?php

             

                foreach ($serviciosSinasignar as $serviciosUsuarios2) {
                ?>

               <?php

                }
                $pos =  1;
                ?>
               <?php foreach ($serviciosSinasignar as $serviciosUsuarios2): ?>

                 <tr>

                   <td><?php echo $pos; ?></td>
                   <td>
                   <?= h(strtoupper($serviciosUsuarios2->servicio_id)) ? $this->Html->link(strtoupper($serviciosUsuarios2->servicio_id), ['controller' => 'Servicios', 'action' => 'view', $serviciosUsuarios2->servicio_id]) : '' ?> 
                   </td>
                   <td><?php
                        $ahora = FrozenTime::now();
                        $diferencia = $serviciosUsuarios2->created->diff($ahora);

                        if ($diferencia->days > 0) {
                          $tiempo_transcurrido = "{$diferencia->days} días";
                        } elseif ($diferencia->h > 0) {
                          $tiempo_transcurrido = "{$diferencia->h} horas";
                        } else {
                          $tiempo_transcurrido = "{$diferencia->i} minutos";
                        }
                        echo $tiempo_transcurrido;

                        ?></td>
                   <td>
                     <?php
                      if ($serviciosUsuarios2->agente == 4) {
                        echo "Sistemas";
                      } elseif ($serviciosUsuarios2->agente == 12) {
                        echo "Técnica";
                      } elseif ($serviciosUsuarios2->agente == 243) {
                        echo "Servicios Tecnológicos";
                      }
                      ?>
                   </td>

                 </tr>
               <?php
                  $pos++;
                endforeach; ?>



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
           <h2>Top 10 Tickets Sin Seguimiento</h2>
         </div>
       </div>

       <div class="row">
         <div class="col-lg-12">
           <table class="table table-striped">
             <thead>
               <tr>
                 <th width="10%">Pos</th>
                 <th width="20%">Ticket</th>
                 <th width="40%">Tiempo</th>
                 <th width="30%">Area</th>
               </tr>
             </thead>
             <tbody>
               <?php


                foreach ($serviciosSinatender as $serviciosUsuarios2) {
                ?>

               <?php

                }
                $pos =  1;
                ?>
               <?php foreach ($serviciosSinatender as $serviciosUsuarios2): ?>

                 <tr>

                   <td><?php echo $pos; ?></td>
                   <td><?= h(strtoupper($serviciosUsuarios2->servicio_id)) ? $this->Html->link(strtoupper($serviciosUsuarios2->servicio_id), ['controller' => 'Servicios', 'action' => 'view', $serviciosUsuarios2->servicio_id]) : '' ?> </td>
                   <td><?php
                        $ahora = FrozenTime::now();
                        $diferencia = $serviciosUsuarios2->fecha_creacion->diff($ahora);

                        if ($diferencia->days > 0) {
                          $tiempo_transcurrido = "{$diferencia->days} días";
                        } elseif ($diferencia->h > 0) {
                          $tiempo_transcurrido = "{$diferencia->h} horas";
                        } else {
                          $tiempo_transcurrido = "{$diferencia->i} minutos";
                        }
                        echo $tiempo_transcurrido;

                        ?></td>
                   <td>
                     <?php
                      if ($serviciosUsuarios2->co_group_id == 4) {
                        echo "Sistemas";
                      } elseif ($serviciosUsuarios2->co_group_id == 3) {
                        echo "Técnica";
                      } elseif ($serviciosUsuarios2->co_group_id == 6) {
                        echo "Servicios Tecnológicos";
                      } elseif ($serviciosUsuarios2->co_group_id == 5) {
                        echo "Funciones Administrativas";
                      }
                      ?>
                   </td>

                 </tr>
               <?php
                  $pos++;
                endforeach; ?>



             </tbody>
           </table>
         </div>
       </div>
     </div>
   </div>








   <div class="ibox float-e-margins">
     <div class="ibox-content">
       <div class="row">




         <div class="col-sm-12">

           <?php
            echo $this->Form->create();
            ?>
           <p>
             <b>Periodo.</b>
           <div class="input-daterange input-group" id="datepicker"><span class="input-group-addon"> De </span>
             <input id="SeguimientoInicio" type="text" value="<?php echo $inicio ?>" class="input-sm form-control" name="data[Seguimiento][inicio]" />
             <span class="input-group-addon"> A </span>
             <input id="SeguimientoFin" type="text" value="<?php echo $fin ?>" class="input-sm form-control" name="data[Seguimiento][fin]" />
             <span class="input-group-btn">
               <button type="submit" class="btn btn-sm btn-primary" style="margin-bottom: 0px;"> Ver</button>
             </span>
           </div>
           </p>
           <?php echo $this->Form->end(); ?>
         </div>
       </div>
     </div>
   </div>





   <div class="ibox float-e-margins">
     <div class="ibox-content">
       <div class="row">
         <div class="col-lg-12">
           <h2>Módulos OperGob</h2>
         </div>
       </div>

       <div class="row">
         <div class="col-lg-12">
           <table class="table table-striped">
             <thead>
               <tr>
                 <th width="40%">Módulo</th>
                 <th width="10%">Abiertos</th>
                 <th width="10%">Finalizados</th>
                 <th width="10%">Total</th>
                 <th width="30%">Indice Total Finalizados</th>
               </tr>
             </thead>
             <tbody>
               <?php
                $totalabiertos = 0;
                $totalfinalizados = 0;
                $totalIncidencias = 0;

                foreach ($serviciosModulos as $serviciosUsuarios2) {
                ?>

               <?php
                  $totalabiertos = $totalabiertos + $serviciosUsuarios2->abiertos;
                  $totalfinalizados = $totalfinalizados + $serviciosUsuarios2->finalizados;
                  $totalIncidencias = $totalIncidencias + $serviciosUsuarios2->count;
                }

                ?>
               <?php foreach ($serviciosModulos as $serviciosUsuarios2): ?>

                 <tr>
                   <td>
                     <?php
                      echo $serviciosUsuarios2->Grupos['descripcion'];
                      //echo $this->Html->link(__($serviciosUsuarios2->co_user['nombre']), array('controller' => 'servicios', 'action' => 'index', $inicio, $fin, 1, $serviciosUsuarios2->co_user['co_user_id']), array('class' => '', 'escape' => false));  
                      ?>
                   </td>
                   <td><?php echo $serviciosUsuarios2['abiertos'];  ?></td>
                   <td><?php echo $serviciosUsuarios2['finalizados'];  ?></td>
                   <td><?php echo $serviciosUsuarios2['count'];  ?></td>
                   <td>
                     <h6><?php echo number_format($serviciosUsuarios2['eficacia'], 2); ?> %</h6>
                     <div class="progress progress-mini">
                       <div style="width: <?php echo number_format($serviciosUsuarios2['eficacia'], 2); ?>%;" class="progress-bar"></div>
                     </div>

                   </td>
                 </tr>
               <?php endforeach; ?>

               <tr>
                 <td>TOTALES</td>
                 <td><?php echo $totalabiertos;  ?></td>
                 <td><?php echo $totalfinalizados;  ?></td>
                 <td><?php echo $totalIncidencias;  ?></td>
                 <td>
                   <h6><?php echo number_format($totalfinalizados * 100 / $totalIncidencias, 2); ?> %</h6>
                   <div class="progress progress-mini">
                     <div style="width: <?php echo number_format($totalfinalizados * 100 / $totalIncidencias, 2); ?>%;" class="progress-bar"></div>
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
           <h2>Agentes Dirección de Sistemas</h2>
         </div>
       </div>

       <div class="row">
         <div class="col-lg-12">
           <table class="table table-striped">
             <thead>
               <tr>
                 <th width="40%">Usuario</th>
                 <th width="10%">Abiertos</th>
                 <th width="10%">Finalizados</th>
                 <th width="10%">Total</th>
                 <th width="30%">Indice Total Finalizados</th>
               </tr>
             </thead>
             <tbody>
               <?php
                $totalabiertos = 0;
                $totalfinalizados = 0;
                $totalIncidencias = 0;

                foreach ($serviciosUsuariosDSI as $serviciosUsuarios2) {
                ?>

               <?php
                  $totalabiertos = $totalabiertos + $serviciosUsuarios2->abiertos;
                  $totalfinalizados = $totalfinalizados + $serviciosUsuarios2->finalizados;
                  $totalIncidencias = $totalIncidencias + $serviciosUsuarios2->count;
                }

                ?>
               <?php foreach ($serviciosUsuariosDSI as $serviciosUsuarios2): ?>

                 <tr>
                   <td>
                     <?php
                      echo $serviciosUsuarios2->CoUsers['nombre'];
                      //echo $this->Html->link(__($serviciosUsuarios2->co_user['nombre']), array('controller' => 'servicios', 'action' => 'index', $inicio, $fin, 1, $serviciosUsuarios2->co_user['co_user_id']), array('class' => '', 'escape' => false));  
                      ?>
                   </td>
                   <td><?php echo $serviciosUsuarios2['abiertos'];  ?></td>
                   <td><?php echo $serviciosUsuarios2['finalizados'];  ?></td>
                   <td><?php echo $serviciosUsuarios2['count'];  ?></td>
                   <td>
                     <h6><?php echo number_format($serviciosUsuarios2['eficacia'], 2); ?> %</h6>
                     <div class="progress progress-mini">
                       <div style="width: <?php echo number_format($serviciosUsuarios2['eficacia'], 2); ?>%;" class="progress-bar"></div>
                     </div>

                   </td>
                 </tr>
               <?php endforeach; ?>

               <tr>
                 <td>TOTALES</td>
                 <td><?php echo $totalabiertos;  ?></td>
                 <td><?php echo $totalfinalizados;  ?></td>
                 <td><?php echo $totalIncidencias;  ?></td>
                 <td>
                   <h6><?php echo number_format($totalfinalizados * 100 / $totalIncidencias, 2); ?> %</h6>
                   <div class="progress progress-mini">
                     <div style="width: <?php echo number_format($totalfinalizados * 100 / $totalIncidencias, 2); ?>%;" class="progress-bar"></div>
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
           <h2>Agentes Dirección Técnica</h2>
         </div>
       </div>

       <div class="row">
         <div class="col-lg-12">
           <table class="table table-striped">
             <thead>
               <tr>
                 <th width="40%">Usuario</th>
                 <th width="10%">Abiertos</th>
                 <th width="10%">Finalizados</th>
                 <th width="10%">Total</th>
                 <th width="30%">Indice Total Finalizados</th>
               </tr>
             </thead>
             <tbody>
               <?php
                $totalabiertos = 0;
                $totalfinalizados = 0;
                $totalIncidencias = 0;

                foreach ($serviciosUsuariosDTI as $serviciosUsuarios2) {
                ?>

               <?php
                  $totalabiertos = $totalabiertos + $serviciosUsuarios2->abiertos;
                  $totalfinalizados = $totalfinalizados + $serviciosUsuarios2->finalizados;
                  $totalIncidencias = $totalIncidencias + $serviciosUsuarios2->count;
                }

                ?>
               <?php foreach ($serviciosUsuariosDTI as $serviciosUsuarios2): ?>

                 <tr>
                   <td>
                     <?php
                      echo $serviciosUsuarios2->CoUsers['nombre'];
                      //echo $this->Html->link(__($serviciosUsuarios2->co_user['nombre']), array('controller' => 'servicios', 'action' => 'index', $inicio, $fin, 1, $serviciosUsuarios2->co_user['co_user_id']), array('class' => '', 'escape' => false));  
                      ?>
                   </td>
                   <td><?php echo $serviciosUsuarios2['abiertos'];  ?></td>
                   <td><?php echo $serviciosUsuarios2['finalizados'];  ?></td>
                   <td><?php echo $serviciosUsuarios2['count'];  ?></td>
                   <td>
                     <h6><?php echo number_format($serviciosUsuarios2['eficacia'], 2); ?> %</h6>
                     <div class="progress progress-mini">
                       <div style="width: <?php echo number_format($serviciosUsuarios2['eficacia'], 2); ?>%;" class="progress-bar"></div>
                     </div>

                   </td>
                 </tr>
               <?php endforeach; ?>

               <tr>
                 <td>TOTALES</td>
                 <td><?php echo $totalabiertos;  ?></td>
                 <td><?php echo $totalfinalizados;  ?></td>
                 <td><?php echo $totalIncidencias;  ?></td>
                 <td>
                   <h6><?php echo number_format($totalfinalizados * 100 / $totalIncidencias, 2); ?> %</h6>
                   <div class="progress progress-mini">
                     <div style="width: <?php echo number_format($totalfinalizados * 100 / $totalIncidencias, 2); ?>%;" class="progress-bar"></div>
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
           <h2>Agentes Dirección de Servicios Tecnológicos</h2>
         </div>
       </div>

       <div class="row">
         <div class="col-lg-12">
           <table class="table table-striped">
             <thead>
               <tr>
                 <th width="40%">Usuario</th>
                 <th width="10%">Abiertos</th>
                 <th width="10%">Finalizados</th>
                 <th width="10%">Total</th>
                 <th width="30%">Indice Total Finalizados</th>
               </tr>
             </thead>
             <tbody>
               <?php
                $totalabiertos = 0;
                $totalfinalizados = 0;
                $totalIncidencias = 0;

                foreach ($serviciosUsuariosDST as $serviciosUsuarios2) {
                ?>

               <?php
                  $totalabiertos = $totalabiertos + $serviciosUsuarios2->abiertos;
                  $totalfinalizados = $totalfinalizados + $serviciosUsuarios2->finalizados;
                  $totalIncidencias = $totalIncidencias + $serviciosUsuarios2->count;
                }

                ?>
               <?php foreach ($serviciosUsuariosDST as $serviciosUsuarios2): ?>

                 <tr>
                   <td>
                     <?php
                      echo $serviciosUsuarios2->CoUsers['nombre'];
                      //echo $this->Html->link(__($serviciosUsuarios2->co_user['nombre']), array('controller' => 'servicios', 'action' => 'index', $inicio, $fin, 1, $serviciosUsuarios2->co_user['co_user_id']), array('class' => '', 'escape' => false));  
                      ?>
                   </td>
                   <td><?php echo $serviciosUsuarios2['abiertos'];  ?></td>
                   <td><?php echo $serviciosUsuarios2['finalizados'];  ?></td>
                   <td><?php echo $serviciosUsuarios2['count'];  ?></td>
                   <td>
                     <h6><?php echo number_format($serviciosUsuarios2['eficacia'], 2); ?> %</h6>
                     <div class="progress progress-mini">
                       <div style="width: <?php echo number_format($serviciosUsuarios2['eficacia'], 2); ?>%;" class="progress-bar"></div>
                     </div>

                   </td>
                 </tr>
               <?php endforeach; ?>

               <tr>
                 <td>TOTALES</td>
                 <td><?php echo $totalabiertos;  ?></td>
                 <td><?php echo $totalfinalizados;  ?></td>
                 <td><?php echo $totalIncidencias;  ?></td>
                 <td>
                   <h6><?php echo number_format($totalfinalizados * 100 / $totalIncidencias, 2); ?> %</h6>
                   <div class="progress progress-mini">
                     <div style="width: <?php echo number_format($totalfinalizados * 100 / $totalIncidencias, 2); ?>%;" class="progress-bar"></div>
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
           <h2>Agentes Funciones Administrativas</h2>
         </div>
       </div>

       <div class="row">
         <div class="col-lg-12">
           <table class="table table-striped">
             <thead>
               <tr>
                 <th width="40%">Usuario</th>
                 <th width="10%">Abiertos</th>
                 <th width="10%">Finalizados</th>
                 <th width="10%">Total</th>
                 <th width="30%">Indice Total Finalizados</th>
               </tr>
             </thead>
             <tbody>
               <?php
                $totalabiertos = 0;
                $totalfinalizados = 0;
                $totalIncidencias = 0;

                foreach ($serviciosUsuariosADM as $serviciosUsuarios2) {
                ?>

               <?php
                  $totalabiertos = $totalabiertos + $serviciosUsuarios2->abiertos;
                  $totalfinalizados = $totalfinalizados + $serviciosUsuarios2->finalizados;
                  $totalIncidencias = $totalIncidencias + $serviciosUsuarios2->count;
                }

                ?>
               <?php foreach ($serviciosUsuariosADM as $serviciosUsuarios2): ?>

                 <tr>
                   <td>
                     <?php
                      echo $serviciosUsuarios2->CoUsers['nombre'];
                      //echo $this->Html->link(__($serviciosUsuarios2->co_user['nombre']), array('controller' => 'servicios', 'action' => 'index', $inicio, $fin, 1, $serviciosUsuarios2->co_user['co_user_id']), array('class' => '', 'escape' => false));  
                      ?>
                   </td>
                   <td><?php echo $serviciosUsuarios2['abiertos'];  ?></td>
                   <td><?php echo $serviciosUsuarios2['finalizados'];  ?></td>
                   <td><?php echo $serviciosUsuarios2['count'];  ?></td>
                   <td>
                     <h6><?php echo number_format($serviciosUsuarios2['eficacia'], 2); ?> %</h6>
                     <div class="progress progress-mini">
                       <div style="width: <?php echo number_format($serviciosUsuarios2['eficacia'], 2); ?>%;" class="progress-bar"></div>
                     </div>

                   </td>
                 </tr>
               <?php endforeach; ?>

               <tr>
                 <td>TOTALES</td>
                 <td><?php echo $totalabiertos;  ?></td>
                 <td><?php echo $totalfinalizados;  ?></td>
                 <td><?php echo $totalIncidencias;  ?></td>
                 <td>
                   <h6><?php echo number_format($totalfinalizados * 100 / $totalIncidencias, 2); ?> %</h6>
                   <div class="progress progress-mini">
                     <div style="width: <?php echo number_format($totalfinalizados * 100 / $totalIncidencias, 2); ?>%;" class="progress-bar"></div>
                   </div>

                 </td>


               </tr>

             </tbody>
           </table>
         </div>
       </div>
     </div>
   </div>


















   <script>
     // setMarkersMap(dataMap);
     $(document).ready(function() {
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
        <?php foreach ($serviciosArea as $serviciosArea2): ?>
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
       credits: {
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
           <?php foreach ($serviciosArea as $serviciosArea2): ?>['<?php echo $serviciosArea2->cat_adscripcione->nom_ads; ?>', <?php echo $serviciosArea2->count; ?>],

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