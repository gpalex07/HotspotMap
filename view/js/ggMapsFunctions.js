
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
      selectedMarker = new google.maps.Marker({position: myLatlng, map: map, title: 'Hello World!'});
      $.ggMapsFunctions.addMarker();

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
        $.sliders.initSliders();
      });

      google.maps.event.addListener(infowindow, 'closeclick', function() {
        $.sliders.destroySliders();
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

    $.ggMapsFunctions.addMarker = function() {
      //InfoWindowContentAdd = "<div id='infoWindowDiv'>" +document.getElementById("infoWindowDiv").innerHTML +"</div>";
      //parseRawForm(); // Parse the form and saves it.

      var marker = new google.maps.Marker({
        position: selectedMarker.position,
        map: map,
        title: selectedMarker.title,
        icon: 'img/wave.png'
      });
      marker.set("id", markers.length); // Set the id of the marker, used to get the correct thread of disqus comments
      selectedMarker.setMap(null);
      markers.push(marker);
      selectedMarker = null;

      // Click event on the marker
      google.maps.event.addListener(marker, 'click', function() {
        selectedMarker = this;

        // Once the content is loaded, we display the infowindow
        $.get( "infoWindow_edit.php?id="+marker.get("id"), function( data ) {
          infowindow.content = data;
          $.sliders.initSliders();
          infowindow.open(map, marker);
        });

        $.disqusFunctions.reloadWithMarkerId(marker.get("id"));
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