 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Cat Instituciones') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><?= __('Lista de Cat Instituciones') ?></h5>                    
               </div>               
            <div class="ibox-content">   
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-toolbar" role="toolbar">
                           <div class="btn-group pull-right">
                          <?php echo $this->Html->link( '<i class="fa fa-plus"></i> Nuevo', array('action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Agregar')); ?>                                   
                         </div>
    
                                                         <div class="btn-group pull-right"  >
                                <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> Cat Adscripciones'), ['controller' => 'CatAdscripciones', 'action' => 'index'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista Cat Adscripciones')); ?>
                                <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> Agregar Cat Adscripcione'), ['controller' => 'CatAdscripciones', 'action' => 'add'], array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Cat Adscripcione')) ?>
                             </div>   
                                               </div> 
                    </div>
               </div>
            <br>
            <table class="table table-striped table-hover table-index">
              <thead>
                <tr>                 
                                   <th><?= $this->Paginator->sort('id_institucion') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('num_adscripcion') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('num_organo') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('nombre') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('tipo_institucion_id') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('estado') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('bloquear_funciones') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('rfc') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('partida_convertida_sag') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('created') ?> <i class="fa fa-sort fa-1"></i></th>
                                  <th><?= $this->Paginator->sort('modified') ?> <i class="fa fa-sort fa-1"></i></th>
                                <th class="actions"><?= __('Acciones') ?></th>
                </tr>
             </thead>
             <tbody>
          <?php foreach ($catInstituciones as $catInstitucione): ?>
            <tr>
                <td><?= $this->Number->format($catInstitucione->id_institucion) ?></td>
                <td><?= $this->Number->format($catInstitucione->num_adscripcion) ?></td>
                <td><?= $this->Number->format($catInstitucione->num_organo) ?></td>
                <td><?= h($catInstitucione->nombre) ?></td>
                <td><?= $this->Number->format($catInstitucione->tipo_institucion_id) ?></td>
                <td><?= $this->Number->format($catInstitucione->estado) ?></td>
                <td><?= h($catInstitucione->bloquear_funciones) ?></td>
                <td><?= h($catInstitucione->rfc) ?></td>
                <td><?= $this->Number->format($catInstitucione->partida_convertida_sag) ?></td>
                <td><?= h($catInstitucione->created) ?></td>
                <td><?= h($catInstitucione->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-th" ></i>'), ['action' => 'view', $catInstitucione->id_institucion], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Ver','escape' => false]) ?>
                    <?= $this->Html->link(__('<i class="fa fa-edit" ></i>'), ['action' => 'edit', $catInstitucione->id_institucion],['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Editar','escape' => false]) ?>
                    <?= $this->Form->postLink(__('<i class="fa fa-trash-o" ></i>'), ['action' => 'delete', $catInstitucione->id_institucion], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Eliminar','escape' => false,'confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $catInstitucione->id_institucion)]) ?>
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