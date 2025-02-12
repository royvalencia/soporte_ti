/**
 * JS del tablero de control /DashboardController
 * @type {[type]}
 */
var urlResumen = null;
var urlMovilizacion =null;
var urlSecciones = null;

var fechaInicio = null;
var fechaFin = null;
var restrictedCall = false;


//Accioens sobre el Dashboard
$(document).ready(function(){
     dashboardCall();

  $( "#dashboardForm" ).submit(function( event ) {
         dashboardCall();         
        event.preventDefault();
})

  function dashboardCall(){
     fechaInicio = $("#fecha-inicio").val();
          fechaFin = $("#fecha-fin").val();
         $("div#divLoading").addClass('show'); //Mostrar Loading
      /*
      $.when(resumenOrdenes(), pedidosAlmacen(),pedidosLinea(), pedidosProveedor()).done(function(a1,a2,a3,a4){
          //console.log(a1);
          // the code here will be executed when all four ajax requests resolve.
          // a1, a2, a3 and a4 are lists of length 3 containing the response text,
          // status, and jqXHR object for each of the four ajax calls respectively.
             $("div#divLoading").removeClass('show'); //Ocultar Loading
      });
      */
    if(restrictedCall==false){ 
      $.when(resumen(),movilizacion('municipio'),movilizacion('dfederal'),movilizacion('dlocal')).done(function(a1,a2,a3,a4){
          //console.log(a1);
          // the code here will be executed when all four ajax requests resolve.
          // a1, a2, a3 and a4 are lists of length 3 containing the response text,
          // status, and jqXHR object for each of the four ajax calls respectively.
             $("div#divLoading").removeClass('show'); //Ocultar Loading
      });
    }else{
     $.when(movilizacion('municipio'),movilizacion('dlocal'),movilizacionSecciones()).done(function(a1,a2){
          //console.log(a1);
          // the code here will be executed when all four ajax requests resolve.
          // a1, a2, a3 and a4 are lists of length 3 containing the response text,
          // status, and jqXHR object for each of the four ajax calls respectively.
             $("div#divLoading").removeClass('show'); //Ocultar Loading
      });
    }
  }

 

  //Resumen de pedidos
  function resumen(){
    return  $.ajax({
       url: urlResumen,
       data: {
         fechaInicio: fechaInicio,fechaFin:fechaFin
       },
       error: function(xhr, status, error) {
            console.log(xhr.responseText);
            $("div#divLoading").removeClass('show'); //Ocultar Loading
          },
       dataType: 'json',
       success: function(data) {   
          console.log(data);      
          $('#metaVotacion').html($.number(data.resumen.metaVotacion));
          $('#totalPromocion').html($.number(data.resumen.totalPromocion,0));
          $('#totalVotaron').append($.number(data.resumen.totalVotaron,0));
          
          if(data.resumen.metaVotacion){
           // console.log(data.resumen.metaPromocion);
            porcentajePagado = ((eval(data.resumen.totalVotaron))/eval(data.resumen.metaVotacion))*100
            $('#porcentajeMeta').html($.number(porcentajePagado,2)+'%');
          }
       },
       type: 'GET'
    })
  }

 

  /**
   * estructura municipal
   * @return {[type]} [description]
   */
  function movilizacion(tipo){
     var categorias = [];
     return  $.ajax({
         url: urlMovilizacion+'/'+tipo,
         data: {
           fechaInicio: fechaInicio,fechaFin:fechaFin
         },
         error: function(xhr, status, error) {
              console.log(xhr.responseText);
              $("div#divLoading").removeClass('show'); //Ocultar Loading
            },
         dataType: 'json',
         success: function(data) {
                     //console.log(data);              
                      
          //$('#movilizacion-'+tipo).html(data);
          graficoColumnas('movilizacion-'+tipo,data.categorias,data.series,'Movilización');
         },
         type: 'GET'
      });
  }

  function movilizacionSecciones(){
     var categorias = [];
     return  $.ajax({
         url: urlSecciones,
         data: {
           fechaInicio: fechaInicio,fechaFin:fechaFin
         },
         error: function(xhr, status, error) {
              console.log(xhr.responseText);
              $("div#divLoading").removeClass('show'); //Ocultar Loading
            },
         dataType: 'html',
         success: function(data) {
                   //  console.log(data);              
                      
          $('#movilizacion-secciones').html(data);
         },
         type: 'GET'
      });
  }

  


     function graficoBarras(container, categorias, series,yAxisText){
       // console.log(container);
        Highcharts.chart(container, {
                  chart: {
                      type: 'bar'
                  },
                  title: {
                      text: ''
                  },
                  subtitle: {
                      //text: 'Source: <a href="https://en.wikipedia.org/wiki/World_population">Wikipedia.org</a>'
                  },
                  xAxis: {
                      categories: categorias,
                      title: {
                          text: null
                      }
                  },
                  yAxis: {
                      min: 0,
                      title: {
                          text: yAxisText,
                          align: 'high'
                      },
                      labels: {
                          overflow: 'justify'
                      }
                  },
                  tooltip: {
                      valueSuffix: ' personas'
                  },
                  plotOptions: {
                      bar: {
                          dataLabels: {
                              enabled: true
                          }
                      }
                  },
                  legend: {
                     // enabled: false,
                      layout: 'vertical',
                      align: 'right',
                      verticalAlign: 'top',
                      x: -40,
                      y: 80,
                      floating: true,
                      borderWidth: 1,
                      backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                      shadow: true
                  },
                  credits: {
                      enabled: false
                  },
                  series: series
              });
    }

      function graficoColumnas(container, categorias, series,yAxisText){
       // console.log(container);
        Highcharts.chart(container, {
                  chart: {
                      type: 'column'
                  },
                  title: {
                      text: ''
                  },
                  subtitle: {
                      //text: 'Source: <a href="https://en.wikipedia.org/wiki/World_population">Wikipedia.org</a>'
                  },
                  xAxis: {
                      categories: categorias,
                      title: {
                          text: null
                      }
                  },
                  yAxis: {
                      min: 0,
                      title: {
                          text: yAxisText,
                          align: 'high'
                      },
                      labels: {
                          overflow: 'justify'
                      }
                  },
                  tooltip: {
                      valueSuffix: ' personas'
                  },
                  plotOptions: {
                      column: {
                          dataLabels: {
                              enabled: true,
                              rotation : -90,
                              inside:true,
                              align:'left'
                          }
                      }
                  },        
                  credits: {
                      enabled: false
                  },
                  series: series

              });
    }


});


function exportXls(url){
       var urlXls =url +'?export=1&fechaInicio='+fechaInicio+"&fechaFin="+fechaFin;
       window.open(urlXls, "_self", "directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes");
    }

function prevExportXls(url, tipo){
  var urlExportPromocion = url +'/'+tipo;
  exportXls(urlExportPromocion);
}




