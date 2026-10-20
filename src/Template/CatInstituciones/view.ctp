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
                 <h5><i class="fa fa-th"></i> <?= __('Detalle de  Cat Institucione');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $catInstitucione->id_institucion), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',$catInstitucione->id_institucion), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', $catInstitucione->id_institucion)); ?> 
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Cat Instituciones','escape' => false)); ?> 
                     </div>
                             <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'CatAdscripciones', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Cat Adscripciones'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'CatAdscripciones', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Cat Adscripcione '));
                                   
                                 ?>                               
                              </div>    
                                                 
                   </div> 
                </div>
            </div>
            <br>      
             <div class="">
                 <table class="table table-striped table-detalle" style="width: 100%;">
                  <tbody>
                    <tr>
                        <td class="field"><?= __('Id Institucion') ?></td>
                        <td><?= h($catInstitucione->id_institucion) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Num Adscripcion') ?></td>
                        <td><?= h($catInstitucione->num_adscripcion) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Num Organo') ?></td>
                        <td><?= h($catInstitucione->num_organo) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Nombre') ?></td>
                        <td><?= h($catInstitucione->nombre) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Tipo Institucion Id') ?></td>
                        <td><?= h($catInstitucione->tipo_institucion_id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Estado') ?></td>
                        <td><?= h($catInstitucione->estado) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Bloquear Funciones') ?></td>
                        <td><?= h($catInstitucione->bloquear_funciones) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Rfc') ?></td>
                        <td><?= h($catInstitucione->rfc) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Partida Convertida Sag') ?></td>
                        <td><?= h($catInstitucione->partida_convertida_sag) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Created') ?></td>
                        <td><?= h($catInstitucione->created) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Modified') ?></td>
                        <td><?= h($catInstitucione->modified) ?></td>
                    </tr>
              </tbody>  
            </table>
             </div>
      <div class="row">
        <div class="related col-sm-10 col-sm-offset-2">
            <h3><?= __('Related Cat Adscripciones') ?></h3>
            <?php if (!empty($catInstitucione->cat_adscripciones)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                        <th><?= __('Cat Adscripcione Id') ?></th>
                        <th><?= __('Cve Ads') ?></th>
                        <th><?= __('Nom Ads') ?></th>
                        <th><?= __('Cat Institucione Id') ?></th>
                        <th><?= __('Cveusuad') ?></th>
                        <th><?= __('Cveucoad') ?></th>
                        <th><?= __('Estatus') ?></th>
                        <th><?= __('Vigencia Inicial') ?></th>
                        <th><?= __('Vigencia Final') ?></th>
                        <th><?= __('Anio') ?></th>
                        <th><?= __('Created') ?></th>
                        <th><?= __('Modified') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($catInstitucione->cat_adscripciones as $catAdscripciones): ?>
                <tr>
                    <td><?= h($catAdscripciones->cat_adscripcione_id) ?></td>
                    <td><?= h($catAdscripciones->cve_ads) ?></td>
                    <td><?= h($catAdscripciones->nom_ads) ?></td>
                    <td><?= h($catAdscripciones->cat_institucione_id) ?></td>
                    <td><?= h($catAdscripciones->cveusuad) ?></td>
                    <td><?= h($catAdscripciones->cveucoad) ?></td>
                    <td><?= h($catAdscripciones->estatus) ?></td>
                    <td><?= h($catAdscripciones->vigencia_inicial) ?></td>
                    <td><?= h($catAdscripciones->vigencia_final) ?></td>
                    <td><?= h($catAdscripciones->anio) ?></td>
                    <td><?= h($catAdscripciones->created) ?></td>
                    <td><?= h($catAdscripciones->modified) ?></td>
                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                            <?= $this->Html->link(__('Ver'), ['controller' => 'CatAdscripciones', 'action' => 'view', $catAdscripciones->cat_adscripcione_id],['class' => 'btn btn-default btn-sm']) ?>
                            <?= $this->Html->link(__('Editar'), ['controller' => 'CatAdscripciones', 'action' => 'edit', $catAdscripciones->cat_adscripcione_id],['class' => 'btn btn-default btn-sm']) ?>
                            <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'CatAdscripciones', 'action' => 'delete', $catAdscripciones->cat_adscripcione_id], ['class' => 'btn btn-default btn-sm','confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $catAdscripciones->cat_adscripcione_id)]) ?>
                          </div>  
                       </div> 
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
       </div> 
    
             </div>
          </div>
               
        </div>
    </div>
</div>    