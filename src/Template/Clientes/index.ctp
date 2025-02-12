 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Cartera  de Clientes') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><?= __('Listado de Clientes') ?></h5>                    
               </div>               
            <div class="ibox-content">   
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar">
                           <div class="btn-group pull-right">
                          <?php echo $this->Html->link( '<i class="fa fa-plus"></i> Nuevo Cliente', array('action' => 'add'), array('class' => 'btn btn-primary','escape'=>false,'rel'=>'tooltip', 'title'=>'Agregar')); ?>                                   
                         </div>
                          <div class="btn-group pull-right">                          
                           <?php echo $this->Html->link( '<i class="fa fa-file-excel-o"></i> Exportar', array('action' => 'clientes-report','_ext'=>'xls'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Excel')); ?>
                            <?php echo $this->Html->link( '<i class="fa fa-file-pdf-o"></i> Imprimir', array('action' => 'clientes-report','_ext' => 'pdf'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'PDF')); ?>    
                             

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
                     echo $this->Form->input('id',['label'=>false,'placeholder'=>'ID del Cliente','required'=>false,'title'=>'Buscar ID del cliente']);                      
                     echo $this->Form->input('nombre',['label'=>false,'placeholder'=>'A. Paterno + A. Materno + Nombres','required'=>false,'title'=>'Buscar por A. Paterno + A. Materno + Nombres']);
                     echo $this->Form->input('razon_social',['label'=>false,'placeholder'=>'Razón Social','required'=>false,'title'=>'Buscar por Razón Social']);                      
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
            <table class="table table-striped table-hover table-index">
              <thead>
                <tr>                 
                                   <th><?= $this->Paginator->sort('id') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('apellido_paterno') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('apellido_materno') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('nombre') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('razon_social') ?> <i class="fa fa-sort fa-1"></i></th>
                                 
                                <th class="actions"><?= __('Acciones') ?></th>
                </tr>
             </thead>
             <tbody>
          <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?= $this->Number->format($cliente->id) ?></td>
                <td><?= h($cliente->apellido_paterno) ?></td>
                <td><?= h($cliente->apellido_materno) ?></td>
                <td><?= h($cliente->nombre) ?></td>
                <td><?= h($cliente->razon_social) ?></td>
               
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-th" ></i>'), ['action' => 'view', $cliente->id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Ver detalle del cliente  y administrar ubicaciones y contratos','escape' => false]) ?>
                    <?= $this->Html->link(__('<i class="fa fa-edit" ></i>'), ['action' => 'edit', $cliente->id],['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Editar datos generales del cliente','escape' => false]) ?>
                    <?= $this->Form->postLink(__('<i class="fa fa-trash-o" ></i>'), ['action' => 'delete', $cliente->id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Eliminar cliente y toda su información','escape' => false,'confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $cliente->id)]) ?>
                    <?= $this->Html->link(__('<i class="fa fa-plus" ></i> Contrato'), ['controller'=>'contratos', 'action' => 'add', $cliente->id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Nuevo Contrato','escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
              </tbody>  
            </table>
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