
// PLUGIN ggMapsFunctions containing the functions we added to handle our custom actions.

(function($) {
  $.ggMapsFunctions = function() {}

    var markers = [];
    var map;
    var infowindow;
    var selectedMarker; // The current marker.
    var InfoWindowContentAdd;

    var infoWindowContent_addSlidersInit = null;

    // Loads the content of the infowindow.
    $.get( "infoWindow_add.html", function( data ) {
      InfoWindowContentAdd = data;
    });

    var InfoWindowContentRemove = 
      "<div id='infoWindowDiv'>"
     +"<a href='javascript:void(0)' ' onclick='removeMarker()'>Remove this location</a><br/>"
     +"</div>";


    $.ggMapsFunctions.init=function() {
      var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
      var mapOptions = {
        zoom: 4,
        center: myLatlng
      }
      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

      var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'Hello World!',
        icon: 'img/wave.png'
      });
      markers.push(marker);

      infowindow = new google.maps.InfoWindow({
        content: InfoWindowContentAdd
      });

      google.maps.event.addListener(map, "rightclick", function(event) {
        if(selectedMarker != null){ selectedMarker.setMap(null); selectedMarker = null; }
        selectedMarker = new google.maps.Marker({
          position: event.latLng,
          map: map,
          title: 'Hello World!'
        });

        if(infoWindowContent_addSlidersInit==null) infowindow.content = InfoWindowContentAdd;
        else infowindow.content = infoWindowContent_addSlidersInit;

        infowindow.open(map, selectedMarker);
        google.maps.event.addListener(infowindow, 'domready', function() {
          // Save the html code of the infowindow after the slider have been init.
          if(infoWindowContent_addSlidersInit==null){
            $.initSliders.init();
            infoWindowContent_addSlidersInit = "<div id='infoWindowDiv'>" 
                                              +document.getElementById("infoWindowDiv").innerHTML 
                                              +"</div>";
          }
        });
              
      });

      return this;
    }

    $.ggMapsFunctions.removeMarker = function() {
      selectedMarker.setMap(null);
      selectedMarker = null; 
    }

    $.ggMapsFunctions.addMarker = function() {
      InfoWindowContentAdd = "<div id='infoWindowDiv'>" +document.getElementById("infoWindowDiv").innerHTML +"</div>";
      //parseRawForm(); // Parse the form and saves it.

      var marker = new google.maps.Marker({
        position: selectedMarker.position,
        map: map,
        title: selectedMarker.title,
        icon: 'img/wave.png'
      });
      selectedMarker.setMap(null);
      markers.push(marker);
      electedMarker = null;


      google.maps.event.addListener(marker, 'click', function() {
        selectedMarker = this;
        infowindow.content = InfoWindowContentRemove;
        infowindow.open(map, marker);
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