 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Usuarios') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><?= __('Lista de Usuarios') ?></h5>                    
               </div>               
            <div class="ibox-content">   
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar">
                           <div class="btn-group pull-right">
                          <?php echo $this->Html->link( '<i class="fa fa-plus"></i> Nuevo', array('action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Agregar')); ?>                                   
                         </div>
                         <div class="btn-group pull-right">
                          <?php echo $this->Html->link( '<i class="fa fa-file-pdf-o"></i> PDF', array('action' => 'usuarios-pdf'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'PDF')); ?>  
                           <?php echo $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', array('action' => 'usuarios-excel'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Excel')); ?>                                   
                         </div>
    <div class="btn-group pull-right"  >
                                <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> Bitácora'), ['controller' => 'Bitacoras', 'action' => 'index'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Bitácora de actividades')); ?>
                                
                             </div>   
    
                                                         <div class="btn-group pull-right"  >
                                <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> Grupos'), ['controller' => 'CoGroups', 'action' => 'index'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista Grupos de Usuarios')); ?>
                                
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
                     echo $this->Form->create(null, ['url' => ['action' => 'buscar']]);
                     echo $this->Form->input('login',['label'=>false,'placeholder'=>'login','required'=>false]);
                     echo $this->Form->input('nombre',['label'=>false,'placeholder'=>'Nombre Completo','required'=>false]);                     
                      echo $this->Form->input('co_group_id', ['options' => $coGroups,'label'=>false, 'empty'=>' - Grupo -']);
                   
                                                              
                          
                      echo $this->Form->hidden('destino',array('default'=>'index')); //Debemos indicar  a donde se redigira despeus de aplicar la busqueda
                      echo $this->Form->button(__('<i class="fa fa-search"></i> Buscar'),array('type'=>'submit','class'=>'btn btn-sm','div'=>false,'escape'=>false));
                            if(!empty($argumentos))                            
                                echo $this->Html->link(__('<i class="fa fa-list"></i>Ver Todos'),array('action' => 'buscar',1),array('class'=>'btn btn-primary  btn-sm','escape'=>false,'role'=>'button')); 
            echo $this->Form->end();
             ?>
                 </div>
                </div>
            <br>
            <table class="table table-striped table-hover table-index">
              <thead>
                <tr>                 
                                   <th><?= $this->Paginator->sort('co_user_id','Id') ?> <i class="fa fa-sort fa-1"></i></th>
                                 
                                  <th><?= $this->Paginator->sort('login') ?> <i class="fa fa-sort fa-1"></i></th>
                                 
                                  <th><?= $this->Paginator->sort('nombre') ?> <i class="fa fa-sort fa-1"></i></th>
                                  
                                  <th><?= $this->Paginator->sort('co_group_id','Grupo') ?> <i class="fa fa-sort fa-1"></i></th>
                                  
                                  <th><?= $this->Paginator->sort('active','Activo') ?> <i class="fa fa-sort fa-1"></i></th>                                  
                                <th class="actions"><?= __('Acciones') ?></th>
                </tr>
             </thead>
             <tbody>
          <?php foreach ($coUsers as $coUser): ?>
            <tr>
                <td><?= $this->Number->format($coUser->co_user_id) ?></td>
              
                <td><?= h($coUser->login) ?></td>
                
                <td><?= h($coUser->nombre) ?></td>
                
                <td><?= $coUser->has('co_group') ? $this->Html->link($coUser->co_group->name, ['controller' => 'CoGroups', 'action' => 'view', $coUser->co_group->co_group_id]) : '' ?></td>
                 
                <td><?= ($coUser->active) ? 'Si' : 'No' ?></td>
               
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-th" ></i>'), ['action' => 'view', $coUser->co_user_id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Ver','escape' => false]) ?>
                    <?= $this->Html->link(__('<i class="fa fa-edit" ></i>'), ['action' => 'edit', $coUser->co_user_id],['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Editar','escape' => false]) ?>
                    <?= $this->Form->postLink(__('<i class="fa fa-trash-o" ></i>'), ['action' => 'delete', $coUser->co_user_id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Eliminar','escape' => false,'confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $coUser->co_user_id)]) ?>
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