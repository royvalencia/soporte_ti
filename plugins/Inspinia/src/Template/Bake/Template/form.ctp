<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
 $actionEsp='Agregar';
 if($action=='edit'){
     $actionEsp='Editar';
 }
?>
 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo "<?php echo __('{$pluralHumanName}');?>";?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-edit"></i> <?php printf("<?php echo __('%s %s'); ?>", Inflector::humanize($actionEsp), $singularHumanName);  ?></h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       <?php  echo "\t\t<?php echo \$this->Html->link('<i class=\"fa fa-list\" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de ".$pluralHumanName." ','escape' => false)); ?>\n"; ?>
                     </div>
<?php
                        $done = array();
                        foreach ($associations as $type => $data) {
                            foreach ($data as $alias => $details) {
                                if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
                                    echo "\t\t\t\t\t<div class=\"btn-group pull-right\"  >\n";
                                    echo "\t\t\t\t\t\t<?php echo \$this->Html->link( '<i class=\"fa fa-list-ul\"></i> "  . "', array('controller' => '{$details['controller']}', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de ".Inflector::humanize($details['controller'])."')); ?>\n";
                                    echo "\t\t\t\t\t\t<?php echo \$this->Html->link( '<i class=\"fa fa-plus-circle\"></i>  " .  "', array('controller' => '{$details['controller']}', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo ".Inflector::humanize(Inflector::underscore($alias))." ')); ?>\n";
                                    echo "\t\t\t\t\t</div>\n";
                                    $done[] = $details['controller'];
                                }
                            }
                        }
                    ?>
                   </div> 
                </div>
            </div>
            <br>      
<?php
    echo "\t<?php 
              \$myTemplates = [
                 'formStart' => '<form{{attrs}} class=\"form-horizontal\">',
                'inputContainer' => '<div class=\"form-group {{type}}{{required}}\">{{content}}</div>',
                'input' => '<div class=\"col-sm-9\"><input type=\"{{type}}\" name=\"{{name}}\" class=\"form-control\" {{attrs}}/></div>',
                'label' => '<label  class=\"col-sm-3 control-label\" {{attrs}}>{{text}}</label>',
                'select' => '<div class=\"col-sm-9\"><select name=\"{{name}}\"{{attrs}} class=\"form-control\">{{content}}</select></div>',
                'selectMultiple' => '<div class=\"col-sm-9\"><select name=\"{{name}}[]\" multiple=\"multiple\"{{attrs}} class=\"form-control\">{{content}}</select></div>',
                'textarea' => '<div class=\"col-sm-9\"><textarea name=\"{{name}}\"{{attrs}} class=\"form-control\">{{value}}</textarea></div>',
                 'checkbox' => '<div class=\"col-sm-9 checkbox-div\"><input type=\"checkbox\" name=\"{{name}}\"  value=\"{{value}}\"{{attrs}}  ></div>',
                'nestingLabel' => '<label class=\"col-sm-3 control-label checkbox-label\" {{attrs}}>{{text}}</label>{{hidden}}{{input}}'
            ];
            \$this->Form->templates(\$myTemplates);  
        echo \$this->Form->create('{$modelClass}'));
\t?>\n";
?>
                 <fieldset>
                    <legend></legend>
<?php
                         echo "\t<?php\n";
                        foreach ($fields as $field) {
                            if (strpos($action, 'add') !== false && $field == $primaryKey) {
                                continue;
                            } elseif (!in_array($field, array('created', 'modified', 'updated'))) {                                                               
                                 echo "\t\techo \$this->Form->input('{$field}',array('label'=>array('class'=>'col-sm-3 control-label'),'class'=>'form-control'));\n";                                                                 
                            }
                        }
                        if (!empty($associations['hasAndBelongsToMany'])) {
                            foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {       
                                  echo "\t\techo \$this->Form->input('{$assocName}',array('label'=>array('class'=>'col-sm-3 control-label'),'class'=>'form-control'));\n";          
                            }
                        }
                  echo "\t?>\n";      
?>
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">                    
<?php
                        echo "\t\t\t\t\t<?php echo \$this->Form->button(__('<i class=\"fa fa-check-circle\"></i> Guardar'),array('type'=>'submit','class'=>'btn btn-primary','div'=>false,'escape'=>false));?>\n";
                        echo "\t\t\t\t\t<?php echo \$this->Html->link(__('<i class=\"fa fa-times-circle\"></i> Cancelar'),array('action' => 'index'),array('class'=>'btn  btn-default','escape'=>false,'role'=>'button'));?>\n";
?>
                  </div>
               </div>
             </fieldset>                                                 
<?php echo "\t<?php echo \$this->Form->end();?>\n"; ?>
             </div>
          </div>
               
        </div>
    </div>
</div>