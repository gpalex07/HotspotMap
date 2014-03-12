
// PLUGIN searchFunctions  containing the functions we added to handle our custom actions.

(function($) {
  $.searchFunctions = function() {}


  $.searchFunctions.initialize=function(){
    $.searchFunctions.addUserPositionLink();
    $.searchFunctions.setupLocationSearch();
  }

  $.searchFunctions.buildHtmlTableFromJson=function(data) {
    var table='<table style="width:100%"><tr><th>Name</th><th>Free connection</th><th>Free coffee</th><th>Rating (./5)</th><th>Distance from you (km)</th></tr>';
    var jData = jQuery.parseJSON(data);

    $.each( jData, function( index, item){
        /* add to html string started above*/
        var coffee = (item.free_coffee=='1')?'yes':'no';
        var connection = (item.free_connection=='1')?'yes':'no';
        var dist = (""+parseInt(item.distance)).replace(/\B(?=(\d{3})+(?!\d))/g, " "); // Regroup every 3 digits
        var link = 'javascript:$.ggMapsFunctions.goToCoordinates(' + item.lat +',' + item.lng + ');';
        table+='<tr><td><a href="' + link + '">'+item.name+'</a></td><td>'+connection+'</td><td>'+coffee+'</td><td>'+item.rating+'</td><td>'+dist+'</td></tr>';       
    });
    table+='</table>';

    return table;
  }


  // Adds a link to go to user position on the map
  $.searchFunctions.addUserPositionLink=function() {
    $("#user-location").html("Your location is: <a href='#' title='You must allow the website to use your location.'>not available</span>.");

    if (navigator.geolocation){
      navigator.geolocation.getCurrentPosition(function(position){
        var userLat=position.coords.latitude;
        var userLng=position.coords.longitude;

        var link = 'javascript:$.ggMapsFunctions.goToCoordinates(' + userLat +',' + userLng + ');';

        $("#user-location").html("Your location is: <a href='" + link + "'>(" + userLat + ", " + userLng + ")</a>");
        $.ggMapsFunctions.addUserPositionMarker(userLat,userLng); // Adds a marker to the map indicating the user's position.
        $.ggMapsFunctions.goToCoordinates(userLat,userLng); // Center the map on user position
      });
    }
  }

  $.searchFunctions.setupLocationSearch=function() {
    $( "#search-button" ).click(function() {
      $("#search-location-results").html("<center><img src='../view/img/loading.gif' /></center>"); // Loading animation
      var name   = $( "#search-locationName" ).val();
      var radius = $( "#search-maxDistance" ).val();
      var userLat = "";
      var userLng = "";
      if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function(position){
          userLat=position.coords.latitude;
          userLng=position.coords.longitude;

          $.get( "/location/search?name="+name+"&radius="+radius+"&userLat="+userLat+"&userLng="+userLng).done(function(data, textStatus, jqXHR){
            var res = $.searchFunctions.buildHtmlTableFromJson(data);
            $("#search-location-results").html(res);

          }).fail(function(jqXHR, textStatus, errorThrown){
            $("#search-location-results").html(jQuery.parseJSON(jqXHR.responseText));
          });



          /*$.get( "/location/search?name="+name+"&radius="+radius+"&userLat="+userLat+"&userLng="+userLng, function( data ) {
            //$("#search-location-results").html(data);

            // Converts json to html table
            var res = $.searchFunctions.buildHtmlTableFromJson(data);

            $("#search-location-results").html(res);
          });*/

        });
      } else $("#search-location-results").html("Your position (lat,lng) is not available.");

    });
  }

})(jQuery);
