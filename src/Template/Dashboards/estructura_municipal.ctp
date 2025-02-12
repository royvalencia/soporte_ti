<div class="table-responsive"> 
            <table class="table table-striped table-hover table-index">
             <?php $tableHeaders =  $this->Html->tableHeaders(array('Municipio','Coord. Municipal','Coord. Distrital','Coord. Zona','Coord. Sección','Activistas','Total'));
echo '<thead>'.$tableHeaders.'</thead>'; ?>
             <tbody>
          <?php 
            $totalMunicipio =0;
            $totalDistrital = 0;
            $totalZona = 0;
            $totalSeccion =0;
            $totalActivista = 0;
          foreach ($estructuraMunicipal as $dato):
              $totalMunicipio+=$dato['coordinador_municipal'];
              $totalDistrital+=$dato['coordinador_distrital'];
              $totalZona+=$dato['coordinador_zona'];
              $totalSeccion+=$dato['coordinador_seccion'];
              $totalActivista+=$dato['activista'];
           ?>
            <tr>
                <td><?= $dato['nombre_municipio'] ?></td>
                <td><?= $dato['coordinador_municipal'] ?></td>
                <td><?= $dato['coordinador_distrital'] ?></td>
                <td><?= $dato['coordinador_zona'] ?></td>
                <td><?= $dato['coordinador_seccion'] ?></td>
                <td><?= $dato['activista'] ?></td>
                <td><?php 
                    $total = $dato['coordinador_municipal']+$dato['coordinador_distrital']+$dato['coordinador_zona']+$dato['coordinador_seccion']+$dato['activista'];
                    echo $total;
                ?></td>
           </tr>
            <?php endforeach; ?>
            <tr>
                <td><b>TOTAL</b></td>
                <td><b><?= $totalMunicipio ?></b></td>
                <td><b><?= $totalDistrital ?></b></td>
                <td><b><?= $totalZona ?></b></td>
                <td><b><?= $totalSeccion ?></b></td>
                <td><b><?= $totalActivista ?></b></td>
                <td><b><?php 
                    $total = $totalMunicipio+$totalDistrital+$totalZona+$totalSeccion+$totalActivista;
                    echo $total;

                ?></b></td>
            </tr>
              </tbody>  
            </table>
</div>
 