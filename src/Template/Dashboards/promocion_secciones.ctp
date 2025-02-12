<div class="table-responsive"> 
            <table id="tableSecciones" class="table table-striped table-hover table-index" >
             <?php $tableHeaders =  $this->Html->tableHeaders(array('Seccion','Municipio','D. Federal','D. Local','Estructura','Promovidos','Total','Meta','% Avance'));
echo '<thead>'.$tableHeaders.'</thead>'; ?>
             <tbody>
          <?php 
            $totalActivista =0;
            $totalPromovidos = 0;
            $total = 0;
            $totalMeta =0;          
          foreach ($resumen as $dato):              
              $totalActivista+=$dato->total_activistas;
              $totalPromovidos+=$dato->total_promovidos;
              $totalMeta+=$dato->meta_promocion;              
           ?>
            <tr>
                <td><?= $dato->id; ?></td>
                <td><?= $dato->nombre_municipio; ?></td>
                <td><?= $dato->distrito_federal; ?></td>
                <td><?= $dato->distrito_local; ?></td>
                <td><?= !empty($dato->total_activistas) ? $dato->total_activistas : '0' ; ?></td>
                <td><?= !empty($dato->total_promovidos) ? $dato->total_promovidos : '0'; ?></td>
                <td>
                  <?php 
                    $total = (int)$dato->total_activistas+(int)$dato->total_promovidos;
                    echo $total;
                    if($dato->meta_promocion){
                        $avance = ($total/$dato->meta_promocion)*100;
                    }else{
                      $avance = 0;
                    }
                  ?>
                </td>
                <td><?= !empty( $dato->meta_promocion) ? $dato->meta_promocion : '0'; ?></td>
                <td><?= number_format($avance,2). '%' ?></td>               
           </tr>
            <?php endforeach; ?>            
              </tbody>  
            </table>
</div>
<script type="text/javascript">
              $('#tableSecciones').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [                  
                ],
                "bLengthChange": false,

            });
</script>
 