
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
             <?= $this->Form->create($ubicacione) ?>
                 <fieldset>
                    <legend></legend>
   <div class="row">
            <div class="col-md-6">
                <?php  echo $this->Form->input('calle'); ?>
            </div>
           
        </div>
        <div class="row">
         <div class="col-md-6">
                <?php  echo $this->Form->input('no_ext',['label'=>['text'=>'No. Ext.']]); ?>
            </div>
            <div class="col-md-6">
                <?php  echo $this->Form->input('no_int',['label'=>['text'=>'No. Int.']]); ?>
            </div>  
         <div class="row">
            <div class="col-md-6">
                <?php   echo $this->Form->input('codigo_postal'); ?>
            </div>
            <div class="col-md-6">
                <?php echo $this->Form->input('colonia'); ?>
            </div>
            
        </div>
         <div class="row">
            <div class="col-md-6">
                <?php echo $this->Form->input('ciudad_municipio',['label'=>['text'=>'Ciudad, Municipio o Delegación']]); ?>
            </div>
            <div class="col-md-6">
                <?php  echo $this->Form->input('estado',['empty'=>true]); ?>
            </div>
            
        </div>
        <div class="row">
          <div class="col-md-6">
                <?php  echo $this->Form->input('direccion_confidencial',['label'=>['text'=>'Dirección Confidencial']]); ?>
            </div>
        </div>
         <div class="row">
            <div class="col-md-6">
                <?php  echo $this->Form->input('correo_electronico',['type'=>'email','label'=>['text'=>'Correo Electrónico']]); ?>
            </div>
            <div class="col-md-6">
                <?php  echo $this->Form->input('tipo_ubicacione_id', ['options' => $tipoUbicaciones, 'empty' => true,'label'=>['text'=>'Tipo Ubicación']]); ?>
            </div>
           
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php  echo $this->Form->input('telefono_casa',['label'=>['text'=>'Tel. Casa'],'data-mask'=>'(999) 999-9999']); ?>
            </div>
            <div class="col-md-6">
                <?php echo $this->Form->input('telefono_celular',['label'=>['text'=>'Tel. Celular'],'data-mask'=>'(999) 999-9999']); ?>
            </div>
          
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php echo $this->Form->input('telefono_oficina',['label'=>['text'=>'Tel. Oficina'],'data-mask'=>'(999) 999-9999']); ?>
            </div>
            <div class="col-md-6">
                <?php  echo $this->Form->input('extension',['label'=>['text'=>'Ext. Oficina']]); ?>
            </div>
          
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php  echo $this->Form->input('fax',['label'=>['text'=>'Fax'],'data-mask'=>'(999) 999-9999']); ?>
            </div>
            <div class="col-md-6">
                <?php    echo $this->Form->input('extension_fax',['label'=>['text'=>'Ext. Fax']]); ?>
            </div>
        </div>
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">                    
                        <?php echo $this->Form->button(__('<i class="fa fa-check-circle"></i> Guardar'),array('type'=>'submit','class'=>'btn btn-primary','div'=>false,'escape'=>false));?>
                 
                  </div>
               </div>
             </fieldset>                                                 
             <?= $this->Form->end();?>
<script type="text/javascript">
  $('#calle').focus();
</script>