 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Contratos') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><?= __('Lista de Contratos') ?></h5>                    
               </div>               
            <div class="ibox-content">   
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar">
                           <div class="btn-group pull-right">
                          <?php echo $this->Html->link( '<i class="fa fa-plus"></i> Nuevo Contrato', array('controller'=>'Clientes', 'action' => 'index'), array('class' => 'btn btn-primary','escape'=>false,'rel'=>'tooltip', 'title'=>'Para agregar un contrato primero seleccione a ún cliente')); ?>                                   
                         </div>
    
                                
                                                      
                                               </div> 
                    </div>
               </div>
               <div class="row">
               <div class="col-md-12">
            <?php                   
                  $myTemplates = [
                 'formStart' => '<form{{attrs}} class="form-inline">',
                 'inputContainer' => '<div class="form-group container-inline {{type}}{{required}}">{{content}}</div>',
                 'input' => '<input type="{{type}}" name="{{name}}" class="form-control input-sm" {{attrs}}/>',
                 'select' => ' <select name="{{name}}"{{attrs}} class="form-control input-sm">{{content}}</select>',
                 'label' => '<label  {{attrs}}>{{text}}</label>',
              
            ];
            $this->Form->templates($myTemplates);                    
                     echo $this->Form->create(null, ['url' => ['action' => 'buscar','id'=>'searchForm']])  ;               
                   
                   
                     echo $this->Form->input('no_contrato',['label'=>false,'placeholder'=>'No. contrato/poliza','required'=>false,'title'=>'Buscar por Número de contrato o póliza']);                      
                      echo $this->Form->hidden('destino',array('default'=>'index')); //Debemos indicar  a donde se redigira despeus de aplicar la busqueda

                      echo $this->Form->button(__('<i class="fa fa-search"></i> Buscar'),array('type'=>'submit','class'=>'btn btn-sm','div'=>false,'escape'=>false));
                      
                            if(!empty($argumentos))                            
                                echo $this->Html->link(__('<i class="fa fa-list"></i>Ver Todos'),array('action' => 'buscar',1),array('class'=>'btn btn-primary  btn-sm','escape'=>false,'role'=>'button')); 

                   
            ?>
            
           
            <?php                   
            echo $this->Form->end();
             ?>
              </div>
                </div>
            <br>
            <div class="table-responsive">
            <table class="table table-striped table-hover table-index">
              <thead>
                <tr>                 
                                   <th><?= $this->Paginator->sort('id','Folio') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('cliente_id') ?> <i class="fa fa-sort fa-1"></i></th>                                 
                                  <th><?= $this->Paginator->sort('no_contrato') ?> <i class="fa fa-sort fa-1"></i></th>
                                  
                                  
                                  <th><?= $this->Paginator->sort('empresa_id') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('sectore_id','Sector') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('operacione_id','Operación') ?> <i class="fa fa-sort fa-1"></i></th>
                                  
                                
                                 
                                  <th><?= $this->Paginator->sort('fecha_emision','F. Emisión') ?> <i class="fa fa-sort fa-1"></i></th>
                             
                                  <th><?= $this->Paginator->sort('prima_total') ?> <i class="fa fa-sort fa-1"></i></th>
                               
                                <th class="actions"><?= __('Acciones') ?></th>
                </tr>
             </thead>
             <tbody>
          <?php foreach ($contratos as $contrato): ?>
            <tr>
                <td><?= $this->Number->format($contrato->id) ?></td>
                <td><?= $contrato->has('cliente') ? $this->Html->link($contrato->cliente->full_name, ['controller' => 'Clientes', 'action' => 'view', $contrato->cliente->id]) : '' ?></td>
               
                <td><?= h($contrato->no_contrato) ?></td>
                
                
                <td><?= $contrato->has('empresa') ? $this->Html->link($contrato->empresa->nombre, ['controller' => 'Empresas', 'action' => 'view', $contrato->empresa->id]) : '' ?></td>
                <td><?= $contrato->has('sectore') ? $contrato->sectore->descripcion : '' ?></td>
                <td><?= $contrato->has('operacione') ? $contrato->operacione->descripcion : '' ?></td>
                
               
    
                <td><?= h($contrato->fecha_emision) ?></td>
                
                <td><?= '$ '. $this->Number->format($contrato->prima_total) ?></td>
               
                <td class="actions">
                  
                    <?= $this->Html->link(__('<i class="fa fa-th" ></i>'), ['action' => 'view', $contrato->id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Ver','escape' => false]) ?>
                    <?= $this->Html->link(__('<i class="fa fa-edit" ></i>'), ['action' => 'edit', $contrato->id],['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Editar','escape' => false]) ?>
                    <?= $this->Form->postLink(__('<i class="fa fa-trash-o" ></i>'), ['action' => 'delete', $contrato->id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Eliminar','escape' => false,'confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $contrato->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
              </tbody>  
            </table>
            </div>
            <div class="row">
             <div class="col-md-6" style="margin-bottom: 10px;">
                  <?php 
                    echo $this->Paginator->counter(array(
                     'format' => __('Mostrando del {{start}} al {{end}} de un total de {{count}}')
                    ));
                  ?>
              </div>
             <div class="col-md-6">
                <div class="pagination borderless pull-right custom-pagination">
                    <?php
                      echo $this->Paginator->prev(' << ' . __('Anterior'), array('class' => 'prev btn'), null, array('class' => 'prev disabled btn'));
                      echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn', 'currentClass' => 'active'));
                      echo $this->Paginator->next(__('Siguiente') . ' >> ', array('class' => 'next btn'), null, array('class' => 'next disabled btn'));
                    ?>
                 </div>
             </div>   
            </div>
            
         </div>
       </div>         
      </div>
    </div>
</div>    