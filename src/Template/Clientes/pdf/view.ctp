<?php 
echo $this->Html->script('inspinia/plugins/emodal/eModal.min', array('inline' => true)); 

    echo $this->Html->css('inspinia/plugins/jasny/jasny-bootstrap.min');
      echo $this->Html->script('inspinia/plugins/jasny/jasny-bootstrap.min', array('inline' => true)); 
 ?>

 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle del  Cliente');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               
            <br>      
             <div class="">
                 <table class="table table-striped table-detalle" style="width: 100%;">
                  <tbody>
                    <tr>
                        <td class="field"><?= __('Id') ?></td>
                        <td colspan="5"><?= h($cliente->id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Apellido Paterno') ?></td>
                        <td><?= h($cliente->apellido_paterno) ?></td>
                   
                        <td class="field"><?= __('Apellido Materno') ?></td>
                        <td><?= h($cliente->apellido_materno) ?></td>
                 
                        <td class="field"><?= __('Nombre') ?></td>
                        <td><?= h($cliente->nombre) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Razon Social') ?></td>
                        <td colspan="5"><?= h($cliente->razon_social) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('RFC') ?></td>
                        <td><?= h($cliente->rfc) .' - '.$cliente->homoclave ?></td>                   
                        <td class="field"><?= __('CURP') ?></td>
                        <td colspan="3"><?= h($cliente->homoclave) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Genero') ?></td>
                        <td><?= h($cliente->genero) ?></td>                   
                        <td class="field"><?= __('Estado Civil') ?></td>
                        <td colspan="3"><?= h($cliente->estado_civil) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Fecha Nacimiento') ?></td>
                        <td><?= h($cliente->fecha_nacimiento) ?></td>     
                        <td class="field"><?= __('Ocupación') ?></td>
                        <td colspan="3"><?= $cliente->has('ocupacione') ? $cliente->ocupacione->descripcion : '' ?></td>             
                       
                    </tr>
                    <tr>
                         <td class="field"><?= __('Lugar Nacimento') ?></td>
                        <td ><?= h($cliente->lugar_nacimento) ?></td>
                        <td class="field"><?= __('Nacionalidad') ?></td>
                        <td ><?= h($cliente->nacionalidad) ?></td>                 
                        <td class="field"><?= __('Grupo') ?></td>
                        <td><?= h($cliente->grupo) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Observaciones') ?></td>
                        <td colspan="5"><?= h($cliente->observaciones) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('F. Alta') ?></td>
                        <td><?= h($cliente->created) ?></td>
                    
                        <td class="field"><?= __('F. Modificado') ?></td>
                        <td colspan="3"><?= h($cliente->modified) ?></td>
                    </tr>
                    
              </tbody>  
            </table>
             </div>
      <div class="row">
        <div class="related col-sm-10 col-sm-offset-2">
            <h3><?= __('Ubicaciones') ?></h3>

            <?php if (!empty($cliente->ubicaciones)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                       
                        <th><?= __('Calle') ?></th>
                        <th><?= __('No. Ext.') ?></th>
                        
                        <th><?= __('Colonia') ?></th>
                        <th><?= __('Ciudad Municipio') ?></th>                      
                       
                        <th><?= __('Tel. Casa') ?></th>
                        <th><?= __('Tel. Celular') ?></th>
                        <th><?= __('Tel. Oficina') ?></th>
                        <th><?= __('Extension') ?></th>
                     

                       
                </tr>
                <?php foreach ($cliente->ubicaciones as $ubicaciones): ?>
                <tr>
                   
                    <td><?= h($ubicaciones->calle) ?></td>
                    <td><?= h($ubicaciones->no_ext) ?></td>                  
             
                    <td><?= h($ubicaciones->colonia) ?></td>
                    <td><?= h($ubicaciones->ciudad_municipio) ?></td>
                   
                    <td><?= h($ubicaciones->telefono_casa) ?></td>
                    <td><?= h($ubicaciones->telefono_celular) ?></td>
                    <td><?= h($ubicaciones->telefono_oficina) ?></td>
                    <td><?= h($ubicaciones->extension) ?></td>
                  

                   
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
 