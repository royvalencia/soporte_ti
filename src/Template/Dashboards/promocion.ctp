<div class="table-responsive"> 
            <table class="table table-striped table-hover table-index">
             <?php $tableHeaders =  $this->Html->tableHeaders(array($nombreCol,'Estructura','Promovidos','Total','Meta','% Avance'));
echo '<thead>'.$tableHeaders.'</thead>'; ?>
             <tbody>
          <?php 
            $totalActivista =0;
            $totalPromovidos = 0;
            $total = 0;
            $totalMeta =0;          
          foreach ($resumen as $dato):              
              $totalActivista+=$dato->totalActivistas;
              $totalPromovidos+=$dato->totalPromovidos;
              $totalMeta+=$dato->metaPromocion;              
           ?>
            <tr>
                <td><?= $dato->titulo; ?></td>
                <td><?= !empty($dato->totalActivistas) ? $dato->totalActivistas : '0' ; ?></td>
                <td><?= !empty($dato->totalPromovidos) ? $dato->totalPromovidos : '0'; ?></td>
                <td>
                  <?php 
                    $total = (int)$dato->totalActivistas+(int)$dato->totalPromovidos;
                    echo $total;
                    if($dato->metaPromocion){
                        $avance = ($total/$dato->metaPromocion)*100;
                    }else{
                      $avance = 0;
                    }
                  ?>
                </td>
                <td><?= !empty( $dato->metaPromocion) ? $dato->metaPromocion : '0'; ?></td>
                <td><?= number_format($avance,2). '%' ?></td>               
           </tr>
            <?php endforeach; ?>
            <tr>
                <td><b>TOTAL</b></td>
                <td><b><?= $totalActivista ?></b></td>
                <td><b><?= $totalPromovidos ?></b></td>
                <td><b>
                   <?php 
                    $total = $totalActivista+$totalPromovidos;
                    echo $total;
                    if($totalMeta>0){
                        $avance = ($total/$totalMeta)*100;
                    }else{
                      $avance = 0;
                    }
                   ?>
                  </b></td>
                <td><b><?= $totalMeta ?></b></td>
                <td><b><?= number_format($avance,2). '%' ; ?></b></td>                
            </tr>
              </tbody>  
            </table>
</div>
 