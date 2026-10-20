
<?php
    //Highcharts
   /*
    echo   $this->Html->script('highcharts/highcharts',false);
     echo   $this->Html->script('highcharts/modules/exporting',false);
     echo   $this->Html->script('highcharts/modules/offline-exporting',false);
     */
    echo $this->Html->css('inspinia/plugins/datapicker/datepicker3');
   echo $this->Html->script('inspinia/plugins/datapicker/bootstrap-datepicker',array('inline' => true));
  echo $this->Html->script('inspinia/plugins/datapicker/bootstrap-datepicker.es',array('inline' => true)); 
  echo $this->Html->script('inspinia/plugins/number/jquery.number.min', array('inline' => true));
   echo $this->Html->css('inspinia/plugins/dataTables/datatables.min');
   echo $this->Html->script('inspinia/plugins/dataTables/datatables.min', array('inline' => true));

  echo $this->Html->script('highcharts/highcharts',array('inline' => true)); 
  echo $this->Html->script('highcharts/modules/exporting',array('inline' => true)); 
  echo $this->Html->script('highcharts/modules/offline-exporting',array('inline' => true)); 
 ?>
 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Tablero de Control') ?> </h2> 

    </div>
    <div class="col-lg-2" >
     <small class="text-muted"><?= $lastUpdateTime; ?></small>
     </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight contentloading">     

    <div class="row">
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">                              
                                <h5>Total Estructura</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 id="totalActivistas" class="no-margins dashboard" ></h1>                               
                                <small>Total Estatal con Sección de Votación</small>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">                                
                                <h5>Total Promovidos</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 id="totalPromovidos" class="no-margins dashboard"></h1>
                                
                                <small>Total Estatal</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">                               
                                <h5>Estructura + Promovidos</h5>
                            </div>

                            <div class="ibox-content">
                                <h1 id="activistasPromovidos" class="no-margins dashboard"></h1>                                
                                <div id="porcentajeMeta" class="stat-percent font-bold text-navy" title="Porcentaje meta">0%</div>
                                <small id="metaPromocion">Meta de Promoción Estatal: </small>
                            </div>
                        </div>
                    </div>
                   
                   
        </div>
   <div class="row">
            <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">                              
                                <h5>Estructura Por Municipio</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">                
                                    <div class="col-sm-12">
                                        <div class="input-group pull-right">
                                            <a href="javascript:exportXls(urlestructuraMunicipal);" type="button" class="btn btn-sm btn-default">xls </a> 
                                        </div>
                                    </div>
                                </div>
                                <div id="estructuraMunicipalDiv" style="min-width: 310px; min-height: 300px; margin: 0 auto"></div>                              
                              
                            </div>
                        </div>
                    </div>
            <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">                              
                                <h5>Promoción por Municipio</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">                
                                    <div class="col-sm-12">
                                        <div class="input-group pull-right">
                                            <a href="javascript:prevExportXls(urlPromocion,'municipio');" type="button" class="btn btn-sm btn-default">xls </a> 
                                        </div>
                                    </div>
                                </div>
                                <div id="promocion-municipio" style="min-width: 310px; min-height: 300px; margin: 0 auto"></div>                            
                               
                            </div>
                        </div>
                    </div>        
   </div>
 
    <div class="row">
            <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">                              
                                <h5>Promoción Distritos Federales</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">                
                                    <div class="col-sm-12">
                                        <div class="input-group pull-right">
                                            <a href="javascript:prevExportXls(urlPromocion,'dfederal');" type="button" class="btn btn-sm btn-default">xls </a> 
                                        </div>
                                    </div>
                                </div>
                                <div id="promocion-dfederal" style="min-width: 310px; min-height: 300px; margin: 0 auto"></div>                            
                               
                            </div>
                        </div>
                    </div>
            <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">                              
                                <h5>Promoción Distritos Locales</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">                
                                    <div class="col-sm-12">
                                        <div class="input-group pull-right">
                                            <a href="javascript:prevExportXls(urlPromocion,'dlocal');" type="button" class="btn btn-sm btn-default">xls </a> 
                                        </div>
                                    </div>
                                </div>
                                <div id="promocion-dlocal" style="min-width: 310px; min-height: 300px; margin: 0 auto"></div>                            
                               
                            </div>
                        </div>
                    </div>        
   </div>  
    <div class="row">
            <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">                              
                                <h5>Secciones</h5>
                               
                            </div>
                            <div class="ibox-content">
                                <div class="row">                
                                    <div class="col-sm-12">
                                        <div class="input-group pull-right">
                                            <a href="javascript:exportXls(urlSecciones);" type="button" class="btn btn-sm btn-default">xls </a> 
                                        </div>
                                    </div>
                                </div>
                                <div id="promocion-secciones" style="min-width: 310px; min-height: 300px; margin: 0 auto"></div>                              
                              
                            </div>
                        </div>
                    </div>
           
    </div>   
    
    
   <div id="divLoading"> 
    </div>          
</div>    
<script type="text/javascript">
  
   $(document).ready(function () {
     $('.input-daterange').datepicker({
         language: 'es'
    });
    
   
 });
</script>
<?php 
echo $this->Html->script('dashboards.js');
?>
<script type="text/javascript">

 
  var urlResumen ='<?php echo $this->Url->build(array('controller' => 'dashboards', 'action' => 'resumen')); ?>'; 
  
  var urlestructuraMunicipal ='<?php echo $this->Url->build(array('controller' => 'dashboards', 'action' => 'estructura-municipal')); ?>';

   var urlPromocion ='<?php echo $this->Url->build(array('controller' => 'dashboards', 'action' => 'promocion')); ?>';

    var urlSecciones ='<?php echo $this->Url->build(array('controller' => 'dashboards', 'action' => 'promocion-secciones')); ?>';
  
 $(document).ready(function(){  
     
});

</script>