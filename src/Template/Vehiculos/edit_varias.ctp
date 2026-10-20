
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
             <?= $this->Form->create($vehiculo) ?>
                 <fieldset>
                 
                    <div class="row">
                        <div class="col-md-6"><?php  echo $this->Form->input('id_poliza'); ?></div>
                        <div class="col-md-6"><?php   echo $this->Form->input('cis',['label'=>['text'=>'CIS']]); ?></div>
                    </div>
                    
                    <div class="row">                        
                        <div class="col-md-6"><?php   echo $this->Form->input('emisor'); ?></div>
                        <div class="col-md-6"><?php  echo $this->Form->input('anio_contratacion',['label'=>['text'=>'Año Contratación']]); ?></div>
                    </div>
                    
                    <div class="row">                        
                        <div class="col-md-6"><?php   echo $this->Form->input('ubicacion',['label'=>['text'=>'Ubicación']]); ?></div>
                    </div>
                 
                
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">                    
                        <?php echo $this->Form->button(__('<i class="fa fa-check-circle"></i> Guardar'),array('type'=>'submit','class'=>'btn btn-primary','div'=>false,'escape'=>false));?>
                        <?php //echo $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'),array('action' => 'index'),array('class'=>'btn  btn-default','escape'=>false,'role'=>'button'));?>
                  </div>
               </div>
             </fieldset>                                                 
             <?= $this->Form->end();?>
           