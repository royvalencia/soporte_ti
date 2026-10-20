<?php


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
echo $this->Element('pedido', ['pedido' => $pedido,'imprimir'=>$imprimir,'tipo'=>$tipo]);
?>


 
