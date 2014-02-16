<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="css/css-star-rater.css" /> <!-- Star rating system (css-star-rater) used in the infowindow -->
    <link rel="stylesheet" href="css/jslider.css" type="text/css"> <!-- jSlider used in the infowindow -->
    <link rel="stylesheet" type="text/css" href="css/main.css" /> 
    <!-- end css -->

    
    <!-- javascript -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <!-- jSlider js files (jSlider is used in the infowindw) -->
    <script type="text/javascript" src="js/jSlider/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="js/jSlider/jshashtable-2.1_src.js"></script>
    <script type="text/javascript" src="js/jSlider/jquery.numberformatter-1.2.3.js"></script>
    <script type="text/javascript" src="js/jSlider/tmpl.js"></script>
    <script type="text/javascript" src="js/jSlider/jquery.dependClass-0.1.js"></script>
    <script type="text/javascript" src="js/jSlider/draggable-0.1.js"></script>
    <script type="text/javascript" src="js/jSlider/jquery.slider.js"></script>
    <!-- end jSlider -->
    <!-- end javascript -->
    <script src="js/form.js"></script>
    <script src="js/ggMapsFunctions.js"></script>  
          
    <script type="text/javascript">
        $(document).ready(init);
        function init() 
        {
          $.ggMapsFunctions.initialize();
        }
    </script>

  
  </head>
  <body>
    <div id="page-container">
      <div id="map-canvas"></div>
      <div id="commentaires">Commentaires</div>
    </div>
  </body>
</html>