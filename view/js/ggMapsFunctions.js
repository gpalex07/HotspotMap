
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

    var infoWindowContent_addSlidersInit = null;


    // Loads the contents of the infowindow.
    $.ggMapsFunctions.loadContentsInfoWindow=function(){
      $.get( "infoWindow_add.html", function( data ) {
        InfoWindowContentAdd = data;
      });      

      $.get( "infoWindow_read.html", function( data ) {
        InfoWindowContentRead = data;
      });
    }


    $.ggMapsFunctions.initialize=function() {
      $.ggMapsFunctions.loadContentsInfoWindow();

      var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
      var mapOptions = {zoom: 4, center: myLatlng }
      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

      /* Adds a sample location */
      //selectedMarker = new google.maps.Marker({position: myLatlng, map: map, title: 'Hello World!'});
      $.ggMapsFunctions.addMarker(0, myLatlng, "Hello World!");

      infowindow = new google.maps.InfoWindow({content: InfoWindowContentAdd});

      google.maps.event.addListener(map, "rightclick", function(event) {
        if(selectedMarker != null){ selectedMarker.setMap(null); selectedMarker = null; }
        selectedMarker = new google.maps.Marker({position: event.latLng, map: map, title: 'Hello World!'});

        /*if(infoWindowContent_addSlidersInit==null) infowindow.content = InfoWindowContentAdd;
        else infowindow.content = infoWindowContent_addSlidersInit;*/

        infowindow.content = InfoWindowContentAdd;
        infowindow.open(map, selectedMarker);          
      });

      // Infowindow events
      google.maps.event.addListener(infowindow, 'domready', function() {
        $.form.initSliders();
      });

      google.maps.event.addListener(infowindow, 'closeclick', function() {
        $.form.destroySliders();
      });
            
  
      // This code keeps the map centered during a resize event.
      google.maps.event.addDomListener(window, "resize", function() {
          var center = map.getCenter();
          google.maps.event.trigger(map, "resize");
          map.setCenter(center); 
      });

      return this;
    }

    $.ggMapsFunctions.removeMarker = function() {
      // Ask the server to delete the marker. Wait for the answer to confirm deletion.
      $.get( "deleteMarker.php?id="+selectedMarker.get("id"), function( data ) {
        if(data === MARKER_DELETION_CONFIRMED){
          selectedMarker.setMap(null);
          selectedMarker = null;
        } else alert("Error: could not delete this marker.\n\nServer response:\n"+data);
      });
    }

    $.ggMapsFunctions.addMarker = function(id, position, title) {

      var marker = new google.maps.Marker({position: position, map: map, title: title, icon: 'img/wave.png'});
      marker.set("id", id); // Set the id of the marker, used to get the correct thread of disqus comments
      markers.push(marker);

      // Click event on the marker
      google.maps.event.addListener(marker, 'click', function() {
        // Once the content is loaded, we display the infowindow
        $.get( "infoWindow_edit.php?id="+marker.get("id"), function( data ) {
          infowindow.content = data;
          infowindow.open(map, marker);
          $.form.initSliders();
        });

        $.disqusFunctions.reloadWithMarkerId(marker.get("id"));
      });
    }

    $.ggMapsFunctions.addNewMarker=function(){
      var formValues= $.form.extractContentInfoWindow(); // Extract the values that the user has typed in the infowindow (=form)
      formValues.position= selectedMarker.position;
      var params= $.form.createEncodedStringFromFormObject(formValues); // Prepares this object to pass its values as a string in the get request

      $.get( "addMarker.php"+params, function( data ) {
        if(data != MARKER_ADDED_FAILED){
          $.ggMapsFunctions.addMarker(data, formValues.position, "Hello World!"); // The return value (data) is the id of the new marker.
          selectedMarker.setMap(null);
          selectedMarker = null;
        } else alert("Error: could not add this marker.\n\nServer response:\n"+data);
      });
    }
    
  //google.maps.event.addDomListener(window, 'load', initialize);*/


})(jQuery);

  


  

//};



      
/*
// Prase the form that the user completed to add a new location
function parseRawForm(){
  var timetable = document.getElementById("timetable");
  var row = timetable.getElementsByTagName("div");

  for(var i=0; i<row.length; i++){
    var spans = row[i].getElementsByTagName("span");
    if(spans.length == 2){ // 2 pair of span tags, 1 for opening hour, the other one for closing hour.
      var open = spans[0].innerHTML.replace(/\D+/, '');
      var end = spans[1].innerHTML.replace(/\D+/, '');
      if(!isNaN(open) && !isNaN(end)){
        //alert(i + "> " + open + " " + end);
      }
    }
  }
}*/