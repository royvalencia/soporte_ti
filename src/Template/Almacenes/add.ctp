  <?php
  use Cake\Core\Configure;
      echo $this->Html->css('inspinia/plugins/jasny/jasny-bootstrap.min');
      echo $this->Html->script('inspinia/plugins/jasny/jasny-bootstrap.min', array('inline' => true));      
  ?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">                      
        <h2><?= __('Catálogo de Almacenes');?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-edit"></i> <?= __('Agregar Almacen') ?></h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Almacenes ','escape' => false)); ?>
                     </div>
                                      
                                       </div> 
                </div>
            </div>
            <br>  
               <div class="row">
                 <div class="col-md-5">
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
             <?= $this->Form->create($almacene) ?>
                 <fieldset>
                    <legend>Datos Generales</legend>
        <?php
            echo $this->Form->input('clave');
            echo $this->Form->input('nombre');
            echo $this->Form->input('descripcion');
            echo $this->Form->input('telefono',['data-mask'=>'(999) 999-9999','label'=>['text'=>'Teléfono']]);
            echo $this->Form->input('domicilio');
            echo $this->Form->input('encargado');
            echo $this->Form->input('x',['label'=>['text'=>'Longitud (x)'],'readonly']);
            echo $this->Form->input('y',['label'=>['text'=>'Latitud (y)'],'readonly']);
            
            
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

              <div class="col-md-7">
                <fieldset>
                    <legend>Ubicación Geográfica</legend>
                    <div id="map" style="height: 600px;" class="google-map" ></div> 
            <!-- <input id="address" type="textbox" size="60" value="" placeholder="Dirección, Ciudad">
             <input id="submit" type="button" value="Buscar"> -->
             <div style="position: absolute;top:60px;left: 18px" class=" col-md-8">
                 <div class="input-group">
                    <input id="address" name="address" type="text" placeholder="Domicilio, Ciudad" class="form-control">
                    <span class="input-group-btn">
                      <button id="searchBtn" class="btn btn-default" title="buscar indicando el domicilio y la ciudad" type="button"><i class="fa fa-search fa-lg" aria-hidden="true" style="top:8px;padding: 3px"></i></button>
                    </span>
                  </div><!-- /input-group -->
            </div>
                 </fieldset>   

              </div>
                            </div>
             </div>
          </div>               
        </div>
    </div>
</div>
<?php
      echo $this->Html->script('mapas.js'); //Mapas
       echo "<script> var iconBuliding='".$this->Url->build('/')."img/office-building.png';</script>";
      
      /**
      * PAra ver solo el punto del mapa basta con poner esto
      *  echo "<script>editMode = false</script>";
      */
     
      
 ?>

    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Configure::read('mapsApiKey'); ?>&callback=initMap"
    async defer></script>