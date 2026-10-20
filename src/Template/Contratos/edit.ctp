<?php
      echo $this->Html->css('inspinia/plugins/multiselect/bootstrap-multiselect');
      echo $this->Html->script('inspinia/plugins/multiselect/bootstrap-multiselect', array('inline' => true));      
  ?>
  
 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">                      
        <h2><?= __('Contratos');?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-edit"></i> <?= __('Agregar Nuevo Contrato') ?></h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Contratos ','escape' => false)); ?>
                     </div>
                                        <div class="btn-group pull-right">
                           <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> '), ['controller' => 'Clientes', 'action' => 'index'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Clientes']) ?>
                           <?= $this->Html->link(__('<i class="fa fa-male"></i> '), ['controller' => 'Clientes', 'action' => 'view',$cliente->id],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Ver cliente # '. $cliente->id ]) ?>
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

            $templateSumData = ['input' => '<div class="col-sm-9"><input type="{{type}}" name="{{name}}" class="form-control sum-data text-right" {{attrs}}/></div>'];
            $this->Form->templates($myTemplates);     
            ?>      
             <?= $this->Form->create($contrato) ?>
                 <fieldset>
                    <legend></legend>
                    <?php  echo $this->Form->input('cliente_id', ['type' =>'hidden','value'=>$cliente->id]); 
                           echo $this->Form->input('anio',['type'=>'hidden','value'=>'1']); 
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                        <?php echo $this->Form->input('cliente_nombre',['label'=>['text'=>'Cliente'], 'readonly','value'=>$cliente->full_name]) ?>
                        </div>
                        <div class="col-md-6">
                            <?php   echo $this->Form->input('ubicacione_id', ['options' => $ubicaciones,'empty'=>'-Seleccione-','label'=>['text'=>'Ubicación']]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <?php echo $this->Form->input('no_contrato',['label'=>['text'=>'No. Contrato/Póliza']]);?>
                        </div>
                        <div class="col-md-6">
                          
                        </div>
                    </div>
                    <div class="row">
                             <div class="col-md-12"><h3>Información del Contrato</h3></div>
                         </div>
                    <div class="row">
                        <div class="col-md-4">
                        <?php echo $this->Form->input('empresa_id', ['options' => $empresas]); ?>
                        </div>
                        <div class="col-md-4">
                          <?php  echo $this->Form->input('sectore_id', ['empty'=>true, 'options' => $sectores,'label'=>['text'=>'Sector']]); ?>
                        </div>
                        <div class="col-md-4">
                          <?php echo $this->Form->input('operacione_id', ['empty'=>true, 'options' => $operaciones,'label'=>['text'=>'Operación']]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        <?php  echo $this->Form->input('ramo_id', ['empty'=>true,'options' => $ramos]); ?>
                        </div>
                        <div class="col-md-4">
                          <?php  echo $this->Form->input('producto_id', ['empty'=>true, 'options' => $productos]); ?>
                        </div>
                        <div class="col-md-4">
                          <?php  echo $this->Form->input('sub_ramo_id', ['empty'=>true,'options' => $subRamos]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        <?php  echo $this->Form->input('beneficios._ids', ['options' => $beneficios,'label'=>['text'=>'Beneficios Adicionales']]); ?>
                        </div>
                        <div class="col-md-4">
                          <?php   echo $this->Form->input('co_user_id', ['options' => $coUsers, 'empty' => true,'label'=>['text'=>'Asesor']]); ?>
                        </div>
                        <div class="col-md-4">
                          <?php ?>
                        </div>
                    </div>                    
                    <div class="row" style="margin-top:24px">
                        <div class="col-md-4">
                        <?php echo $this->Form->input('fecha_inicio', ['maxYear'=>date('Y')+15,'minYear'=>date('Y')-1, 'empty' => true,'templates'=>['select' => '<select class="form-control small-select" name="{{name}}"{{attrs}}>{{content}}</select>','dateWidget' => '<div class="col-md-9">{{day}}{{month}}{{year}}{{hour}}{{minute}}{{second}}{{meridian}}</div>']]); ?>
                        </div>
                        <div class="col-md-4">
                          <?php echo $this->Form->input('fecha_termino', ['maxYear'=>date('Y')+15,'minYear'=>date('Y')-1,'empty' => true,'templates'=>['select' => '<select class="form-control small-select" name="{{name}}"{{attrs}}>{{content}}</select>','dateWidget' => '<div class="col-md-9">{{day}}{{month}}{{year}}{{hour}}{{minute}}{{second}}{{meridian}}</div>']]); ?>
                        </div>
                        <div class="col-md-4">
                          <?php echo $this->Form->input('fecha_emision', ['maxYear'=>date('Y')+15,'minYear'=>date('Y')-1,'empty' => false,'templates'=>['select' => '<select class="form-control small-select" name="{{name}}"{{attrs}}>{{content}}</select>','dateWidget' => '<div class="col-md-9">{{day}}{{month}}{{year}}{{hour}}{{minute}}{{second}}{{meridian}}</div>']]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        <?php  echo $this->Form->input('generar_desde'); ?>
                        </div>
                        <div class="col-md-4">
                          <?php ?>
                        </div>
                        <div class="col-md-4">
                          <?php ?>
                        </div>
                    </div>
                 <div class="row">
                     <div class="col-md-6">
                         <div class="row">
                             <div class="col-md-12"><h3>Prima</h3></div>
                         </div>
                         <div class="row">
                             <div class="col-md-12"><?php  echo $this->Form->input('prima_neta_anual',['label'=>['text'=>'Prima Neta'],'templates'=>$templateSumData]); ?></div>
                         </div>
                         <div class="row">
                             <div class="col-md-12"><?php echo $this->Form->input('descuento',['label'=>['text'=>'Descuento (-)'],'value'=>0, 'templates'=>$templateSumData]); ; ?></div>
                         </div>
                         <div class="row">
                             <div class="col-md-12"><?php echo $this->Form->input('rec_pago_frac',['label'=>['text'=>'Rec. Pago Frac.'],'value'=>0, 'templates'=>$templateSumData]); ; ?></div>
                         </div>
                         <div class="row">
                             <div class="col-md-12"><?php echo $this->Form->input('gasto_expedicion',['label'=>['text'=>'Gastos Expedición'], 'templates'=>$templateSumData]); ; ?></div>
                         </div>
                         <div class="row">
                             <div class="col-md-12"><?php echo $this->Form->input('iva',['label'=>['text'=>'IVA (16%)'], 'templates'=>$templateSumData]); ; ?></div>
                         </div>
                         <div class="row">
                             <div class="col-md-12"><?php echo $this->Form->input('prima_total',['label'=>['text'=>'Prima Total'],
                                                                                    'templates'=>['input' => '<div class="col-sm-9"><input type="{{type}}" name="{{name}}" class="form-control text-right" {{attrs}}/></div>']
                                                                                    ]); ; ?></div>
                         </div>
                     </div>
                     <div class="col-md-6">
                        <div class="row">
                             <div class="col-md-12"><h3>Otros Datos</h3></div>
                        </div>
                        <div class="row">
                             <div class="col-md-12"><?php echo $this->Form->input('tipo_cliente_id', ['options' => $tipoClientes]); ?></div>
                        </div>
                        <div class="row">
                             <div class="col-md-12"><?php  echo $this->Form->input('modalidade_id', ['options' => $modalidades,'label'=>['text'=>'Modalidad']]); ?></div>
                        </div>
                        <div class="row">
                             <div class="col-md-12"><?php echo $this->Form->input('conducto_cobro_id', ['options' => $conductoCobros]);  ?></div>
                        </div>
                        <div class="row">
                             <div class="col-md-12"><?php  echo $this->Form->input('moneda_id', ['options' => $monedas]);  ?></div>
                        </div>
                        <div class="row">
                             <div class="col-md-12"><?php  echo $this->Form->input('forma_pago_id', ['options' => $formaPagos, 'empty'=>true]); ?></div>
                        </div>
                     </div>
                 </div> 
                 <div class="row">
                             <div class="col-md-12"><?php echo $this->Form->input('observaciones'); ?></div>
                </div>  
        <?php        
         // echo $this->Form->input('estatu_id', ['options' => $estatus, 'empty' => true]);
   
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
    $(document).ready(function () {
        $('body').addClass('mini-navbar')
        
        $('#beneficios-ids').multiselect({           
             enableFiltering: true,
            filterBehavior: 'text'
        });
        $('#operacione-id').empty();
        $('#ramo-id').empty();
        $('#producto-id').empty();
        $('#sub-ramo-id').empty();
      //  $('#sectore-id').change();
    });
</script>
<?php 

echo $this->Html->script('contratos.js');
?>
  <script type="text/javascript">
    
    var urlSelectOptions ="<?php echo $this->Url->build(array('controller' => 'contratos', 'action' => 'catalogos')); ?>";
    
</script> 
