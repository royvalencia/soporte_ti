<?php
/**
 * Template para facturacion se incluyen los datos de facturacion del cliente
 */

$bgColor ='';
if($imprimir==2){
  $bgColor='background-color: #cac5c5 !important;;';

}
 if($imprimir==1){
              $tipo='Cotización';  
            }else{
                $tipo='Orden';
            }
 $mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
             "Agosto","Septiembre","Octubre","Noviembre","Diciembre");           
 // Template/Element/pedido.ctp donde se especifica el template de pedidos para poder usarlo en otros views de otros controladores
?>
<div class="row">
  <div class="col-md-12" style="<?= $bgColor;?>"><h3 style="text-align: center;">Información del Cliente</h3></div>
</div>
<div class="row">
  <div class="col-md-12">
  	<p>
     <b>Cliente: <?= $pedido->cliente->nombre ?></b><br>    
   </p>
    <p>
     Razón Social: <?= $pedido->cliente->razon_social ?><br>    
   </p>
   <p>
     RFC: <?= $pedido->cliente->rfc ?><br>    
   </p>
   <p>
     Domicilio Facturación: <?= $pedido->cliente->domicilio_facturacion ?><br>    
   </p>
   <p>
    Email: <?= $pedido->cliente->email ?><br>    
   </p>
   <p>
     Tel. Oficina: <?= $pedido->cliente->telefono_oficina ?><br>    
   </p>
   <p>
     Tel. Celular: <?= $pedido->cliente->telefono_celular ?><br>    
   </p>
   <br>
  </div>
</div>
<?php
echo $this->Element('pedido', ['pedido' => $pedido,'imprimir'=>$imprimir,'tipo'=>$tipo]);
?>


 
