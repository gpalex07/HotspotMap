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

?>