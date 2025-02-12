/**
 * JS de contratos
 */

 var urlSelectOptions = null;

 /**
  * 
  * @param {*} filter  filtro para la consulta
  * @param {*} target  id del selected rellenar
  */
 function populateSelect( filter, target){
    let dropdown =$('#'+target); 
    dropdown.empty();
    dropdown.append('<option selected="true" disabled>Cargando...</option>');
    dropdown.prop('selectedIndex', 0);
    return  $.ajax({
        url: urlSelectOptions,
        data: {
          filter: filter,target:target
        },
        error: function(xhr, status, error) {
             console.log(xhr.responseText);
           //  $("div#divLoading").removeClass('show'); //Ocultar Loading 
           $('#'+target).after('<div class="error-message">Ocurrió un error con la petición</div>')
           dropdown.empty();
           },
        dataType: 'json',
        success: function(data) {  
            dropdown.empty(); 
           console.log(data);  
           dropdown.append($('<option></option>').attr('value',0).text('-Seleccione-')); 
           $.each(data.datos, function (key, entry) {
            dropdown.append($('<option></option>').attr('value', entry.id).text(entry.descripcion));
          })   
       
        },
        type: 'GET'
     })
 }

 $( "#sectore-id" )
 .change(function () {
   var str = "";
   if($('#sectore-id').val()>0){
        $('#operacione-id').empty();
        $('#ramo-id').empty();
        $('#producto-id').empty();
        $('#sub-ramo-id').empty();
        populateSelect($('#sectore-id').val(),'operacione-id');
   }    
 });

 $( "#operacione-id" )
 .change(function () {
   var str = "";
   if($('#operacione-id').val()>0){
        $('#ramo-id').empty();
        $('#producto-id').empty();
        $('#sub-ramo-id').empty();
        populateSelect($('#operacione-id').val(),'ramo-id');
   }    
 })
 .change();

 $( "#ramo-id" )
 .change(function () {  
   if($('#ramo-id').val()>0){       
        $('#producto-id').empty();
        $('#sub-ramo-id').empty();
        populateSelect($('#ramo-id').val(),'producto-id');
   }    
 })
 .change();

 $( "#producto-id" )
 .change(function () {  
   if($('#producto-id').val()>0){       
       
        $('#sub-ramo-id').empty();
        populateSelect($('#producto-id').val(),'sub-ramo-id');
   }    
 })
 .change();

 /**
 * Sumar datos para la prima
 */
$(document).on('keyup change', ".sum-data", function () {
      var sumPrimaTotal = 0;
      /*
      $(".sum-data").each(function() {
        if(!isNaN($(this).val())){
           // console.log($(this).val());
           sumPrimaTotal+= Number($(this).val()) ;
          }
    });
    */
   sumPrimaTotal = Number($('#prima-neta-anual').val())+Number($('#rec-pago-frac').val())+Number($('#gasto-expedicion').val())+Number($('#iva').val());
    var descuento = Number($('#descuento').val());
    sumPrimaTotal = sumPrimaTotal - descuento;
    $('#prima-total').val(sumPrimaTotal);
});