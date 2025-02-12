  <?php
      echo $this->Html->css('inspinia/plugins/multiselect/bootstrap-multiselect');
      echo $this->Html->script('inspinia/plugins/multiselect/bootstrap-multiselect', array('inline' => true));      
  ?>
 <?php
$script="function selectAll(){
       var checked_status = this.checked;
   $(\"input[type=checkbox]\").each(function()
   {
    this.checked = true;
   });
    }
    function deselectAll(){
         var checked_status = this.checked;
   $(\"input[type=checkbox]\").each(function()
   {
    this.checked = false;
   });
    } "; 
//echo $javascript->codeBlock($script,$options = array('inline'=>false))    ;
echo $this->Html->scriptBlock($script,$options = array('inline'=>false));
?>
 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Permisos del Grupo') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><?= __('Lista de Controladores:Acciones') ?></h5>                    
               </div>               
            <div class="ibox-content">   
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar">
                           
    
                                                         <div class="btn-group pull-right"  >
                                <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> Permisos'), ['controller' => 'coPermissions', 'action' => 'index'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Permisos')); ?>
                                
                             </div>   
                                               </div> 
                    </div>
               </div>
               <div class="row">
               <div class="col-md-12">
               <?php
                    $myTemplates = [
                 'formStart' => '<form{{attrs}} class="form-inline">',
                 'inputContainer' => '<div class="form-group {{type}}{{required}}">{{content}}</div>',
                 'select' => ' <select name="{{name}}"{{attrs}} class="form-control">{{content}}</select>',
                 'label' => '<label  {{attrs}}>{{text}}</label>',
              
            ];
            $this->Form->templates($myTemplates);                    
                     echo $this->Form->create($coPermission, ['url' => ['action' => 'controladores']]);
                       echo $this->Form->input('controladores', ['options' => $controladores,'label'=>'Controladores','multiple'=>'multiple']);
                      echo $this->Form->button(__('<i class="fa fa-search"></i> buscar'),array('type'=>'submit','class'=>'btn btn-primary','div'=>false,'escape'=>false));
                     echo $this->Form->end();
                ?>
               </div>
               </div>
            <br>
            
           <?php
           echo $this->Form->create($coPermission, ['url' => ['action' => 'add-controller']]);
           echo $this->Form->hidden('procedencia',array('default'=>'controladores'));
            echo $this->Form->button(__('<i class="fa fa-check"></i> Agregar'),array('type'=>'submit','class'=>'btn btn-primary','div'=>false,'escape'=>false));
            ?>
             <div align="right">
                  <?php echo $this->Html->link(__('Marcar todas', true), "#",array('onClick' => 'selectAll()')); ?>
                            /
                  <?php echo $this->Html->link(__('Desmarcar todas', true), "#",array('onClick' => 'deselectAll()')); ?>
                </div>
            <?php
                 $cont=0;
                foreach($controladoresPermisos as $controladorPermiso):
                  //  pr($controlador);
                
             ?>
             <div class="row well">
                <div class="col-md-12">
                <?php
                
                   
                    foreach($controladorPermiso as $controller=>$action){
                        echo "<h3>$controller</h3>";
                        foreach($action as $acciones){
                          //  echo '<p>- <input  type="checkbox"><label for=""> '.$acciones."</label></p>";
                          echo '<p style="margin:0 0 2px;"> - ';    
                          $agregado = false;
                          foreach($permisos as $permiso){
                              if($permiso->name==$acciones){
                                  $agregado =true;
                              }
                          }
                          if($agregado==false){                      
                               echo $this->Form->checkbox('agregar_'.$cont, ['hiddenField' => false,'id'=>'agregar_'.$cont]);
                               echo $this->Form->hidden('name_'.$cont,array('default'=>$acciones));
                               echo ' <label for="agregar_'.$cont.'"> '.$acciones."</label></p>";
                               $cont++;
                          }else{
                                echo $this->Form->checkbox('agregar_'.$cont, ['hiddenField' => false,'id'=>'agregar_'.$cont,'disabled'=>'disabled']);
                               echo ' <span style="color:gray"> '.$acciones."</span> -<i> Agregado</i></p>"; 
                          }
                        }                        
                    }
                 ?>
                </div>
             </div>   
            <?php
                 endforeach;
                   echo $this->Form->button(__('<i class="fa fa-check"></i> Agregar'),array('type'=>'submit','class'=>'btn btn-primary','div'=>false,'escape'=>false));
                     echo $this->Form->end();
             ?>
         </div>
       </div>         
      </div>
    </div>
</div>   
<script type="text/javascript">
    $(document).ready(function() {
        $('#controladores').multiselect({           
             enableFiltering: true,
            filterBehavior: 'text'
        });
         
    });
</script> 