/**
 * JS de CLientes 
 * @type {[type]}
 */
urlDetalleUbicacion = null;
urlNuevaUbicacion = null;

function detalleUbicacion(id,cliente_id){
    var options = {
        url: urlDetalleUbicacion+'/'+id+'/cliente_id:'+cliente_id,
        title:'Detalle la Ubicación',
        size:   eModal.size.xl,
      //  subtitle: 'smaller text header',
        buttons: [
            {text: 'Cerrar', style: 'info',   close: true  },
            //{text: 'KO', style: 'danger', close: true}
        ]       
    };
     eModal.ajax(options);
  }

  function nuevaUbicacion(cliente_id){
    var options = {
        url: urlNuevaUbicacion+'/'+cliente_id,
        title:'Agregar Ubicación',
        size:   eModal.size.xl,
      //  subtitle: 'smaller text header',
        buttons: [
            {text: 'Cerrar', style: 'info',   close: true  },
            //{text: 'KO', style: 'danger', close: true}
        ]       
    };
     eModal.ajax(options);
  }