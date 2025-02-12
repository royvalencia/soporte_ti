/**
 * JS del tablero de control /DashboardController
 * @type {[type]}
 */
var urlResumen = null;
var urlestructuraMunicipal=null;
var urlPromocion =null;
var urlSecciones = null;

var urlPedidosLinea = null;
urlPedidosProveedor = null;
var fechaInicio = null;
var fechaFin = null;


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
      $.when(resumen(),estructuraMunicipal(),promocion('municipio'),promocion('dfederal'),promocion('dlocal'),promocionSecciones()).done(function(a1,a2,a3){
          //console.log(a1);
          // the code here will be executed when all four ajax requests resolve.
          // a1, a2, a3 and a4 are lists of length 3 containing the response text,
          // status, and jqXHR object for each of the four ajax calls respectively.
             $("div#divLoading").removeClass('show'); //Ocultar Loading
      });
     ;
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
          $('#totalActivistas').html($.number(data.resumen.totalActivistas));
          $('#totalPromovidos').html($.number(data.resumen.totalPromovidos,0));
          $('#metaPromocion').append($.number(data.resumen.metaPromocion,0));
          activistasPromovidos = eval(data.resumen.totalPromovidos)+eval(data.resumen.totalActivistas);
          $('#activistasPromovidos').append($.number(activistasPromovidos,0));
          if(data.resumen.metaPromocion){
           // console.log(data.resumen.metaPromocion);
            porcentajePagado = ((eval(data.resumen.totalPromovidos)+eval(data.resumen.totalActivistas))/eval(data.resumen.metaPromocion))*100
            $('#porcentajeMeta').html($.number(porcentajePagado)+'%');
          }
       },
       type: 'GET'
    })
  }

  /**
   * estructura municipal
   * @return {[type]} [description]
   */
  function estructuraMunicipal(){
     var categorias = [];
     return  $.ajax({
         url: urlestructuraMunicipal,
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
                      
          $('#estructuraMunicipalDiv').html(data);
         },
         type: 'GET'
      });
  }

  /**
   * estructura municipal
   * @return {[type]} [description]
   */
  function promocion(tipo){
     var categorias = [];
     return  $.ajax({
         url: urlPromocion+'/'+tipo,
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
                      
          $('#promocion-'+tipo).html(data);
         },
         type: 'GET'
      });
  }

  function promocionSecciones(){
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
                      
          $('#promocion-secciones').html(data);
         },
         type: 'GET'
      });
  }

  function pedidosLinea(){     
   return  $.ajax({
         url: urlPedidosLinea,
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
             graficoBarras('montoLineas',data.categorias,data.series,'Ventas por Línea de Producto');         
          // graficoPedidosAlmacen('pedidosAlmacenChart',data.almacenes,data.pedidosAlmacen,'Total de Pedidos por Status');
           
         },
         type: 'GET'
      });
        
  }


  function pedidosProveedor(){     
   return  $.ajax({
         url: urlPedidosProveedor,
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
             graficoBarras('montoProveedores',data.categorias,data.series,'Ventas por Proveedor');         
          // graficoPedidosAlmacen('pedidosAlmacenChart',data.almacenes,data.pedidosAlmacen,'Total de Pedidos por Status');
           
         },
         type: 'GET'
      });
        
  }

    function graficoPedidosAlmacen(container, categorias, series,yAxisText){
     // console.log(container);
        Highcharts.chart(container, {
                  chart: {
                      type: 'column'
                  },
                  title: {
                      text: ''
                  },
                  xAxis: {
                      categories: categorias
                  },
                  yAxis: {
                      min: 0,
                      title: {
                          text: yAxisText
                      },
                      stackLabels: {
                          enabled: true,
                          style: {
                              fontWeight: 'bold',
                              color:  '#5f5e5e'
                          }
                      }
                  },
                  legend: {
                      align: 'right',
                     // x: -30,
                     // verticalAlign: 'top',
                     // y: 25,
                    //  floating: true,
                      backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                      borderColor: '#5f5e5e',
                      borderWidth: 1,
                      shadow: false
                  },
                  tooltip: {
                      headerFormat: '<b>{point.x}</b><br/>',
                      pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                  },
                  plotOptions: {
                      column: {
                          stacking: 'normal',
                          dataLabels: {
                              enabled: true,
                              color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'black'
                          }
                      }
                  },
                  series: series
                 /*
                 series :[{
                      name: 'John',
                      data: [5, 3]
                  }, {
                      name: 'Jane',
                      data: [2,  1]
                  }, {
                      name: 'Joe',
                      data: [3, 4]
                  }]
                  */
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
                      valueSuffix: ' pesos'
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


});


function exportXls(url){
       var urlXls =url +'?export=1&fechaInicio='+fechaInicio+"&fechaFin="+fechaFin;
       window.open(urlXls, "_self", "directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes");
    }

function prevExportXls(url, tipo){
  var urlExportPromocion = url +'/'+tipo;
  exportXls(urlExportPromocion);
}




