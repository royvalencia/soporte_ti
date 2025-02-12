/**
 * 
 * JS de activistas
 * @type {[type]}
 */
var urlLocalidades = null;
var urlAsignacion = null;
var urlDivisionSecciones = null;
var catalogosComplete = false;
var municipio = 0; //Cuando existe algun dato asignado como en los edits
var distrito_local = 0;
var zona = 0;
var seccione_id = 0;
var division_seccione_id = 0;
var urlLn = null;



//Productos de la solicitud
$(document).ready(function(){


//Clientes
$('#localidad').focus();
   jQuery('#localidad').autocomplete({
        source:urlLocalidades,
        minLength: 3,
         focus: function( event, ui ) {
          $( "#localidad" ).val( ui.item.label );
          return false;
         },
        select: function(event, ui) { 
          
         // console.log(data);
        
          
         }
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<div>" + item.label + "<br><span class=\"text-muted\">" + item.desc + "</span></div>" )
        .appendTo( ul );
    };;

    $( "#cargo-id" )
      .change(function () {
        var str = "";
         callCatalogos();
      })
      .change();

       $( "#municipio" )
        .change(function () {
          var str = "";
           callCatalogos();
        })
        .change();
  
  function callCatalogos(){
    //console.log('callCatalogos');
           if($('#cargo-id').val()>0 && $('#municipio').val()>0){
            
            $('#asignacion').html('<i class="fa fa-spinner fa-pulse"></i> cargando...');
             $('#divisionSecciones').html('');
               catalogosComplete = false;
                            
             $.ajax({
                   url: urlAsignacion,
                   data: {
                     cargo_id: $('#cargo-id').val(),
                     municipio: $('#municipio').val(),
                     distrito_local: distrito_local,
                     zona: zona,
                     seccione_id: seccione_id
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
                      
                   },
                   type: 'GET'
                })
           }else{
            console.log($('#cargo-id').val()+' '+ $('#municipio').val())
           }
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

  function getAsignacionValue(){
    if(activista ==null){
      return  0;
    }
    var cargoId = $('#cargo-id').val();
    var dataSelected = null;  
    switch (cargoId) {   
      case 1:
          dataSelected = activista.municipio;
          break;
      case 2:
           dataSelected = activista.distrito_local;
          break;
      case 3:
           dataSelected = activista.zona;
          break;
      case 4:
           dataSelected = activista['seccione_id'];
           console.log('cargo 4');
          break;
      case 5:
           dataSelected = activista['seccione_id'];
          break;  
    }
    console.log(activista);
    console.log('data selected : '+dataSelected+' , cargo '+ $('#cargo-id').val());
    return dataSelected;
  }

   $('#nombre-completo').tooltip({
     placement: "top",
     trigger: "focus",

});
$('#nombre-completo').on('show.bs.tooltip', function () {
   setTimeout(function(){
         $('#nombre-completo').tooltip('hide');
        // console.log('hide tooltip');
    }, 5000);
})

  $('#nombre-completo').focus();


//Buscar en el LN
  jQuery('#nombre-completo').autocomplete({
        source:urlLn,
        minLength: 3,
        focus: function( event, ui ) {
          $( "#nombre-completo" ).val( ui.item.label );
          return false;
         },
        select: function( event, ui ) {
        //$('#datos-entrada').show();
         data = jQuery.parseJSON(ui.item.data);
        $( "#clave-elector" ).val( data.clave_elector );
        $( "#nombres" ).val( data.nombre );
        $( "#apellido-paterno" ).val( data.apellido_paterno );
        $( "#apellido-materno" ).val( data.apellido_materno );
        $( "#seccion-vota" ).val( data.seccion);
        var domicilio = data.calle + ' '+ data.numero_exterior + ' '+ data.numero_interior+' . '+data.colonia;
        $( "#domicilio" ).val( domicilio );
          $('#domicilio').focus();
         //En seleccion agregamos un nuevo row a la tabla
        //console.log(data); //return false;
        
         //  $('.cantidad-solicitada-'+data.id).focus();
          return false;
     } 
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<div>" + item.label + "<br><span class=\"text-muted\"> Clave: " + item.desc + "</span></div>" )
        .appendTo( ul );
    };;

  });



