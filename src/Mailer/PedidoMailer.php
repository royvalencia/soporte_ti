<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\Core\Configure;

class PedidoMailer extends Mailer
{
    public function solicitud($pedido)
    {
        $imprimir = 1;
       // pr($imprimir);
      return  $this
            ->from(['atencion@smart-clean.com.mx'=>'Atencion a Clientes'])
            ->to($pedido->cliente->email)
            ->subject(sprintf('Cotizacion de Pedido No.'. $pedido->id .' - '.$pedido->cliente->nombre))
            ->setTemplate('pedido') // By default template with same name as method name is used.
            ->emailFormat('html')
             ->viewVars([
            'pedido'=> $pedido,
            'imprimir'=>$imprimir
            ]);
    }

     public function orden($pedido)
    {
        $imprimir = 2;
      return  $this
            ->to($pedido->cliente->email)
            ->subject(sprintf('Orden de Pedido No.'. $pedido->id .' - '.$pedido->cliente->nombre))
            ->setTemplate('pedido') // By default template with same name as method name is used.
            ->emailFormat('html')
             ->viewVars([
            'pedido'=> $pedido,
            'imprimir'=>$imprimir
            ]);
    }

/**
 * Enviar por email a facturación la orden de pedido
 * @param  [type] $pedido [description]
 * @return [type]         [description]
 */
     public function facturacion($pedido)
    {
        $imprimir = 2;
      return  $this
            ->to(Configure::read('email_facturacion'))
            ->subject(sprintf('Facturas: Orden de Pedido No.'. $pedido->id .' - '.$pedido->cliente->nombre))
            ->setTemplate('facturacion') // By default template with same name as method name is used.
            ->emailFormat('html')
             ->viewVars([
            'pedido'=> $pedido,
            'imprimir'=>$imprimir
            ]);
    }

    
}

?>