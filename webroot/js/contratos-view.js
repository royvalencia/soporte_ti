/**
 * JS de CLientes 
 * @type {[type]}
 */
urlDetalleVehiculo = null;
urlNuevoVehiculo= null;

function detalleVehiculo(id,contrato_id){
    var options = {
        url: urlDetalleVehiculo+'/'+id+'/contrato_id:'+contrato_id,
        title:'Detalle',
        size:   eModal.size.xl,
      //  subtitle: 'smaller text header',
        buttons: [
            {text: 'Cerrar', style: 'info',   close: true  },
            //{text: 'KO', style: 'danger', close: true}
        ]       
    };
     eModal.ajax(options);
  }

  function nuevoVehiculo(contrato_id){
    var options = {
        url: urlNuevoVehiculo+'/'+contrato_id,
        title:'Agregar al Contrato',
        size:   eModal.size.xl,
      //  subtitle: 'smaller text header',
        buttons: [
            {text: 'Cerrar', style: 'info',   close: true  },
            //{text: 'KO', style: 'danger', close: true}
        ]       
    };
     eModal.ajax(options);
  }