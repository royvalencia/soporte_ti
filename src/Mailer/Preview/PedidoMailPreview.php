<?php
namespace App\Mailer\Preview;
 
use DebugKit\Mailer\MailPreview;
 
class PedidoMailPreview extends MailPreview
{
    public function solicitud()
    {
        $this->loadModel("Pedidos");
          $pedido = $this->Pedidos->get(10, [
            'contain' => ['Clientes', 'StatusPedidos', 'BitacoraPedidos'=>['StatusPedidos'], 
                           'DetallePedidos'=>[ 'ProductosAlmacenes'=>['Productos'=>['UnidadMedidas']],
                                               'sort'=>['DetallePedidos.id'=>'ASC']
                                           ]

                        ]]);
        return $this->getMailer("Pedido")
            ->solicitud($pedido);
           
    }

    public function orden()
    {
        $this->loadModel("Pedidos");
          $pedido = $this->Pedidos->get(10, [
            'contain' => ['Clientes', 'StatusPedidos', 'BitacoraPedidos'=>['StatusPedidos'], 
                           'DetallePedidos'=>[ 'ProductosAlmacenes'=>['Productos'=>['UnidadMedidas']],
                                               'sort'=>['DetallePedidos.id'=>'ASC']
                                           ]

                        ]]);
        return $this->getMailer("Pedido")
            ->orden($pedido);
           
    }

      public function facturacion()
    {
        $this->loadModel("Pedidos");
          $pedido = $this->Pedidos->get(10, [
            'contain' => ['Clientes', 'StatusPedidos', 'BitacoraPedidos'=>['StatusPedidos'], 
                           'DetallePedidos'=>[ 'ProductosAlmacenes'=>['Productos'=>['UnidadMedidas']],
                                               'sort'=>['DetallePedidos.id'=>'ASC']
                                           ]

                        ]]);
        return $this->getMailer("Pedido")
            ->facturacion($pedido);
           
    }
}