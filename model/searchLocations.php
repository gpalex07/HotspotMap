<?php

if(isset($_GET['name']) && isset($_GET['radius']) && (!empty($_GET['name']) || !empty($_GET['radius'])))
{
	if(isset($_GET['userLat']) && isset($_GET['userLng']))
	{
		$KM_TO_MILES = 0.621371192;
		$MILES_TO_KM = 1.609344;

		$name  =$_GET['name'];
	  	$radius=$_GET['radius'];

	  	$mysqli = new mysqli("localhost", "isima", "isima", "hotspotmap");

	  	/* check connection */
	  	if ($mysqli->connect_errno) {
	      	printf("Connect failed: %s\n", $mysqli->connect_error);
	      	exit();
	  	}

	  	$latitude  = $_GET['userLat'];
	  	$longitude = $_GET['userLng'];
	  	//$squarredRadius = $_GET['radius'] * $_GET['radius']; // Convert radius from km to miles


	  	/* Select queries return a resultset */
	  	// I don't take the SQRT of the distance, instead, I squarred the radius (for performance).
	  	/*if($result = $mysqli->query("SELECT *, 
	      	POW(69.1 * (lat - $latitude), 2) +
	      	POW(69.1 * ($longitude - lng) * COS(lat / 57.3), 2) AS distance
	  		FROM locations HAVING distance < $squarredRadius ORDER BY distance"))*/
		if($result = $mysqli->query("SELECT *, ((ACOS(SIN($latitude * PI() / 180) * SIN(lat * PI() / 180) + COS($latitude * PI() / 180) * COS(lat * PI() / 180) * COS(($longitude - lng) * PI() / 180)) * 180 / PI()) * 60 * 1.1515)*$MILES_TO_KM AS `distance` FROM `locations` HAVING `distance` <=$radius ORDER BY `distance` ASC"))
	  	{
	  		$data = array();
			while($row = $result->fetch_assoc()) {
			  $data[]=$row;
			}
	  		echo json_encode($data);
	  	} else echo json_encode($mysqli->error);

	  	$mysqli->close();
	} else {
		echo json_encode("Sorry, geolocalisation failed. Your location has not been detected. Search aborted.");
	}

} else echo json_encode("Please type the name of the location or a radius.");

?>