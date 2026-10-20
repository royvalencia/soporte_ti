<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Bitacoras') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle de  Bitacora');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $bitacora->bitacora_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',$bitacora->bitacora_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', $bitacora->bitacora_id)); ?> 
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Bitacoras','escape' => false)); ?> 
                     </div>
                      
                   </div> 
                </div>
            </div>
            <br>      
             <div class="">
                 <table class="table table-striped table-detalle" style="width: 100%;">
                  <tbody>
                    <tr>
                        <td class="field"><?= __('Bitacora Id') ?></td>
                        <td><?= h($bitacora->bitacora_id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Usuario') ?></td>
                        <td><?= h($bitacora->usuario) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Ip') ?></td>
                        <td><?= h($bitacora->ip) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Fecha') ?></td>
                        <td><?= h($bitacora->fecha) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Descripcion') ?></td>
                        <td>
                        <?php
                        if(strstr($bitacora->descripcion,"|")){
                          
                            $cadena = explode("|",$bitacora->descripcion);                          
                            foreach($cadena as $string){
                               $valorSalida = (json_decode($string)!=false) ? json_decode($string,JSON_PRETTY_PRINT) : $string;
                               pr($valorSalida);
                            }
                        }else{
                            echo $bitacora->descripcion;
                        }
                       ?> 
                        
                        </td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Referencia') ?></td>
                        <td><?= h($bitacora->referencia) ?></td>
                    </tr>
                    <tr>
                      <td class="field">Data</td>
                      <td><code><?php pr(json_decode($bitacora->data,JSON_PRETTY_PRINT)) ?></code></td>
                    </tr>
              </tbody>  
            </table>
             </div>

             </div>
          </div>
               
        </div>
    </div>
</div>    