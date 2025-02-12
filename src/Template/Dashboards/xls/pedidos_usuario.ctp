 <h2 id="page-heading"><?php echo 'Ventas por Usuario de '. $fechaInicio. ' a ' . $fechaFin;?></h2>    

            <table class="table table-striped table-hover table-index">
             <?php $tableHeaders =  $this->Html->tableHeaders(array('Usuario','Monto','Almacen'));
echo '<thead>'.$tableHeaders.'</thead>'; ?>
             <tbody>
          <?php foreach ($datosConsulta as $dato): ?>
            <tr>
                <td><?= $dato->usuario ?></td>
                <td><?= $dato->total ?></td>
                 <td><?= $dato->almacene_nombre ?></td>
           </tr>
            <?php endforeach; ?>
              </tbody>  
            </table>

 