<?php
// Element para imprimir un pedido (orden o solicitud)
$bgColor ='';
if($imprimir==2){
  $bgColor='background-color: #cac5c5 !important;;';
}

 $mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
             "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
?>
<div class="row">
  <div class="col-md-12" style="<?= $bgColor;?>"><h3 style="text-align: center;<?php echo $bgColor ?>"><?php 
    
        echo $tipo.' de Pedido No. '. $pedido->id;
   
   ?></h3></div>
</div>
<br>
<div class="row">
  <div class="col-md-12 text-right">Chetumal, Quintana Roo,  a <?= date_format($pedido->fecha_pedido,'d'). ' de '. $mesesN[date_format($pedido->fecha_pedido,'m')] .' de '.date_format($pedido->fecha_pedido,'Y') ; ?> . 
    
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <p>
    <b>  <?=$pedido->cliente->nombre ?></b><br>
    <b> PRESENTE:</b><br><br>
    Por medio del presente me dirijo a usted para hacer de su conocimiento la <?= $tipo ?> previamente solicitada, la cual se describe a continuación:
   </p>
   <br>
  </div>
</div>
           
          <div class="row">
        <div class="related col-sm-11 col-sm-offset-1">            
            <?php if (!empty($pedido->detalle_pedidos)): ?>
            <table class="table" cellpadding="0" cellspacing="0" style="border: 1px solid #e7eaec;width: 100%">
                <tr style="background-color: #cac5c5 !important;;">                      
                        <th style="background-color: #cac5c5 !important;;">No.</th>
                        <th style="background-color: #cac5c5 !important;;"><?= __('Producto') ?></th>
                         <th style="background-color: #cac5c5 !important;;"><?= __('Descripción') ?></th>
                        <th style="background-color: #cac5c5 !important;;"><?= __('Cantidad Lt/Pz') ?></th>                     
                        <th style="background-color: #cac5c5 !important;;">Precio Unitario</th>
                        <th style="background-color: #cac5c5 !important;;">Importe</th>                       
                </tr>
                <?php 
                 $totalPedido =0;
                 $subtotal =0;
                 $impuestos =0;
                 $consecutivo=1;
                foreach ($pedido->detalle_pedidos as $detallePedidos):
                   if($imprimir==2 && $detallePedidos->cantidad<1){
                    continue; //No imprimimos los registros no asignados a la orden (cantidad ==0)
                   }
                 ?>
                <tr style="border: 1px solid #e7eaec;">
                   
                    <td style="border: 1px solid #e7eaec;"><?= $consecutivo ?></td>
                    <td  style="border: 1px solid #e7eaec;"><?= h($detallePedidos->productos_almacene->producto->descripcion). '. '. $detallePedidos->productos_almacene->producto->unidad_medida->descripcion; ?>
                      <?php if($detallePedidos->descuento>0): ?>
                            -<i> Precio <?= $this->Number->format($detallePedidos->precio_sin_descuento,['before'=>'$','places'=>2]) ?>. Desc. <?= $detallePedidos->descuento ?>%</i>
                       <?php  endif ?> 
                    </td>
                    <td  style="border: 1px solid #e7eaec;">
                      <?= $detallePedidos->productos_almacene->producto->detalle ?>
                    </td>
                    <td  style="border: 1px solid #e7eaec;"><?php
                      if($imprimir==2){ //Orden de Pedido
                          echo h($detallePedidos->cantidad); 
                       }else{
                         echo $detallePedidos->cantidad_solicitada;
                       }   
                     ?></td>
                  
                    <td  style="border: 1px solid #e7eaec;"><?= $this->Number->format($detallePedidos->precio_venta,['before'=>'$','places'=>2]) ?></td>
                    <td  style="border: 1px solid #e7eaec;"><?php
                      $total=0;
                      if($imprimir==1 ){ //Si se mando a imprimir la solicitud
                        $total = $detallePedidos->precio_venta *$detallePedidos->cantidad_solicitada;
                      }else{
                        $total = $detallePedidos->precio_venta *$detallePedidos->cantidad; 
                      }
                      $subtotal+=$total;
                      echo $this->Number->format($total,['before'=>'$','places'=>2]);
                      $consecutivo++;
                    ?></td>                                       
                </tr>
                 <?php endforeach;
                    $impuestos = number_format($subtotal*$pedido->iva,2);
                    $totalPedido = $subtotal+$impuestos;
                 ?>
               <tr>
                  <td colspan="5" style="text-align: right !important; font-weight: bolder;border: 1px solid #e7eaec;">SUBTOTAL</td>
                  <td style="font-weight: bolder;border: 1px solid #e7eaec;"><?= $this->Number->format($subtotal,['before'=>'$','places'=>2]); ?></td>
                </tr>
                <tr>
                  <td colspan="5" style="text-align: right; font-weight: bolder;border: 1px solid #e7eaec;">IVA</td>
                  <td style="font-weight: bolder;border: 1px solid #e7eaec;"><?= $this->Number->format($impuestos,['before'=>'$','places'=>2]); ?></td>
                </tr>
                <tr>
                  <td colspan="5" style="text-align: right; font-weight: bolder;border: 1px solid #e7eaec;">TOTAL</td>
                  <td style="font-weight: bolder;border: 1px solid #e7eaec;"><?= $this->Number->format($totalPedido,['before'=>'$','places'=>2]); ?></td>
                </tr>
            </table>
            <?php endif; ?>
        </div>
       </div>
  <?php if($pedido->status_pedido_id!=1 && $pedido->fecha_entrega && $imprimir==2): ?>
    <br>
    <div class="row">
      <div class="col-md-12">Fecha probable de entrega: <?= $pedido->fecha_entrega ?></div>
    </div>
  <?php endif ?>     
  
 <br>
Vigencia <?= $mesesN[(int)date('m', strtotime("+1 month"))] .' '.date('Y', strtotime("+1 month")) ?>.  Me reitero a sus apreciables órdenes para cualquier duda o aclaración.<br>  
Datos para pago: Banco Scotianbank N° Cliente 284979747, N° Cuenta 04606586120 y N° Clabe 044690046065861203. Condición de pago 28 días.
    
<br><br> <br>
<div class="row">
  <div class="col-md-12 text-center">
    <p style="" >ATENTAMENTE</p>
    Gerencia SmartClean<br>
    Cel. (52) 983 1678245
 </div>    
</div>