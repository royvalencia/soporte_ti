 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Servicios') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><?= __('Lista de Servicios') ?></h5>                    
               </div>               
            <div class="ibox-content">   
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar">
                           <div class="btn-group pull-right">
                          <?php echo $this->Html->link( '<i class="fa fa-plus"></i> Nuevo', array('action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Agregar')); ?>                                   
                         </div>
                          <div class="btn-group pull-right">
                          
                           <?php echo $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', array('action' => 'servicios-excel'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Excel')); ?>                                   
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
                     echo $this->Form->input('descripcion_corta',['label'=>false,'placeholder'=>'Descripción Corta','required'=>false]);
                    
                      //echo $this->Form->input('cat_adscripcione_id', ['options' => $catAdscripciones,'label'=>false, 'empty'=>' - Área -']);
                      echo $this->Form->input('statu_id', ['options' => $status,'label'=>false, 'empty'=>' - Status -']);
                      echo $this->Form->input('tipo_servicio_id', ['options' => $tipoServicios,'label'=>false, 'empty'=>' - Tipo Servicio -']);
                      echo $this->Form->input('folio',['label'=>false,'placeholder'=>'Folio','required'=>false]);
                   
                                                              
                          
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
                                   <th><?= $this->Paginator->sort('servicio_id','Folio') ?> <i class="fa fa-sort fa-1"></i></th>

                                  <th><?= $this->Paginator->sort('fecha_solicitud') ?> <i class="fa fa-sort fa-1"></i></th>

                                  <th><?= $this->Paginator->sort('descripcion_corta','Descripción Corta') ?> <i class="fa fa-sort fa-1"></i></th>

                                  <th><?= $this->Paginator->sort('tipo_servicio_id') ?> <i class="fa fa-sort fa-1"></i></th>

                                  
                                  <th><?= $this->Paginator->sort('cat_adscripcione_id','Área Solicitante') ?> <i class="fa fa-sort fa-1"></i></th>

                                  
                                  <th><?= $this->Paginator->sort('fecha_limite_solucion','Fecha Límite') ?> <i class="fa fa-sort fa-1"></i></th>

                                  <th><?= $this->Paginator->sort('co_user_id','Responsable') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('fecha_solucion') ?> <i class="fa fa-sort fa-1"></i></th>

                                  <th><?= $this->Paginator->sort('statu_id','Status') ?> <i class="fa fa-sort fa-1"></i></th>
                                  
                                <th class="actions"><?= __('Acciones') ?></th>
                </tr>
             </thead>
             <tbody>
          <?php foreach ($servicios as $servicio): ?>
            <tr>
                <td><?= $this->Number->format($servicio->servicio_id) ?></td>
                <td><?= h(date_format($servicio->fecha_solicitud,'Y-m-d')) ?></td>
                <td><?= h($servicio->descripcion_corta) ?></td>
                <td><?= $servicio->tipo_servicio->descripcion." - ". $servicio->tipo_servicio->grupo->descripcion ?></td>
                
                <td><?= $servicio->cat_adscripcione->nom_ads ?></td>
                
                <td><?= h(date_format($servicio->fecha_limite_solucion,'Y-m-d')) ?></td>
                <td><?= $servicio->co_user->clave_nombre ?></td>
                <td><?php 

                if ($servicio->fecha_solucion==null){
                   echo $servicio->fecha_solucion;
                }else{ 
                  echo date_format($servicio->fecha_solucion,'Y-m-d');
                } ?></td>
                <!--<td><FONT COLOR="<?= $servicio->status->color ?>"><?= $servicio->status->descripcion ?></FONT></td>-->
                <?php 
                 if ($servicio->status->statu_id==1){
                  $badge = "badge-success";
                 }else if ($servicio->status->statu_id==3){
                  $badge = "badge-primary";
                 }else if ($servicio->status->statu_id==4){
                  $badge = "";
                 }
                ?>
                <td><span class="badge <?= $badge ?>"> <?= $servicio->status->descripcion ?></span></td>
               
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-th" ></i>'), ['action' => 'view', $servicio->servicio_id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Ver','escape' => false]) ?>
                    <?php if ($servicio->status->statu_id==1 OR (($servicio->status->statu_id==3 OR $servicio->status->statu_id==4) AND $grupo!=3)){ 
                    echo $this->Html->link(__('<i class="fa fa-edit" ></i>'), ['action' => 'edit', $servicio->servicio_id],['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Editar','escape' => false]);
                    } ?>
                    <?php if ($servicio->status->statu_id==1 OR ($servicio->status->statu_id==4 AND $grupo!=3)){
                      echo $this->Html->link(__('<i class="fa fa-check" ></i>'), ['action' => 'editsolucion', $servicio->servicio_id,3],['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Finalizar','escape' => false]);
                    } ?>
                    <?php if ($servicio->status->statu_id==1 OR ($servicio->status->statu_id==3 AND $grupo!=3)){ 
                    echo $this->Html->link(__('<i class="fa fa-ban" ></i>'), ['action' => 'editsolucion', $servicio->servicio_id,4],['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Cancelar','escape' => false]); 
                    } ?>
                   
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