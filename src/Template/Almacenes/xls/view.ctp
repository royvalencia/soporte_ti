  <?php
  use Cake\Core\Configure;     
  ?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Detalle del Almacen') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">               
            <div class="ibox-content">   
             <br>      
             <div class="row">
                <div class="col-md-12">

                 <table class="table table-striped table-detalle" style="width: 100%;">
                  <tbody>                   
                    <tr>
                        <td class="field"><?= __('Clave') ?></td>
                        <td><?= h($almacene->clave) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Nombre') ?></td>
                        <td><?= h($almacene->nombre) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Descripción') ?></td>
                        <td><?= h($almacene->descripcion) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Teléfono') ?></td>
                        <td><?= h($almacene->telefono) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Domicilio') ?></td>
                        <td><?= h($almacene->domicilio) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Encargado') ?></td>
                        <td><?= h($almacene->encargado) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Longitud (X)') ?></td>
                        <td><?= h($almacene->x) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Latitud (Y)') ?></td>
                        <td><?= h($almacene->y) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('F. Alta') ?></td>
                        <td><?= h($almacene->created) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('F. Modificado') ?></td>
                        <td><?= h($almacene->modified) ?></td>
                    </tr>                   
              </tbody>  
            </table>
           
                </div>
               

             </div>
      <div class="row">
        <div class="related col-sm-11 col-sm-offset-1">
            <h3><?= __('Productos en el Almacen') ?></h3>
            <?php if (!empty($almacene->productos)):

             ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>                        
                        <th><?= __('Codigo') ?></th>
                        <th><?= __('Descripción') ?></th>
                        <th><?= __('Unidad Medida') ?></th>
                        <th><?= __('Proveedor') ?></th>
                        <th><?= __('Rubro') ?></th>
                        <th>Línea</th>
                        <th><?= __('Precio Compra') ?></th>
                        <th><?= __('Precio Venta') ?></th>       
                        <th>Existencia</th>               
                        
                </tr>
                <?php foreach ($almacene->productos as $productos): 
                        //pr($productos->_joinData->existencia);
                ?>
                <tr>
                    
                    <td><?= h($productos->codigo) ?></td>
                    <td><?= h($productos->descripcion) ?></td>
                    <td><?= h($productos->unidad_medida->descripcion) ?></td>
                     <td><?= h($productos->proveedore->nombre) ?></td>
                    <td>
                        <?php  if($productos->rubro)  echo $productos->rubro->descripcion;
                        ?>
                    </td>                    
                    <td><?php if($productos->linea)  echo  $productos->linea->descripcion; ?></td>
                    <td><?= $this->Number->format($productos->precio_compra,['before'=>'$','places'=>2]) ?></td>
                    <td><?= $this->Number->format($productos->precio_venta,['before'=>'$','places'=>2]) ?></td>
                    <td><?php  echo $productos->_joinData->existencia ?></td>                     
                    
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
<?php
      echo $this->Html->script('mapas.js'); //Mapas
      
      /**
      * PAra ver solo el punto del mapa basta con poner esto
      *  
      */
     echo "<script>editMode = false</script>";
      
 ?>

    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Configure::read('mapsApiKey'); ?>&callback=initMap"
    async defer></script>