<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
    <style>
      #map-canvas {
        width:600px;
        height:500px;
        float: left;
      }
      #commentaires {
        width:300px;
        height:500px;
        border:1px solid black;
        float: left;
      }
      #infoWindowDiv {
        width:300px;
        height:300px;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
      var markers = [];
      var map;
      var infowindow;
      var selectedMarker; // The current marker.

      var InfoWindowContentAdd = 
                  "<div id='infoWindowDiv'>"
                   +"Rate : "
                   +"<span class='rating'>"
                   +"     <input type='radio' class='rating-input' id='rating-input-1-5' name='rating-input-1'>"
                   +"     <label for='rating-input-1-5' class='rating-star'></label>"
                   +"     <input type='radio' class='rating-input' id='rating-input-1-4' name='rating-input-1'>"
                   +"     <label for='rating-input-1-4' class='rating-star'></label>"
                   +"     <input type='radio' class='rating-input' id='rating-input-1-3' name='rating-input-1'>"
                   +"     <label for='rating-input-1-3' class='rating-star'></label>"
                   +"     <input type='radio' class='rating-input' id='rating-input-1-2' name='rating-input-1'>"
                   +"     <label for='rating-input-1-2' class='rating-star'></label>"
                   +"     <input type='radio' class='rating-input' id='rating-input-1-1' name='rating-input-1'>"
                   +"     <label for='rating-input-1-1' class='rating-star'></label>"
                   +" </span><br/>"
                   +"<table style='border:1px solid black'>"
                   +"<tr>"
                   +"<td>Lundi</td>"
                   +"<td><div style='background-color:gray; width:120px; text-align:center'>8h - 20h</div></td>"
                   +"</tr>"
                   +"<tr>"
                   +"<td>Mardi</td>"
                   +"<td><div style='background-color:gray; margin-left:10px; width:90px; text-align:center'>9h - 18h</div></td>"
                   +"</tr>"
                   +"<tr>"
                   +"<td>Mercredi</td>"
                   +"<td><div style='background-color:gray; width:120px; text-align:center'>8h - 20h</div></td>"
                   +"</tr>"
                   +"<tr>"
                   +"<td>Jeudi</td>"
                   +"<td><div style='background-color:gray; width:120px; text-align:center'>8h - 20h</div></td>"
                   +"</tr>"
                   +"<tr>"
                   +"<td>Vendredi</td>"
                   +"<td><div style='background-color:gray; width:120px; text-align:center'>8h - 20h</div></td>"
                   +"</tr>"
                   +"<tr>"
                   +"<td>Samedi</td>"
                   +"<td><div style='background-color:gray; width:120px; text-align:center'>8h - 20h</div></td>"
                   +"</tr>"
                   +"<tr>"
                   +"<td>Dimanche</td>"
                   +"<td><div style='background-color:gray; width:120px; text-align:center'>8h - 20h</div></td>"
                   +"</tr>"
                   +"</table>"
                   +"<input type='checkbox' /> free connection<br>"
                   +"<input type='checkbox' /> free coffee<br>"
                   +""
                   +""
                   +""
                   +""
                   +"<a href='javascript:void(0)' id='addLocation' onclick='addMarker()'>Add this location</a><br/>"
                 +"</div>";

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

        };
    </script>
    <!-- Star system (css-star-rater) -->
    <link rel="stylesheet" type="text/css" href="css-star-rater.css" /> 
  </head>
  <body>

    
    <div id="map-canvas"></div>
    <div id="commentaires"><center>Commentaires</center>

      

    </div>
    <input name="btn" value="Remove the marker" type="button" onclick="removeMarker()" />

  </body>
</html>