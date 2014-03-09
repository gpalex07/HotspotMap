
// PLUGIN ggMapsFunctions containing the functions we added to handle our custom actions.

(function($) {
  $.ggMapsFunctions = function() {}

    var markers = [];
    var map;
    var infowindow;
    var selectedMarker; // The current marker.
    var InfoWindowContentAdd;
    var InfoWindowContentEdit;
    var InfoWindowContentRead;

    var MARKER_DELETION_CONFIRMED = "MARKER_DELETION_CONFIRMED"; // Response message when a marker is succesfully deleted on the server.
    var MARKER_ADDED_CONFIRMED    = "MARKER_ADDED_CONFIRMED"; // Response message when a marker is succesfully added on the server.
    var MARKER_ADDED_FAILED       = -1;








    // Loads the contents of the infowindow.
    $.ggMapsFunctions.loadContentsInfoWindow=function(){
      $.get( "../view/infoWindow_add.html", function( data ) {
        InfoWindowContentAdd = data;
      });
    }



    $.ggMapsFunctions.initialize=function() {
      $.ggMapsFunctions.loadContentsInfoWindow();

      var myLatlng = new google.maps.LatLng(45.773459599999995, 3.1030216);
      var mapOptions = {zoom: 4, center: myLatlng }
      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

      /* Adds a sample location */
      //$.ggMapsFunctions.addMarker(0, myLatlng, "Hello World!");

      // Add all the current markers
      for (index = 0; index < currentMarkers.length; ++index) {
        var idMarker = currentMarkers[index][0];
        var myLatlng = new google.maps.LatLng(currentMarkers[index][1],currentMarkers[index][2]); // The location's coordinates
        $.ggMapsFunctions.addMarker(idMarker, myLatlng, currentMarkers[index][3]); // The location's name
      }

      infowindow = new google.maps.InfoWindow({content: InfoWindowContentAdd});

      // Opens the infowindow to add a marker.
      google.maps.event.addListener(map, "rightclick", function(event) {
        selectedMarker = new google.maps.Marker({position: event.latLng, map: map, title: 'Hello World!'});
        infowindow.content = InfoWindowContentAdd;
        infowindow.open(map, selectedMarker);
      });

      // Infowindow events
      google.maps.event.addListener(infowindow, 'domready', function() { $.form.initSliders(); });
      google.maps.event.addListener(infowindow, 'closeclick', function() { $.form.destroySliders(); });            
  
      // This code keeps the map centered during a resize event.
      google.maps.event.addDomListener(window, "resize", function() {
          google.maps.event.trigger(map, "resize");
          map.setCenter(map.getCenter()); 
      });

      return this;
    }
    
    $.ggMapsFunctions.goToCoordinates=function(lat, lng){
      //alert("new google.maps.LatLng("+lat+", "+lng+");");
      var latLng = new google.maps.LatLng(lat, lng);
      map.setCenter(latLng);
    }

    $.ggMapsFunctions.addUserPositionMarker=function(lat, lng){
      //alert("new google.maps.LatLng("+lat+", "+lng+");");
      var latLng = new google.maps.LatLng(lat, lng);
      var marker = new google.maps.Marker({position: latLng, map: map, title: "Your current position"});
      marker.set("id", -1);
    }




    $.ggMapsFunctions.removeMarker = function(id) {
      // Ask the server to delete the marker. Wait for the answer to confirm deletion.
      $.get( "../model/deleteMarker.php?id="+id, function( data ) {
        if(data == MARKER_DELETION_CONFIRMED){
          selectedMarker.setMap(null);
          selectedMarker = null;
        } else alert("Error: could not delete this marker.\n\nServer response:\n"+data);
      });
    }




    $.ggMapsFunctions.addMarker = function(id, position, title) {

      var marker = new google.maps.Marker({position: position, map: map, title: title, icon: '../view/img/wave.png'});
      marker.set("id", id); // Set the id of the marker, used to get the correct thread of disqus comments
      markers.push(marker);

      // Click event on the marker
      google.maps.event.addListener(marker, 'click', function() {
        selectedMarker= this;

        // Once the content is loaded, we display the infowindow
        $.get( "../controller/infoWindow_edit.php?id="+marker.get("id"), function( data ) {
          infowindow.content = data;
          infowindow.open(map, marker);
          $.form.initSliders();
        });
        
      });
    }




    $.ggMapsFunctions.addNewMarker=function(){
      var formValues= $.form.extractContentInfoWindow(); // Extract the values that the user has typed in the infowindow (=form)
      formValues.position= selectedMarker.position;
      var params= $.form.createEncodedStringFromFormObject(formValues); // Prepares this object to pass its values as a string in the get request

      $.post( "../model/infoWindow_add.php", 
        { 
          name: formValues.locationName, 
          free_connection: formValues.freeConnection,
          free_coffee: formValues.freeCoffee,
          rating: formValues.rating,
          lat: formValues.position.lat(),
          lng: formValues.position.lng()
        }).done(function( data ) { alert(data);
        if(data != MARKER_ADDED_FAILED){ // data is the id of the row, if insertion succeed, otherwise it's -1
          $.ggMapsFunctions.addMarker(data, formValues.position, formValues.locationName); // The return value (data) is the id of the new marker.
          selectedMarker.setMap(null);
          selectedMarker = null;
        } else alert("Error: could not add this marker.\n\nServer response:\n"+data);
      });
    }
})(jQuery);