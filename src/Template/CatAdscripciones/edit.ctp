 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">                      
        <h2><?= __('Cat Adscripciones');?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-edit"></i> <?= __('Editar Cat Adscripcione') ?></h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Cat Adscripciones ','escape' => false)); ?>
                     </div>
                                        <div class="btn-group pull-right">
                           <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> '), ['controller' => 'CatInstituciones', 'action' => 'index'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Cat Instituciones']) ?>
                           <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> '), ['controller' => 'CatInstituciones', 'action' => 'add'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Cat Institucione ']) ?>
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
             <?= $this->Form->create($catAdscripcione) ?>
                 <fieldset>
                    <legend></legend>
        <?php
            echo $this->Form->input('cve_ads');
            echo $this->Form->input('nom_ads');
            echo $this->Form->input('cat_institucione_id', ['options' => $catInstituciones]);
            echo $this->Form->input('cveusuad');
            echo $this->Form->input('cveucoad');
            echo $this->Form->input('estatus');
            echo $this->Form->input('vigencia_inicial', ['empty' => true,'templates'=>['select' => '<select name="{{name}}"{{attrs}}>{{content}}</select>','dateWidget' => '<div class="col-md-9">{{year}}{{month}}{{day}}{{hour}}{{minute}}{{second}}{{meridian}}</div>']]);
            echo $this->Form->input('vigencia_final', ['empty' => true,'templates'=>['select' => '<select name="{{name}}"{{attrs}}>{{content}}</select>','dateWidget' => '<div class="col-md-9">{{year}}{{month}}{{day}}{{hour}}{{minute}}{{second}}{{meridian}}</div>']]);
            echo $this->Form->input('anio');
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