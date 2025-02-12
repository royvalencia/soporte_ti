  var map;
  var marker=null;
  var editMode = true;
  var iconBuliding = '/sc_warehouse/img/office-building.png';
  var geoJsonKmeans;    
  var stylesMap =[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}];
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center:  {lat: 18.50361111, lng: -88.30527778},
          zoom: 14,
          mapTypeControl: true,
          mapTypeControlOptions: {
              style: google.maps.MapTypeControlStyle.DEFAULT,
              position: google.maps.ControlPosition.RIGHT_TOP
          },
          styles: stylesMap
        });
             // zoom to show all the features
        var bounds = new google.maps.LatLngBounds();
        map.data.addListener('addfeature', function(e) {
          processPoints(e.feature.getGeometry(), bounds.extend, bounds);
          map.fitBounds(bounds);
        });
        //console.log(geoJsonKmeans);
       if( geoJsonKmeans!=undefined){  
          map.data.addGeoJson(geoJsonKmeans);//Capa GeoJSON
      }

       map.data.setStyle(function(feature) {
          var color = 'gray';         
          return /** @type {google.maps.Data.StyleOptions} */({
            fillColor: color,
            strokeColor: color,
            strokeWeight: 2
          });
        });

         map.data.setStyle(function(feature) {
          var clienteNombre = feature.getProperty('nombre');
          var color = 'green';  
         // console.log(clienteNombre);
          return {
            icon:{ url: iconBuliding,labelOrigin: new google.maps.Point(15,40)},
            visible: true,
            clickable: true,
            title: clienteNombre,
            fillColor: color,
            strokeColor: color,
            strokeWeight: 2,
            label:  {
                text: clienteNombre,
                color: 'black',
                fontSize: '10px',
                fontWeight: 'bold'
              }
          };
        });
        
  
    
      }

      function processPoints(geometry, callback, thisArg) {
          if (geometry instanceof google.maps.LatLng) {
            callback.call(thisArg, geometry);
          } else if (geometry instanceof google.maps.Data.Point) {
            callback.call(thisArg, geometry.get());
          } else {
            geometry.getArray().forEach(function(g) {
              processPoints(g, callback, thisArg);
            });
          }
        }
     
    
      
      
      function createMarker(latLng,map){
           if(marker==null) { 
             marker = new google.maps.Marker({
                 position: latLng,
                 icon: iconBuliding,
                 draggable : editMode,
                 map: map
                 
            });
            if(editMode){
             marker.addListener('dragend', function(e) {
                setLatLong(e.latLng);
            })
            }           
           }
      }
      
      
      
      
      
      
     
     /**
     * Establecemos la latitud y la longitud a las cajitas de texto respectivas 
     */
    function  setLatLong(pos){
          document.getElementById('y').value = pos.lat();
          document.getElementById('x').value = pos.lng();
          console.log('position set to ' + pos.lat()+' , '+pos.lng() );
      }

      