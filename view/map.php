<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
    <style>
      
    </style>
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/editPageText.js"></script>
    <script src="js/bgBarTimetable.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
    
</script>
    <script>
      var markers = [];
      var map;
      var infowindow;
      var selectedMarker; // The current marker.
      var InfoWindowContentAdd;

      // Charge le contenu de l'infoWindow pour l'action add.
      $.get( "infoWindow_add.html", function( data ) {
        InfoWindowContentAdd = data;
      });



      var InfoWindowContentRemove = 
                  "<div id='infoWindowDiv'>"
                   +"<a href='javascript:void(0)' ' onclick='removeMarker()'>Remove this location</a><br/>"
                 +"</div>";


      function initialize() {
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

          infowindow.content = InfoWindowContentAdd;
          infowindow.open(map, selectedMarker);
          updateTimetableBackground();
        });

      }

      google.maps.event.addDomListener(window, 'load', initialize);

      


    </script>
    <script>
        function removeMarker(){ 
          selectedMarker.setMap(null);
          selectedMarker = null; 
        };
        function addMarker(){
          var marker = new google.maps.Marker({
            position: selectedMarker.position,
            map: map,
            title: selectedMarker.title,
            icon: 'img/wave.png'
          });
          selectedMarker.setMap(null);
          markers.push(marker);
          selectedMarker = null;


          google.maps.event.addListener(marker, 'click', function() {
            selectedMarker = this;
            infowindow.content = InfoWindowContentRemove;
            infowindow.open(map, marker);
          });

          // Save
          var f = document.getElementsByName('infoWindowDiv');
          alert("saving "+f.length);

        };
    </script>
    <!-- Star system (css-star-rater) -->
    <link rel="stylesheet" type="text/css" href="css/css-star-rater.css" /> 
    <link rel="stylesheet" type="text/css" href="css/main.css" /> 
  </head>
  <body>

    
    <div id="map-canvas"></div>
    <div id="commentaires"><center>Commentaires</center>

      

    </div>
    <input name="btn" value="Remove the marker" type="button" onclick="removeMarker()" />

  </body>
</html>