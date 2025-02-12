 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
 <?php  echo $this->Html->script('bootstrap-datepicker/bootstrap-datepicker');
use Cake\Routing\Router;?>
 <?php  echo $this->Html->script('bootstrap-datepicker/bootstrap-datepicker.es');?>
 <?php  echo $this->Html->css('main-datepicker');?>
 <?php echo $this->Html->script('eModal.min'); //AJAX MODAL ?>
 <!-- DateTime -->
 <?php echo $this->Html->css('datetimepicker/jquery.datetimepicker'); ?>
 <?php echo $this->Html->script('datetimepicker/build/jquery.datetimepicker.full'); ?>

 <div class="row wrapper border-bottom white-bg page-heading">
     <div class="col-lg-10">
         <h2><i class="fa fa-ban"></i>&nbsp;<?= __('Ban IPs') ?></h2>
     </div>
     <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">
     <div class="row">
         <div class="col-lg-12">
             <div class="ibox float-e-margins">
                 <div class="ibox-title">
                     <h5><i class="fa fa-plus"></i> <?= __('Agregar Ban IP') ?></h5>
                 </div>
                 <div class="ibox-content">
                     <div class="row">
                         <div class="col-md-12">
                             <div class="btn-toolbar" role="toolbar">
                                 <div class="btn-group pull-right">
                                     <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de IPs ','escape' => false)); ?>
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
                     <?php echo $this->Form->create($banip); ?>
                     <fieldset>
                         <legend></legend>
                         <?php
                            echo $this->Form->input('ip',array('label'=>array('text'=>'IP de la Amenaza')));
                            echo $this->Form->input('amenanza', ['type' => 'text','label' => 'Tipo de Amenaza']);
                            echo $this->Form->input('fuente', ['type' => 'text','label' => 'Fuente u Origen']);
                            echo $this->Form->input('destinofin',array('label'=>array('text'=>'Destino de la Amenaza')));
                            echo $this->Form->input('fecha_hora', ['type' => 'text','label' => 'Fecha Hora de Amenaza']);
                            echo $this->Form->input('co_user_id', ['label' => 'Registró','empty'=>'Seleccionar...'], ['options' => $coUsers]);

                        ?>
                         <div class="form-group">
                             <p>&nbsp;</p>
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
var dtp = $('.tipoFecha').datepicker({
        language: 'es'
    })
    .on('changeDate', function(e) {
        dtp.datepicker('hide');
    });
 </script>
 <script type="text/javascript">
 jQuery.datetimepicker.setLocale('es');
 jQuery('#fecha-hora').datetimepicker({});
 
 </script>