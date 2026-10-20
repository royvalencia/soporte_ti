 <?php 
    echo $this->Html->css('inspinia/plugins/jasny/jasny-bootstrap.min');
      echo $this->Html->script('inspinia/plugins/jasny/jasny-bootstrap.min', array('inline' => true)); 
 ?>
 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">                      
        <h2><?= __('Cartera de Clientes');?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-edit"></i> <?= __('Agregar Cliente') ?></h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Clientes ','escape' => false)); ?>
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
             <?= $this->Form->create($cliente) ?>
                 <fieldset>
                    <legend>Datos del Cliente</legend>       
        <div class="row">
            <div class="col-md-4">
               <?php echo $this->Form->input('apellido_paterno'); ?> 
            </div>
            <div class="col-md-4">
               <?php  echo $this->Form->input('apellido_materno'); ?> 
            </div>
            <div class="col-md-4">
                <?php echo $this->Form->input('nombre'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php echo $this->Form->input('razon_social'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php  echo $this->Form->input('rfc', ['label'=>['text'=>'RFC']]);?>
            </div>
             <div class="col-md-4">
                <?php  echo $this->Form->input('homoclave'); ?>
            </div>
             <div class="col-md-4">
                <?php  echo $this->Form->input('curp',['label'=>['text'=>'CURP']]);?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php  echo $this->Form->input('genero',['label'=>['text'=>'Género'],'options'=>$genero,'empty'=>true,'required']); ?>
            </div>
            <div class="col-md-4">
                <?php  echo $this->Form->input('estado_civil',['options'=>$estadoCivil,'empty'=>true,'required']); ?>
            </div>
            <div class="col-md-4">                
            </div>           
        </div>
        
              <div class="row">
            <div class="col-md-4">
                <?php   echo $this->Form->input('fecha_nacimiento', ['minYear'=>date('Y')-101,'maxYear'=>date('Y'), 'empty' => true,'templates'=>['select' => '<select name="{{name}}"{{attrs}}>{{content}}</select>','dateWidget' => '<div class="col-md-9">{{year}}{{month}}{{day}}{{hour}}{{minute}}{{second}}{{meridian}}</div>']]); ?>
            </div>
            <div class="col-md-4">
               
                 <?php  echo $this->Form->input('ocupacione_id', ['options' => $ocupaciones, 'label'=>['text'=>'Ocupación'],'empty' => true]); ?>
            </div>
            <div class="col-md-4">
                
            </div>           
        </div>
          <div class="row">
            <div class="col-md-4">
                <?php echo $this->Form->input('lugar_nacimento'); ?>
            </div>
            <div class="col-md-4">
                <?php   echo $this->Form->input('nacionalidad',['options'=>$nacionalidad,'empty'=>true]); ?>
            </div>
            <div class="col-md-4">
                <?php 
                 echo $this->Form->input('grupo');
                ?>
            </div>           
        </div>
        <div class="row">
            <div class="col-md-12"><?php  echo $this->Form->input('observaciones'); ?></div>
        </div>
        <legend>Ubicación</legend>
       
        <div class="row">
            <div class="col-md-6">
                <?php  echo $this->Form->input('ubicaciones.0.calle'); ?>
            </div>
            <div class="col-md-3">
                <?php  echo $this->Form->input('ubicaciones.0.no_ext',['label'=>['text'=>'No. Ext.']]); ?>
            </div>
            <div class="col-md-3">
                <?php  echo $this->Form->input('ubicaciones.0.no_int',['label'=>['text'=>'No. Int.']]); ?>
            </div>
        </div>
         <div class="row">
            <div class="col-md-4">
                <?php   echo $this->Form->input('ubicaciones.0.codigo_postal'); ?>
            </div>
            <div class="col-md-4">
                <?php echo $this->Form->input('ubicaciones.0.colonia'); ?>
            </div>
            <div class="col-md-4">
                <?php ?>
            </div>
        </div>
         <div class="row">
            <div class="col-md-4">
                <?php echo $this->Form->input('ubicaciones.0.ciudad_municipio',['label'=>['text'=>'Ciudad, Municipio o Delegación']]); ?>
            </div>
            <div class="col-md-4">
                <?php  echo $this->Form->input('ubicaciones.0.estado',['empty'=>true]); ?>
            </div>
            <div class="col-md-4">
                <?php  echo $this->Form->input('ubicaciones.0.direccion_confidencial',['label'=>['text'=>'Dirección Confidencial']]); ?>
            </div>
        </div>
         <div class="row">
            <div class="col-md-4">
                <?php  echo $this->Form->input('ubicaciones.0.correo_electronico',['type'=>'email','label'=>['text'=>'Correo Electrónico']]); ?>
            </div>
            <div class="col-md-4">
                <?php  echo $this->Form->input('ubicaciones.0.tipo_ubicacione_id', ['options' => $tipoUbicaciones, 'empty' => true,'label'=>['text'=>'Tipo Ubicación']]); ?>
            </div>
            <div class="col-md-4">
                <?php ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php  echo $this->Form->input('ubicaciones.0.telefono_casa',['label'=>['text'=>'Tel. Casa'],'data-mask'=>'(999) 999-9999']); ?>
            </div>
            <div class="col-md-4">
                <?php echo $this->Form->input('ubicaciones.0.telefono_celular',['label'=>['text'=>'Tel. Celular'],'data-mask'=>'(999) 999-9999']); ?>
            </div>
            <div class="col-md-4">
                <?php ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <?php echo $this->Form->input('ubicaciones.0.telefono_oficina',['label'=>['text'=>'Tel. Oficina'],'data-mask'=>'(999) 999-9999']); ?>
            </div>
            <div class="col-md-3">
                <?php  echo $this->Form->input('ubicaciones.0.extension',['label'=>['text'=>'Ext. Oficina']]); ?>
            </div>
            <div class="col-md-3">
                <?php  echo $this->Form->input('ubicaciones.0.fax',['label'=>['text'=>'Fax'],'data-mask'=>'(999) 999-9999']); ?>
            </div>
            <div class="col-md-3">
                <?php    echo $this->Form->input('ubicaciones.0.extension_fax',['label'=>['text'=>'Ext. Fax']]); ?>
            </div>
        </div>
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
    $('#apellido-paterno').focus();
</script>