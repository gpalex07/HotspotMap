<?php

session_start();

$markersList = array();

$mysqli = new mysqli("localhost", "isima", "isima", "hotspotmap");

/* check connection */
if ($mysqli->connect_errno) {
  printf("Connect failed: %s\n", $mysqli->connect_error);
  exit();
}

/* Select queries return a resultset */
if ($result = $mysqli->query("SELECT * FROM `locations`")) {

	
	while($row = $result->fetch_assoc()) {
	  $markersList[]=$row;
	}
  	//$markersList = $result->fetch_array(MYSQLI_ASSOC);

  	/* free the result set */
  	$result->close();
}

$mysqli->close();




// FOR TWIG
// Build the javascript code that contains the list of markers to display on the map when the page loads.
$markersJavascriptString = "";

for($i=0; $i<count($markersList); ++$i){
    $markersJavascriptString .= "[" . $markersList[$i]["id"] . "," . $markersList[$i]["lat"] . "," . $markersList[$i]["lng"] . ",\"" . $markersList[$i]["name"] . "\"]";
    if($i < count($markersList)-1) $markersJavascriptString .= ",";
}


// Determines if we need to display the logout button.
$logoutLinkString = "";
if(isset($_SESSION['username'])) $logoutLinkString = '<li><a href="logout.php">Logout</a></li>';


// Determines if we need to display the logged in statement.
$loggedAsStatementString = "";
if(isset($_SESSION['username'])) $loggedAsStatementString = ' - logged as ' . $_SESSION['username'];

// Determine if we need to display the login button.
$loginLinkString = "";
if(!isset($_SESSION['username'])) $loginLinkString = "<p><a class=\"btn btn-lg btn-success\" href=\"../controller/login.php\" role=\"button\">Log-in!</a></p>";





?>