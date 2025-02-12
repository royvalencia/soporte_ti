/**
 * 
 * JS de pedidos de almacen
 * @type {[type]}
 */
var urlProductos = null;
var urlClientes = null;
var urlDetalleClientes = null;
var urlDetalleProductos = null;
var iva = 0.16; // Porcentaje DE IVA (16%)
//var indexDetallePedidos =0;

//Productos de la solicitud
$(document).ready(function(){
  jQuery('#descripcion-producto').autocomplete({
        source:urlProductos,
        minLength: 3,
        focus: function( event, ui ) {
          $( "#descripcion-producto" ).val( ui.item.label );
          return false;
         },
        select: function( event, ui ) {
         $('#datos-entrada').show();
         data = jQuery.parseJSON(ui.item.data);
         //En seleccion agregamos un nuevo row a la tabla
        // console.log(data); //return false;
         row = '';
         addNewRow = true;
         if(data){
           var input = $('.productos-almacene-id').each(function() {            
            if (data.id==$(this).val()) 
            { //Si se encuentra el producto etnonces solo sumamos cantidades
              valor =$('.cantidad-solicitada-'+data.id).val();
              valor = Number(valor)+1;
              $('.cantidad-solicitada-'+data.id).val(valor);

              precio_venta =$('#detalle-pedidos-'+$('.cantidad-solicitada-'+data.id).attr('data-index')+'-precio-venta');
              totalProducto = valor*data.producto.precio_venta;
              $('#total-producto-'+data.id).html(totalProducto);
              addNewRow = false;
            }

          });
           if(addNewRow){
            row+='<div id="product-'+data.id+'" class="row detail-product-list">';              
            row+='     <div class="col-md-4"><a href="#" onclick="detalleProducto('+data.producto.id+')" >'+data.producto.descripcion+'. '+data.producto.unidad_medida.descripcion+'</a> -  $<span class="number">'+data.producto.precio_venta+'</span> ';
            row+='<input id="detalle-pedidos-'+indexDetallePedidos+'-productos-almacene-id" name="detalle_pedidos['+indexDetallePedidos+'][productos_almacene_id]" type="hidden"  value="'+data.id+'" class="productos-almacene-id">';
            row+='<input id="detalle-pedidos-'+indexDetallePedidos+'-precio-venta" name="detalle_pedidos['+indexDetallePedidos+'][precio_venta]" type="hidden"   value="'+data.producto.precio_venta+'" class="precio-venta">';
             row+='<input id="detalle-pedidos-'+indexDetallePedidos+'-precio-sin-descuento" name="detalle_pedidos['+indexDetallePedidos+'][precio_sin_descuento]" type="hidden"   value="'+data.producto.precio_venta+'" class="precio-sin-descuento">';
            row+='     </div>';
            row+='      <div class="col-md-2"><span class="label-monto">Cantidad: </span><input id="detalle-pedidos-'+indexDetallePedidos+'-cantidad-solicitada" name="detalle_pedidos['+indexDetallePedidos+'][cantidad_solicitada]" type="number" min="1" required data-id="'+data.id+'" data-index="'+indexDetallePedidos+'"  class="cantidad-box col-md-10 cantidad-solicitada-'+data.id+' " value="1"></div>';
            row+='      <div class="col-md-1"><span class="label-monto">Descuento: </span><input id="detalle-pedidos-'+indexDetallePedidos+'-descuento" name="detalle_pedidos['+indexDetallePedidos+'][descuento]" type="number" step="any" min="0" max="100" required data-id="'+data.id+'" data-index="'+indexDetallePedidos+'"  class="descuento-box  descuento-'+data.id+' " value="0" style="width:90%"></div>';
            row+='     <div class="col-md-2"><span class="label-monto">Precio: </span>$<span id="precio-venta-'+data.id+'"  class="number"> '+data.producto.precio_venta+'</span></div>';          
            row+='     <div class="col-md-2 text-right"><span class="label-monto">Total: </span>$<span id="total-producto-'+data.id+'" class="number total-producto"> '+data.producto.precio_venta+'</span></div>';          
            row+='     <div class="col-md-1"><a href="#" class="btn btn-default btn-sm" rel="tooltip" title="Eliminar" onclick="eliminarRow('+data.id+')"><i class="fa fa-trash-o"></i></a></div>'
            row+='</div>';
          // row+='<script>$("#detalle-pedidos.'+indexDetallePedidos+'.cantidad-solicitada").change(function(){console.log("cambio box");})</\script>';
          
           $('#product-list').append(row);
           var incremento = parseInt(indexDetallePedidos)+(1);           
           indexDetallePedidos = incremento;
           console.log('No. Productos:' +incremento); 
         }
          sumTotal();
        }
           $('.cantidad-solicitada-'+data.id).focus();
          return false;
     } 
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<div>" + item.label + "<br><span class=\"text-muted\">" + item.desc +" ("+item.codigo+")"+ "</span></div>" )
        .appendTo( ul );
    };;

//Clientes
$('#nombre-cliente').focus();
   jQuery('#nombre-cliente').autocomplete({
        source:urlClientes,
        minLength: 3,
         focus: function( event, ui ) {
          $( "#nombre-cliente" ).val( ui.item.label );
          return false;
         },
        select: function(event, ui) { 
           $("#nombre-cliente").val(ui.item.value); 
            $('#datos-pedido').show();
          data = jQuery.parseJSON(ui.item.data); 
          console.log(data);
          if(data.id){
             $('#cliente-id').val(data.id);
             $('#cliente-nombre').val(data.nombre);
             $('#descripcion-producto').focus();
            } 
          if(data.email){
            // $('#notificacion').attr('disabled',false);
             $('#div-notificacion').removeClass('div-disabled');
             $('#div-notificacion').attr('title','Enviar a ' +data.email);
          }else{
            $('#div-notificacion').addClass('div-disabled');
          }           
          
         }
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<div>" + item.label + "<br><span class=\"text-muted\">" + item.desc + "</span></div>" )
        .appendTo( ul );
    };;

    $('span.number').number( true, 2 );


});

$(document).on('keyup change', ".cantidad-box", function () {
     
     
        actualizarPrecios($(this).attr('data-id'), $(this).attr('data-index'),$(this).val());

    });

/**
 * Descuento
 * @param  {[type]} ) {                        var precio_sin_descuento [description]
 * @return {[type]}   [description]
 */
$(document).on('keyup change', ".descuento-box", function () {
     if(!isNaN($(this).val())){
        var precio_sin_descuento = $('#detalle-pedidos-'+$(this).attr('data-index')+'-precio-sin-descuento').val();
        var descuento = (precio_sin_descuento*$(this).val())/100;
        var precio_con_descuento = precio_sin_descuento - descuento;
        precio_con_descuento = precio_con_descuento.toFixed(2);
      //  console.log(precio_con_descuento);
        $('#detalle-pedidos-'+$(this).attr('data-index')+'-precio-venta').val(precio_con_descuento);
        $('#precio-venta-'+$(this).attr('data-id')).html(precio_con_descuento);
         actualizarPrecios($(this).attr('data-id'), $(this).attr('data-index'),$('.cantidad-solicitada-'+$(this).attr('data-id')).val());
      }
    });
 
 function actualizarPrecios(dataId, idxDetallePedidos,valor){
    // idxDetallePedidos = $(this).attr('data-index');
     //   dataId = $(this).attr('data-id');
  //   console.log('idx'+idxDetallePedidos);
        precio_venta = $('#detalle-pedidos-'+idxDetallePedidos+'-precio-venta').val();
      // console.log(precio_venta);
        if(!isNaN(valor)){
          precio_total = precio_venta*valor;
          console.log(precio_total);
          $('#total-producto-'+dataId).html(precio_total);
          sumTotal();
        }
 }


function sumTotal(){
  var sum = 0;  
   $('.total-producto').each(function() {
        sum += Number($(this).html().replace(',',''));
       // console.log(sum);
    });
   var impuestos = (sum*iva);
   var total = sum + impuestos;
    $('#subtotal-pedido').html(sum);
     $('#impuestos').html(impuestos);
    $('#total-pedido').html(total);
    $('span.number').number( true, 2 );
}

function eliminarRow(id){
  $('#product-'+id).remove();
  sumTotal();
}

function detalleCliente(){
    var options = {
        url: urlDetalleClientes+'/'+$("#cliente-id").val(),
        title:'Detalle del Cliente',
        size:   eModal.size.xl,
      //  subtitle: 'smaller text header',
        buttons: [
            {text: 'Cerrar', style: 'info',   close: true  },
            //{text: 'KO', style: 'danger', close: true}
        ]       
    };
     eModal.ajax(options);
  }

    function detalleProducto(id){
    var options = {
        url: urlDetalleProductos+'/'+id,
        title:'Detalle del Producto',
        size:   eModal.size.xl,
      //  subtitle: 'smaller text header',
        buttons: [
            {text: 'Cerrar', style: 'info',   close: true  },
            //{text: 'KO', style: 'danger', close: true}
        ]       
    };

  eModal.ajax(options);
  }


