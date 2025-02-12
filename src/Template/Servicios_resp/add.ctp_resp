 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
 <?php  echo $this->Html->script('bootstrap-datepicker/bootstrap-datepicker');
use Cake\Routing\Router;?>
<?php  echo $this->Html->script('bootstrap-datepicker/bootstrap-datepicker.es');?>
<?php  echo $this->Html->css('main-datepicker');?>
<?php echo $this->Html->script('eModal.min'); //AJAX MODAL ?>

<script>
    $('document').ready(function(){
         $('#cat-institucione-id').change(function(){
            var searchkey = $(this).val();
            searchTags( searchkey );
         });
        function searchTags( institucion ){
        var data = institucion;
        $.ajax({
                    method: 'get',
                    url : "<?php echo $this->Url->build( [ 'controller' => 'Servicios', 'action' => 'ajaxproceso' ] ); ?>",
                    data: {institucion:data},
                    success: function( response )
                    {       
                       $( '#post1' ).html(response);
                    }
                });
        };
    });
</script>


 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">                      
        <h2><?= __('Servicios');?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-edit"></i> <?= __('Agregar Servicio') ?></h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Servicios ','escape' => false)); ?>
                     </div>
                                       
                                        
                                       </div> 
                </div>
            </div>
            <br>  
            <?php
              $myTemplates = [
                 'formStart' => '<form{{attrs}} class="form-horizontal">',
                'inputContainer' => '<div class="form-group {{type}}{{required}}">{{content}}</div>',
                'input' => '<div class="col-sm-9"><input type="{{type}}" name="{{name}}" class="form-control" {{attrs}}/></div>',
                'label' => '<label  class="col-sm-3 control-label" {{attrs}}>{{text}}</label>',
                'select' => '<div class="col-sm-9"><select name="{{name}}"{{attrs}} class="form-control">{{content}}</select></div>',
                'selectMultiple' => '<div class="col-sm-9"><select name="{{name}}[]" multiple="multiple"{{attrs}} class="form-control">{{content}}</select></div>',
                'textarea' => '<div class="col-sm-9"><textarea name="{{name}}"{{attrs}} class="form-control">{{value}}</textarea></div>',
                 'checkbox' => '<div class="col-sm-9 checkbox-div"><input type="checkbox" name="{{name}}"  value="{{value}}"{{attrs}}  ></div>',
                'nestingLabel' => '<label class="col-sm-3 control-label checkbox-label" {{attrs}}>{{text}}</label>{{hidden}}{{input}}'
            ];
            $this->Form->templates($myTemplates);     
            ?>      
             <?php echo $this->Form->create($servicio);

/*$llamada = $this->JS->remoteFunction(array('url'=>array('controller'=>'servicios','action' => 'ajaxproceso'),
                                                                    'update' => 'post1',
                                                                    'data' => '({cat_institucione_id : document.getElementById(\'ServicioCatInstitucioneId\').value
                                                                    
                                                                                 }
                                                                    )',
                                                                    'type' => 'GET')); */
              ?>
                 <fieldset>
                    <legend></legend>

                    <div class="form-group required"><label for="fecha_solicitud" class="col-sm-3 control-label">Fecha Solicitud</label><div class="col-sm-9"><div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="fecha_solicitud" value="<?php echo date('Y-m-d') ?>" class="form-control tipoFecha" type="text" id="fecha_solicitud" required="required"/></div></div></div> 
        <?php
            //echo $this->Form->input('fecha_solicitud');
            
            echo $this->Form->input('descripcion_corta',array('label'=>array('text'=>'Descripción Corta')));
            echo $this->Form->input('tipo_servicio_id',['empty'=>'Seleccionar...'], ['options' => $tipoServicios]);
            echo $this->Form->input('tipo_incidencia_id', ['options' => $tipoIncidencias]);
            echo $this->Form->input('problematica',array('label'=>array('text'=>'Problemática')));
            echo $this->Form->input('no_inventario');
            echo $this->Form->input('prioridade_id',array('label'=>array('text'=>'Prioridad')), ['options' => $prioridades]);

           
                                                                    ?>
             <?php
           
            echo $this->Form->input('cat_institucione_id',array('label'=>array('text'=>'Dependencia'),'empty'=>array('text'=>'Seleccionar...')), ['options' => $catInstituciones]);
            ?>                         
            <div id="post1">
            <?php
            echo $this->Form->input('cat_adscripcione_id',array('label'=>array('text'=>'Área Solicitante'),'empty'=>array('text'=>'Seleccionar...')));
            ?>
            </div>
            <?php
            echo $this->Form->input('nombre_solicitante');
            echo $this->Form->input('cargo_solicitante');
            echo $this->Form->input('telefono_solicitante',array('label'=>array('text'=>'Teléfono Solicitante')));
            echo $this->Form->input('email_solicitante');
            //echo $this->Form->input('fecha_limite_solucion');

            ?>
              <div class="form-group required"><label for="fecha_limite_solucion" class="col-sm-3 control-label">Fecha Límite</label><div class="col-sm-9"><div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="fecha_limite_solucion" value="<?php echo date('Y-m-d') ?>" class="form-control tipoFecha" type="text" id="fecha_limite_solucion" required="required"/></div></div></div> 
            <?php
            echo $this->Form->input('co_user_id',array('label'=>array('text'=>'Responsable'),'empty'=>array('text'=>'Seleccionar...')), ['options' => $coUsers]);
           /* echo $this->Form->radio(
    'terminar',
    [
        ['value' => '1', 'text' => 'si'],
        ['value' => '0', 'text' => 'no'],
        
    ]
);*/
?>
<div class="form-group text required"><label  class="col-sm-3 control-label"  for="terminar">Terminar</label><div class="col-sm-9">
   <input type="radio" name="terminar" value="1" required="required"> Si
  <input type="radio" name="terminar" value="0" required="required"> No

</div></div>
<?php

            echo $this->Form->hidden('solucion',['value'=>' ']);
            
            ?>

            
            <?php
            //echo $this->Form->hidden('fecha_solucion',['value'=>'2000-01-01']);
            echo $this->Form->hidden('statu_id',['value'=>1]);
            echo $this->Form->hidden('notas',['value'=>' ']);
            echo $this->Form->hidden('created_by',['value'=>$user]);
           

        ?>


                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">                    
                        <?php echo $this->Form->button(__('<i class="fa fa-check-circle"></i> Guardar'),array('type'=>'submit','class'=>'btn btn-primary','div'=>false,'escape'=>false));?>
                        <?php echo $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'),array('action' => 'index'),array('class'=>'btn  btn-default','escape'=>false,'role'=>'button'));?>
                  </div>
               </div>
             </fieldset>                                                 
             <?= $this->Form->end();?>
             </div>
          </div>               
        </div>
    </div>
</div>

<script type="text/javascript">    
var dtp = $('.tipoFecha').datepicker({language: 'es'})
        .on('changeDate', function(e) {
            dtp.datepicker('hide');
        });  
</script>