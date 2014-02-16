<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hotspot Map</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap_dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">

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
    <script src="js/sliders.js"></script>
    <script src="js/ggMapsFunctions.js"></script> 
    <script src="js/disqusFunctions.js"></script> 
          
    <script type="text/javascript">
        $(document).ready(init);
        function init() 
        {
          $.ggMapsFunctions.initialize();
        }
    </script>





    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="home.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <h3 class="text-muted">Hotspot Map</h3>
      </div>

      <div class="jumbotron">
        <h1>Find the best places to code!</h1>
        <p class="lead">Hotspot Map allows you to quickly find the best places where you can code with free internet connection, free coffee, comfortable sofas ... and more!</p>
        <p><a class="btn btn-lg btn-success" href="#" role="button">Sign in with Twitter</a></p>
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <h4>Search for locations next to you!</h4>
          <p>a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a </p>

          <h4>a a a a a a a a a a </h4>
          <p>a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a </p>

          <h4>a a a a a a a a a a </h4>
          <p>a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a </p>
        </div>

        <div class="col-lg-6">
          <h4>Join the community to add new locations!</h4>
          <p>b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b b </p>

          <h4>a a a a a a a a a a </h4>
          <p>a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a </p>

          <h4>a a a a a a a a a a </h4>
          <p>a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a a </p>
        </div>
      </div>

      <!-- Google Map -->
      <div id="map-canvas"></div>

            
      <!-- DISQUS AJAX -->
      <div id="disqus_thread"></div>
      <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'hotspotmap'; // required: replace example with your forum shortname
        var disqus_identifier = '1';
        var disqus_url = "http://localhost/map.php";

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
      </script>
      <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
      <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
      <!-- END DISQUS -->
    


      <div class="footer">
        <p>&copy; Pierre-Alexandre Guénolé, Ecrah EZA - ISIMA 2014</p>
      </div>

    </div> <!-- /container -->

    <input type="button" value="destroy sliders" onclick="$.sliders.destroySliders()" />

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
