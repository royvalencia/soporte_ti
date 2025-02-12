  var map;
  var marker=null;
  var editMode = true;
  var iconBuliding = '/sc_warehouse/img/office-building.png';
      
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center:  {lat: 18.50361111, lng: -88.30527778},
          zoom: 14,
          mapTypeControl: true,
          mapTypeControlOptions: {
              style: google.maps.MapTypeControlStyle.DEFAULT,
              position: google.maps.ControlPosition.RIGHT_TOP
          }
        });
        
        var geocoder = new google.maps.Geocoder();
        
       if(document.getElementById('searchBtn')!=null){ 
            document.getElementById('searchBtn').addEventListener('click', function() {               
              geocodeAddress(geocoder, map);
            });

            document.getElementById("address")
              .addEventListener("keyup", function(event) {
              event.preventDefault();
              if (event.keyCode == 13) {
                  document.getElementById("searchBtn").click();
              }
          });
        }
                                        
       if(editMode){ 
         map.addListener('click', function(e) {
          placeMarkerAndPanTo(e.latLng, map);
        }); 
        
      }
        if(document.getElementById('x').value && document.getElementById('y').value){
            latLngMarker = new google.maps.LatLng(document.getElementById('y').value ,document.getElementById('x').value);
            createMarker(latLngMarker,map);
            map.panTo(latLngMarker);
            console.log('location Is Set');
        }
       
      }
     
     /**
     * Fijamos un marcador al hacer clicn en el mapa 
     */
      function placeMarkerAndPanTo(latLng, map) {
        if(marker==null) { 
            createMarker(latLng,map);
           
      }else{
          marker.setPosition(latLng);
      }
        map.panTo(latLng);
        setLatLong(latLng);
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
      
      
      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {                                                        
            resultsMap.setCenter(results[0].geometry.location);
            
            setLatLong(results[0].geometry.location);
            
            //placeMarkerAndPanTo(pos.lat(),pos.lng());
            
            /*var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            }); */
               
            /*marker = new google.maps.Marker({
                 position: results[0].geometry.location,
                 icon:  '/paom/img/office-building.png',
                 draggable : editMode,
                 map: resultsMap
            }); */
            placeMarkerAndPanTo(results[0].geometry.location,resultsMap);
            createMarker(results[0].geometry.location,resultsMap);
                  
            
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
      
      
      
     
     /**
     * Establecemos la latitud y la longitud a las cajitas de texto respectivas 
     */
    function  setLatLong(pos){
          document.getElementById('y').value = pos.lat();
          document.getElementById('x').value = pos.lng();
          console.log('position set to ' + pos.lat()+' , '+pos.lng() );
      }

      