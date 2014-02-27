<?php

$MARKER_DELETION_CONFIRMED = "MARKER_DELETION_CONFIRMED"; // The server's response to confirm that a marker has been deleted
$MARKER_DELETION_FAILED    = "MARKER_DELETION_FAILED";


if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$mysqli = new mysqli("localhost", "root", "", "HotspotMap");

	/* check connection */
	if ($mysqli->connect_errno) {
	    printf("Connect failed: %s\n", $mysqli->connect_error);
	    exit();
	}

	/* Select queries return a resultset */
	if ($result = $mysqli->query("DELETE FROM `locations` WHERE `id`=$id")){
	//if ($result = $mysqli->query("INSERT INTO `locations` (`id`, `name`, `free_connection`, `free_coffee`, `rating`, `lat`, `long`) VALUES (NULL, " . $name . ", " . $free_connection . ", " . $free_coffee . ", " . $rating . ", " . $lat . ", " . $long . ")")) {
	    
		echo $MARKER_DELETION_CONFIRMED; // MARKER_DELETION_CONFIRMED

	} else echo $MARKER_DELETION_FAILED;

	$mysqli->close();

} else { 
  	//echo 'No data recieved about the location ($_POST[name] is empty)';
  	echo $MARKER_DELETION_FAILED;
}



?>