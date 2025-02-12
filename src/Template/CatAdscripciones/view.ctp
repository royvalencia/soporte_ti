<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Cat Adscripciones') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle de  Cat Adscripcione');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $catAdscripcione->cat_adscripcione_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',$catAdscripcione->cat_adscripcione_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', $catAdscripcione->cat_adscripcione_id)); ?> 
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Cat Adscripciones','escape' => false)); ?> 
                     </div>
                             <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'CatInstituciones', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Cat Instituciones'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'CatInstituciones', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Cat Institucione '));
                                   
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
                        <td class="field"><?= __('Cat Adscripcione Id') ?></td>
                        <td><?= h($catAdscripcione->cat_adscripcione_id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Cve Ads') ?></td>
                        <td><?= h($catAdscripcione->cve_ads) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Nom Ads') ?></td>
                        <td><?= h($catAdscripcione->nom_ads) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Cat Institucione') ?></td>
                        <td><?= $catAdscripcione->has('cat_institucione') ? $this->Html->link($catAdscripcione->cat_institucione->id_institucion, ['controller' => 'CatInstituciones', 'action' => 'view', $catAdscripcione->cat_institucione->id_institucion]) : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Cveusuad') ?></td>
                        <td><?= h($catAdscripcione->cveusuad) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Cveucoad') ?></td>
                        <td><?= h($catAdscripcione->cveucoad) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Estatus') ?></td>
                        <td><?= h($catAdscripcione->estatus) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Vigencia Inicial') ?></td>
                        <td><?= h($catAdscripcione->vigencia_inicial) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Vigencia Final') ?></td>
                        <td><?= h($catAdscripcione->vigencia_final) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Anio') ?></td>
                        <td><?= h($catAdscripcione->anio) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Created') ?></td>
                        <td><?= h($catAdscripcione->created) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Modified') ?></td>
                        <td><?= h($catAdscripcione->modified) ?></td>
                    </tr>
              </tbody>  
            </table>
             </div>

             </div>
          </div>
               
        </div>
    </div>
</div>    