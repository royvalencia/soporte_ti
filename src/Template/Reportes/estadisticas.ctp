<?php echo $this->Html->css('inspinia/plugins/datapicker/datepicker3'); ?>
<?php echo $this->Html->script('inspinia/plugins/datapicker/bootstrap-datepicker');?>
<?php echo $this->Html->script('inspinia/plugins/datapicker/bootstrap-datepicker.es');?>


 
<?php
    //Highcharts
    echo   $this->Html->script('highcharts/highcharts');
     echo   $this->Html->script('highcharts/modules/exporting');
     echo   $this->Html->script('highcharts/modules/offline-exporting');

     
 
 ?>

<div class="row wrapper border-bottom white-bg page-heading">
   
    <div class="row">
                    <div class="col-sm-12">
                        <h2>Estadísticasssssss</h2>       
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

<div class="wrapper wrapper-content"> 
          
        
        
        
        
        
        
 
        <div class="ibox float-e-margins">
                
                
                        
                
           
                   
          
                      
             
                <div class="ibox-content">
                  
                  
                  
                  <div class="row">                                                           
                    <div class="col-lg-12">
                            <div id="estadisticas" style="min-width: 310px; height: 400px; max-width: 700px; margin: 0 auto"></div>
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
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [
        <?php foreach($serviciosArea as $serviciosArea2): ?>
            {
                name: '<?php echo $serviciosArea2->nom_ads; ?>',
                y: <?php echo $serviciosArea2->count; ?>
            }, 
        
        <?php endforeach; ?>
        ]
    }]
});
   
 
</script>    
