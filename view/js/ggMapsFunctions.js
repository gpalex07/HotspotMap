
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


    // SPECIAL MARKERS.
    var TEMP_MARKER_ID = -2; // ID of a temp marker (red one, when the user right clicks the map - the marker is not added yet, it is only temp)
    var USER_MARKER_ID = -1; // ID of the marker indicating the user's position.






    $.ggMapsFunctions.initialize=function() {
      var myLatlng = new google.maps.LatLng(45.773459599999995, 3.1030216); // Centered on Clermont-Ferrand
      var mapOptions = {zoom: 4, center: myLatlng }
      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

      // Add all the current markers
      for (index = 0; index < currentMarkers.length; ++index) {
        var idMarker = currentMarkers[index][0];
        var myLatlng = new google.maps.LatLng(currentMarkers[index][1],currentMarkers[index][2]); // The location's coordinates
        $.ggMapsFunctions.addMarker(idMarker, myLatlng, currentMarkers[index][3]); // The location's name
      }

      infowindow = new google.maps.InfoWindow({content: ''});

      // Opens the infowindow to add a marker.
      google.maps.event.addListener(map, "rightclick", function(event) {
        // If there's already a temp marker (red one that appears on right click) we delete it.
        if(selectedMarker != null && selectedMarker.get("id") == TEMP_MARKER_ID) {
          selectedMarker.setMap(null);
          selectedMarker = null;
        }
        selectedMarker = new google.maps.Marker({position: event.latLng, map: map, title: 'New location'});
        selectedMarker.set("id", TEMP_MARKER_ID);

        $.get( '/location/add').done(function(data, textStatus, jqXHR){
          infowindow.content = data;
          infowindow.open(map, selectedMarker);
        }).fail(function(jqXHR, textStatus, errorThrown){
          infowindow.content = jqXHR.responseText;
          infowindow.open(map, selectedMarker);
        });

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
      marker.set("id", USER_MARKER_ID);
    }




    $.ggMapsFunctions.removeMarker = function(id) {
      // Ask the server to delete the marker. Wait for the answer to confirm deletion.

      $.ajax({
        url: '/location/remove/' +id,
        type: 'DELETE',
        success: function(data) {
            selectedMarker.setMap(null);
            selectedMarker = null;
            alert('Location removed!');
        },
        error: function(jqXHR, textStatus, errorThrown) {

            // Get the status code
            if (jqXHR.status == 500) {
                alert('Could not delete this marker.\n500 status code. Internal error.\n');
            } else alert('Could not delete this marker.\n' +jqXHR.status +' status code. \nAn error occured while deleting the location.');

        }
      });

      /*$.delete( "/location/remove/"+id, function( data ) {
        if(data == MARKER_DELETION_CONFIRMED){
          selectedMarker.setMap(null);
          selectedMarker = null;
        } else alert("Error: could not delete this marker.\n\nServer response:\n"+data);
      });*/
    }




    $.ggMapsFunctions.addMarker = function(id, position, title) {

      var marker = new google.maps.Marker({position: position, map: map, title: title, icon: '../view/img/wave.png'});
      marker.set("id", id); // Set the id of the marker, used to get the correct thread of disqus comments
      markers.push(marker);

      // Click event on the marker
      google.maps.event.addListener(marker, 'click', function() {
        selectedMarker= this;

        // Once the content is loaded, we display the infowindow
        $.get( "/location/show/"+marker.get("id"), function( data ) {
          infowindow.content = data;
          infowindow.open(map, marker);
          $.form.initSliders();
        });
        
      });
    }




    $.ggMapsFunctions.addNewMarker=function(){
      var formValues= $.form.extractContentInfoWindow(); // Extract the values that the user has typed in the infowindow (=form)
      formValues.position= selectedMarker.position;
      //var params= $.form.createEncodedStringFromFormObject(formValues); // Prepares this object to pass its values as a string in the get request

      $.ajax({
        type: 'POST',
        url: '/location/add',
        data: { 
          name:             formValues.locationName, 
          schedule:         formValues.schedule,
          free_connection:  formValues.freeConnection,
          free_coffee:      formValues.freeCoffee,
          rating:           formValues.rating,
          lat:              formValues.position.lat(),
          lng:              formValues.position.lng()
        },
        success: function(data, textStatus, jqXHR){ // data is the id of the row
            alert('Location added!\n(' +jqXHR.status +' status code)');
            $.ggMapsFunctions.addMarker(jQuery.parseJSON(data), formValues.position, formValues.locationName); // The return value (data) is the id of the new marker.
            selectedMarker.setMap(null);
            selectedMarker = null;
        },

        error: function(jqXHR, textStatus, errorThrown) {

            // Get the status code
            if (jqXHR.status == 400) {
                alert('400 status code. Bad request.\nHere is the error message:\n\n' + jQuery.parseJSON(jqXHR.responseText));
            } else if (jqXHR.status == 500) {
                alert('500 status code. Internal error.\nAn error occured while adding the new location.');
            } else alert(jqXHR.status +' status code.\nAn error occured while adding the new location.');

        }
    });

  }
})(jQuery);