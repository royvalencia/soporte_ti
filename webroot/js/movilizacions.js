/**
 * 
 * JS de movilizacion
 * @type {[type]}
 */
var urlCortes = null;



$(document).ready(function(){




    $( "#seccione-id" )
      .change(function () {
        var str = "";
         callCortes();
      })
      .change();

   $( "#corte" )
      .change(function () {
        var str = "";
         callCortes();
      })
      .change();    
  
  function callCortes(){
    //console.log('callCatalogos');
           if($('#seccione-id').val()>0 && $('#corte').val()>0){
            
            $('#asignacion').html('<i class="fa fa-spinner fa-pulse"></i> cargando...');
            
               catalogosComplete = false;
                 $(':input[type="submit"]').prop('disabled', true);            
             $.ajax({
                   url: urlCortes,
                   data: {
                     seccione_id: $('#seccione-id').val(),
                     corte: $('#corte').val(),                                        
                   },
                   error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                       $('#asignacion').html('Ocurrió un error con la petición intente de nuevo');  
                       catalogosComplete = false;

                      },
                   dataType: 'html',
                   success: function(result) { 
                      catalogosComplete = true;
                  // console.log(result);        
                      $('#asignacion').html(result);
                        $(':input[type="submit"]').prop('disabled', false);
                      setTxtFocus();
                   },
                   type: 'GET'
                })
           }else{
            //console.log($('#cargo-id').val()+' '+ $('#municipio').val())
           }
  }

  function setTxtFocus(){
        var corte = $('#corte').val();
    var dataSelected = null;  
    switch (corte) {   
      case '1':
          dataSelected = 'primer-corte';
          break;
      case '2':
           dataSelected = 'segundo-corte';
          break;
      case '3':
           dataSelected ='tercer-corte';
          break;     
    }
   //  console.log(corte); console.log(dataSelected);
      $("#"+dataSelected).focus();
      $("#"+dataSelected).select();
  }

  $('form#frmActivistas').submit(function(e) {
          
    // do something
    if(catalogosComplete==false){
      alert('Debe completar los catalogos para poder realizar la operación');
      e.preventDefault();
      return false;
    }
    return true;
});

  







  });



