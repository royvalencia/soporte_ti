/**
 * 
 * JS de promovidos
 * @type {[type]}
 */
var urlLocalidades = null;
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
        delay: 400,
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
         //En seleccion agregamos un nuevo row a la tabla
        //console.log(data); //return false;
        
           $('#domicilio').focus();
          $(':input[type="submit"]').prop('disabled', false);
          return false;
     } 
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<div>" + item.label + "<br><span class=\"text-muted\"> Clave: " + item.desc + "</span></div>" )
        .appendTo( ul );
    };;

  });



