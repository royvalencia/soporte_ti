 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
 <?php  echo $this->Html->script('bootstrap-datepicker/bootstrap-datepicker');
use Cake\Routing\Router;?>
 <?php  echo $this->Html->script('bootstrap-datepicker/bootstrap-datepicker.es');?>
 <?php  echo $this->Html->css('main-datepicker');?>
 <?php echo $this->Html->script('eModal.min'); //AJAX MODAL ?>

 <script>
$('document').ready(function() {
    $('#cat-institucione-id').change(function() {
        var searchkey = $(this).val();
        searchTags(searchkey);
    });

    function searchTags(institucion) {
        var data = institucion;
        $.ajax({
            method: 'get',
            url: "<?php echo $this->Url->build( [ 'controller' => 'Servicios', 'action' => 'ajaxproceso' ] ); ?>",
            data: {
                institucion: data
            },
            success: function(response) {
                $('#post1').html(response);
            }
        });
    };
});
 </script>

 <div class="row wrapper border-bottom white-bg page-heading">
     <div class="col-lg-10">
         <h2><i class="fa fa-server"></i>&nbsp;<?= __('Servidores') ?></h2>
     </div>
     <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">
     <div class="row">
         <div class="col-lg-12">
             <div class="ibox float-e-margins">
                 <div class="ibox-title">
                     <h5><i class="fa fa-edit"></i> <?= __('Editar Servidor') ?></h5>
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
                    <?= $this->Form->create($server) ?>
                     <fieldset>
                         <legend></legend>
                        <?php
                            echo $this->Form->input('descripcion',array('label'=>array('text'=>'Descripcion General del Servidor')));
                            echo $this->Form->input('user', ['type' => 'textarea','label' => 'Usuarios del Servidor']);
                            echo $this->Form->input('password', ['type' => 'text','label' => 'Contraseña del Servidor']);
                            echo $this->Form->input('ip_interna',array('label'=>array('text'=>'IP Interna')));
                            echo $this->Form->input('ip_externa',array('label'=>array('text'=>'IP Externa')));
                            echo $this->Form->input('caracteristicas',array('label'=>array('text'=>'Caracteristicas')));
                            echo $this->Form->input('servicios',array('label'=>array('text'=>'Servicios Activos')));
                            echo $this->Form->input('puertos',array('label'=>array('text'=>'Puertos en el Servidor')));
                            echo $this->Form->input('co_user_id',array('label'=>array('text'=>'Registró')), ['options' => $coUsers]);

                            

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