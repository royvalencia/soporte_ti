 <?php
      echo $this->Html->css('inspinia/plugins/multiselect/bootstrap-multiselect');
      echo $this->Html->script('inspinia/plugins/multiselect/bootstrap-multiselect', array('inline' => true));      
  ?>
 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">                      
        <h2><?= __('Grupos');?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-edit"></i> <?= __('Editar Grupo') ?></h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Grupos ','escape' => false)); ?>
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
            ];
            $this->Form->templates($myTemplates);     
            ?>      
             <?= $this->Form->create($coGroup) ?>
                 <fieldset>
                    <legend></legend>
        <?php
        $tipo=array(0=>"Seleccione...",1=>"Administrador",2=>"Supervisor",3=>"de Grupo",4=>"Usuario");
             echo $this->Form->input('name',['label'=>'Nombre']);
             echo $this->Form->input('tipo',['options' => $tipo,'label'=>'Tipos']);
             echo $this->Form->input('supervisor_padre');
             echo $this->Form->input('home_page');
            echo $this->Form->input('co_permissions._ids', ['options' => $coPermissions,'label'=>'Permisos']);
            echo $this->Form->input('co_menus._ids', ['options' => $coMenus,'label'=>'Menús']);
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
    $(document).ready(function() {
        $('#co-permissions-ids').multiselect({           
             enableFiltering: true,
            filterBehavior: 'text'
        });
         $('#co-menus-ids').multiselect({           
             enableFiltering: true,
            filterBehavior: 'text'
        });
    });
</script>