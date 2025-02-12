 <h2 id="page-heading"><?php echo 'Cantidad en Litros o Kilos vendida de '. $fechaInicio. ' a ' . $fechaFin;?></h2>    

            <table class="table table-striped table-hover table-index">
             <?php $tableHeaders =  $this->Html->tableHeaders(array('Producto','Cantidad Vendida en Lts. o Kgs.','Almacen'));
echo '<thead>'.$tableHeaders.'</thead>'; ?>
             <tbody>
          <?php foreach ($datosConsulta as $dato): ?>
            <tr>
                <td><?= $dato->producto_descripcion ?></td>
                <td><?= $dato->cantidad_vendida ?></td>
                 <td><?= $dato->almacene_nombre ?></td>
           </tr>
            <?php endforeach; ?>
              </tbody>  
            </table>

 