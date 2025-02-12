 <?php  echo $this->Html->script('bootstrap-datepicker/bootstrap-datepicker');
use Cake\Routing\Router;?>
<?php  echo $this->Html->script('bootstrap-datepicker/bootstrap-datepicker.es');?>
<?php  echo $this->Html->css('main-datepicker');?>
<?php echo $this->Html->script('eModal.min'); //AJAX MODAL ?>

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
                 <h5><i class="fa fa-edit"></i> <?= __('Editar Servicio') ?></h5>                    
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
             <?= $this->Form->create($servicio) ?>
                 <fieldset>
                    <legend></legend>
                      
        <?php
           

            ?>
              
            <?php
            if ($estado==3){ 

              $Evento="Finalizado por: ".$user2;

            echo $this->Form->input('solucion',array('label'=>array('text'=>'Solución')));
            //echo $this->Form->input('fecha_solucion');
            ?>
            <div class="form-group required"><label for="fecha_solucion" class="col-sm-3 control-label">Fecha Solución</label><div class="col-sm-9"><div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="fecha_solucion" value="<?php echo date('Y-m-d'); ?>" class="form-control tipoFecha" type="text" id="fecha_solucion" required="required"/></div></div></div>
            <?php
            }
            echo $this->Form->input('notas');

            echo $this->Form->hidden('statu_id', ['value' => $estado]);
            echo $this->Form->hidden('created_by');
            if ($servicio->fecha_solicitud==null){
              echo $this->Form->hidden('fecha_solicitud');
             } else{
              echo $this->Form->hidden('fecha_solicitud',['value' => date_format($servicio->fecha_solicitud,'Y-m-d')]);
            }
            echo $this->Form->hidden('descripcion_corta');
            echo $this->Form->hidden('tipo_servicio_id');
            echo $this->Form->hidden('tipo_incidencia_id');
            echo $this->Form->hidden('problematica');
            echo $this->Form->hidden('no_inventario');
            echo $this->Form->hidden('prioridade_id');
            echo $this->Form->hidden('cat_institucione_id');
            echo $this->Form->hidden('cat_adscripcione_id');
            echo $this->Form->hidden('nombre_solicitante');
            echo $this->Form->hidden('cargo_solicitante');
            echo $this->Form->hidden('telefono_solicitante');
            echo $this->Form->hidden('email_solicitante');
            if ($servicio->fecha_limite_solucion==null){
              echo $this->Form->hidden('fecha_limite_solucion');
            }else{ 
            echo $this->Form->hidden('fecha_limite_solucion',['value' => date_format($servicio->fecha_limite_solucion,'Y-m-d')]);
            }
            echo $this->Form->hidden('co_user_id');
            if ($estado==4){
               $Evento="Cancelado por: ".$user2;
              echo $this->Form->hidden('solucion');
              //echo $this->Form->hidden('fecha_solucion',['value' => date_format($servicio->fecha_solucion,'Y-m-d')]);
            }

            echo $this->Form->hidden('bitacoraserv.servicio_id', ['value' => $servicio->servicio_id]);
             echo $this->Form->hidden('bitacoraserv.descripcion_evento', ['value' => $Evento]);
            ?>
        <?php
            /*echo $this->Form->input('fecha_solicitud');
            echo $this->Form->input('descripcion_corta');
            echo $this->Form->input('tipo_servicio_id', ['options' => $tipoServicios]);
            echo $this->Form->input('tipo_incidencia_id', ['options' => $tipoIncidencias]);
            echo $this->Form->input('problematica');
            echo $this->Form->input('no_inventario');
            echo $this->Form->input('prioridade_id', ['options' => $prioridades]);
            echo $this->Form->input('cat_adscripcione_id', ['options' => $catAdscripciones]);
            echo $this->Form->input('nombre_solicitante');
            echo $this->Form->input('cargo_solicitante');
            echo $this->Form->input('telefono_solicitante');
            echo $this->Form->input('email_solicitante');
            echo $this->Form->input('fecha_limite_solucion');
            echo $this->Form->input('co_user_id', ['options' => $coUsers]);
            echo $this->Form->input('solucion');
            echo $this->Form->input('fecha_solucion');
            echo $this->Form->input('statu_id', ['options' => $status]);
            echo $this->Form->input('notas');
            echo $this->Form->input('created_by');*/
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