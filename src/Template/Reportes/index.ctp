 <?php echo $this->Html->css('inspinia/plugins/datapicker/datepicker3'); ?>
 <?php echo $this->Html->script('inspinia/plugins/datapicker/bootstrap-datepicker'); ?>
 <?php echo $this->Html->script('inspinia/plugins/datapicker/bootstrap-datepicker.es'); ?>

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
           <h2>Servicios por Agente</h2>
         </div>
       </div>

       <div class="row">
         <div class="col-lg-12">
           <table class="table table-striped">
             <thead>
               <tr>
                 <th width="40%">Usuario</th>
                 <th width="10%">Total</th>
                 <th width="10%">Finalizados</th>
                 <th width="40%">Porcentaje</th>
               </tr>
             </thead>
             <tbody>
               <?php
                $totalIncidencias = 0;
                
                foreach ($serviciosUsuarios as $serviciosUsuarios2) {
                  ?>
                  <pre>
  <?php
  echo $serviciosUsuarios2;
  ?>
</pre>
<?php
                  $totalIncidencias = $totalIncidencias + $serviciosUsuarios2->count;
                }

                ?>
               <?php foreach ($serviciosUsuarios as $serviciosUsuarios2): ?>
                 <tr>
                   <td>
                     <?php 
                     echo $serviciosUsuarios2->co_user['nombre'];
                     //echo $this->Html->link(__($serviciosUsuarios2->co_user['nombre']), array('controller' => 'servicios', 'action' => 'index', $inicio, $fin, 1, $serviciosUsuarios2->co_user['co_user_id']), array('class' => '', 'escape' => false));  
                     ?>
                   </td>
                   <td><?php echo $serviciosUsuarios2['count'];  ?></td>
                   <td>
                     <h6><?php //echo number_format(($serviciosUsuarios2->count * 100) / $totalIncidencias, 2); ?> %</h6>
                     <div class="progress progress-mini">
                       <div style="width: <?php //echo number_format(($serviciosUsuarios2->count * 100) / $totalIncidencias, 2); ?>%;" class="progress-bar"></div>
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