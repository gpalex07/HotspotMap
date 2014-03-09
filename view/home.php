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
    <link href="../view/bootstrap_dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../view/css/jumbotron-narrow.css" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../view/css/css-star-rater.css" /> <!-- Star rating system (css-star-rater) used in the infowindow -->
    <link rel="stylesheet" type="text/css" href="../view/css/jslider.css" /> <!-- jSlider used in the infowindow -->
    <link rel="stylesheet" type="text/css" href="../view/css/main.css" /> 
    <!-- end css -->

    
    <!-- javascript -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <!-- jSlider js files (jSlider is used in the infowindw) -->
    <script type="text/javascript" src="../view/js/jSlider/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="../view/js/jSlider/jshashtable-2.1_src.js"></script>
    <script type="text/javascript" src="../view/js/jSlider/jquery.numberformatter-1.2.3.js"></script>
    <script type="text/javascript" src="../view/js/jSlider/tmpl.js"></script>
    <script type="text/javascript" src="../view/js/jSlider/jquery.dependClass-0.1.js"></script>
    <script type="text/javascript" src="../view/js/jSlider/draggable-0.1.js"></script>
    <script type="text/javascript" src="../view/js/jSlider/jquery.slider.js"></script>
    <!-- end jSlider -->
    <!-- end javascript -->
    <script src="../view/js/form.js"></script>
    <script src="../view/js/searchFunctions.js"></script>
    <script src="../view/js/ggMapsFunctions.js"></script> 
    <script src="../view/js/disqusFunctions.js"></script> 
          
    <script type="text/javascript">
        var currentMarkers = [
        <?php 
        for($i=0; $i<count($markersList); ++$i){
          echo "[" . $markersList[$i]["id"] . "," . $markersList[$i]["lat"] . "," . $markersList[$i]["lng"] . ",\"" . $markersList[$i]["name"] . "\"]";
          if($i < count($markersList)-1) echo ",";
        }
        ?>];
      

        $(document).ready(init);
        function init() 
        {
          $.ggMapsFunctions.initialize();
        }
    </script>

  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="home.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
          <?php if(isset($_SESSION['username'])) echo '<li><a href="logout.php">Logout</a></li>'; ?>
        </ul>
        <h3 class="text-muted">Hotspot Map <?php if(isset($_SESSION['username'])) echo ' - logged as ' . $_SESSION['username']; ?></h3>
      </div>

      <div class="jumbotron">
        <h1>Find the best places to code!</h1>
        <p class="lead">Hotspot Map allows you to quickly find the best places where you can code with free internet connection, free coffee, comfortable sofas ... and more!</p>
        <?php if(!isset($_SESSION['username'])) echo "<p><a class=\"btn btn-lg btn-success\" href=\"../controller/login.php\" role=\"button\">Log-in!</a></p>"; ?>
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <h4>Search for locations next to you!</h4>
          <p>By using our search tool below the map, you can easily find locations next to you.</p>

          <h4>Tell everyone what you think about a location!</h4>
          <p>Our website allows to post comments by using Disqus.</p>

          <h4>Add new locations!</h4>
          <p>Once you're logged-in HotspotMap, you can add new locations by right clicking the map.</p>
        </div>

        <div class="col-lg-6">
          <h4>Join the community to add new locations!</h4>
          <p>Thanks to Disqus SSO, there's no need to create an account specifically for HotspotMap. You can log-in directly with your Facebook, Google, Twitter accounts.</p>

          <h4>Time is money!</h4>
          <p>Login in both Disqus & HotspotMap at once. Thanks to Disqus SSO, we offer you to save time. On HotspotMap you won't waste your time by login two times (one time for our website and an other time Disqus).</p>

          <h4>It's free!</h4>
          <p>Everything is free here.</p>
        </div>
      </div>


      <script type="text/javascript">
        var disqus_config = function () {
        // The generated payload which authenticates users with Disqus
        this.page.remote_auth_s3 = '<message> <hmac> <timestamp>';
        this.page.api_key = 'CFdwBHTkz28s3951gIuQXWsY0cXyg2n8EsJZh6Utx3DYeGEt5U3mXUqaC9kIxhut';

        // This adds the custom login/logout functionality
        this.sso = {
          name:    "HotspotMap login",
          button:  "http://localhost/images/samplenews.gif",
          icon:    "http://localhost/favicon.png",
          url:     "http://localhost/controller/login.php",
          logout:  "http://example.com/logout/",
          width:   "800",
          height:  "400"
        };
      };
      </script>

      <!-- Google Map -->
      <div id="map-canvas"></div>


      <!-- Search Feature -->
      <div id="search-location">
        Search a location near me: 
        <input type="text" id="search-locationName" placeholder="location's name" />
        <input type="text" id="search-maxDistance"  placeholder="max. radius in km" id="maxDist" value="100000" />
        <input type="button" value="Search" id="search-button" />

        <div id='user-location'></div><br>

        <div id="search-location-results">
        </div>
      </div>
      <br>


            
      <!-- DISQUS AJAX -->
      <div id="disqus_thread"></div>




      <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'hotspotmap'; // required: replace example with your forum shortname
        var disqus_identifier = '1';
        var disqus_url = "http://localhost/home.php";

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

    <input type="button" value="destroy sliders" onclick="$.form.destroySliders()" />



    <script type="text/javascript">
      // Adds a text displaying the user location and adds the click listener on the search button
      $.searchFunctions.initialize();
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
