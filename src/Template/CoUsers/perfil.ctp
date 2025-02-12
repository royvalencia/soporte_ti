 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo __('Usuarios');?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5>Cambiar contraseña de <?php echo $Auth['nombre']; ?></h5>                    
               </div>               
            <div class="ibox-content">   
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
             <?= $this->Form->create($user) ?>
                                            <fieldset>                 
                                            <?php
                                                   // echo $form->input('id');
                                               
                                                    echo $this->Form->input("old_password", array('label'=>array('class'=>'col-sm-3 control-label','text'=>'Contraseña Anterior'),'size' => 20,'type'=>'password','class'=>'form-control','required'=>true));
                                                    echo $this->Form->input('password1', array('label'=>array('class'=>'col-sm-3 control-label','text'=>'Nueva Contraseña'),'size' =>20,'type'=>'password','class'=>'form-control','required'=>true));
                                                    echo $this->Form->input('password2', array('label'=>array('class'=>'col-sm-3 control-label','text'=>'Confirmar Nueva Contraseña'),'size' =>20,'type'=>'password','class'=>'form-control','required'=>true));
                                                  ?>
                                                  <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-9">
                                                        <?php echo $this->Form->button(__('<i class="fa fa-check-circle"></i> Cambiar'),array('type'=>'submit','class'=>'btn btn-primary','div'=>false,'escape'=>false));?>
                                                    </div>
                                                  </div>      
                                            </fieldset>
                                            <?php echo $this->Form->end() ;
                                             //echo $this->name.':'.$this->action
                                            ?>
             </div>
          </div>
               
        </div>
    </div>
</div>
   