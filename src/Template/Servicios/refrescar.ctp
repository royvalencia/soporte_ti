<?php
if ($tipo == 4) {
    echo 0;
}else {
    $cont = 0;
    foreach ($servicios as $servicio):
        $cont++;
    endforeach;
    echo $cont;
}
?>
