 <div class="row wrapper border-bottom white-bg page-heading">
     <div class="col-lg-10">
         <h2><i class="fa fa-server"></i>&nbsp;<?= __('Servidores') ?></h2>
     </div>
     <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">
     <div class="row">
         <div class="col-lg-12">
             <div class="ibox float-e-margins">
                 <div class="ibox-title">
                     <h5><?= __('Lista de Servidores') ?></h5>
                 </div>
                 <div class="ibox-content">
                     <div class="row">
                         <div class="col-md-12">
                             <div class="btn-toolbar" role="toolbar">
                                 <div class="btn-group pull-right">
                                     <?php echo $this->Html->link( '<i class="fa fa-plus"></i> Nuevo', array('action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Agregar')); ?>
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
                                'input2' => '<input type="{{type}}" name="{{name}}" class="form-control" {{attrs}}/>',
                                'select' => ' <select name="{{name}}"{{attrs}} class="form-control input-sm">{{content}}</select>',
                                'label' => '<label  {{attrs}}>{{text}}</label>',
                                ];
                                $this->Form->templates($myTemplates); 
                                    echo $this->Form->label('Busqueda');

                                    echo $this->Form->create(null, ['url' => ['action' => 'buscar']]);
                                    echo $this->Form->input('descripcion',['label'=>false,'placeholder'=>'Descripción','required'=>false]);
                                    echo $this->Form->input('user',['label'=>false,'placeholder'=>'Usuario','required'=>false]);
                                    echo $this->Form->input('servicios',['label'=>false,'placeholder'=>'Servicios','required'=>false]);
                                    echo $this->Form->input('puertos',['label'=>false,'placeholder'=>'Puertos','required'=>false]);

                                    echo $this->Form->hidden('destino',array('default'=>'index')); //Debemos indicar  a donde se redigira despeus de aplicar la busqueda
                                    echo $this->Form->button(__('<i class="fa fa-search"></i> Buscar'),array('type'=>'submit','class'=>'btn btn-sm','div'=>false,'escape'=>false));
                                    if(!empty($argumentos))                            
                                    echo $this->Html->link(__('<i class="fa fa-list"></i>Ver Todos'),array('action' => 'buscar',1),array('class'=>'btn btn-primary  btn-sm','escape'=>false,'role'=>'button')); 
                                echo $this->Form->end();
                            ?>
                         </div>
                    </div>
                     <br>
                     <div class="table-responsive">
                         <table class="table table-striped table-hover table-index">
                             <thead>
                                 <tr>
                                     <th><?= $this->Paginator->sort('server_id','No Server') ?> <i
                                             class="fa fa-sort fa-1"></i></th>
                                     <th><?= $this->Paginator->sort('descripcion') ?> <i class="fa fa-sort fa-1"></i>
                                     </th>
                                     <th><?= $this->Paginator->sort('user','Usuario') ?> <i class="fa fa-sort fa-1"></i>
                                     </th>
                                     <th><?= $this->Paginator->sort('password') ?> <i class="fa fa-sort fa-1"></i></th>
                                     <th><?= $this->Paginator->sort('ip_interna') ?> <i class="fa fa-sort fa-1"></i>
                                     </th>
                                     <th><?= $this->Paginator->sort('ip_externa') ?> <i class="fa fa-sort fa-1"></i>
                                     </th>
                                     <th><?= $this->Paginator->sort('caracteristicas') ?> <i
                                             class="fa fa-sort fa-1"></i></th>
                                     <th><?= $this->Paginator->sort('servicios') ?> <i class="fa fa-sort fa-1"></i></th>
                                     <th><?= $this->Paginator->sort('puertos') ?> <i class="fa fa-sort fa-1"></i></th>
                                     <th><?= $this->Paginator->sort('co_user_id','Registró') ?> <i class="fa fa-sort fa-1"></i></th>

                                     <th class="actions"><?= __('Acciones') ?></th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php foreach ($servers as $server): ?>
                                 <tr>
                                     <td><?= $this->Number->format($server->server_id) ?></td>
                                     <td><?= $server->descripcion ?></td>
                                     <td><?= $server->user ?></td>
                                     <td><?= $server->password ?></td>

                                     <td><?= $server->ip_interna ?></td>

                                     <td><?= $server->ip_externa ?></td>
                                     <td><?= $server->caracteristicas ?></td>
                                     <td><?= $server->servicios ?></td>
                                     <td><?= $server->puertos ?></span></td>
                                     <td><?= $server->co_user->clave_nombre ?></td>

                                     <td class="actions">
                                         <?= $this->Html->link(__('<i class="fa fa-cogs" ></i>'), ['action' => 'view', $server->server_id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Ver','escape' => false]) ?>
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