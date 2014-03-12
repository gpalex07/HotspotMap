<?php

class Home {

	public function __construct(){
		if(!isset($_SESSION))
			session_start();
	}

	public function show(){
		$markersList = $this->getMarkersList();

		$markersJavascriptString = "";
		for($i=0; $i<count($markersList); ++$i){
		    $markersJavascriptString .= "[" . $markersList[$i]["id"] . "," . $markersList[$i]["lat"] . "," . $markersList[$i]["lng"] . ",\"" . $markersList[$i]["name"] . "\"]";
		    if($i < count($markersList)-1) $markersJavascriptString .= ",";
		}

		// Determines if we need to display the logged in statement.
		$currentUser = new User();
		$options = array(
			'controller' => 'home',
			'loggedIn' => $currentUser->isLoggedIn(),
			'loggedAsStatementString' => $currentUser->getLoggedAsStatement(),
			'markersJavascriptString' => $markersJavascriptString
		);
		return $options;
	}

	public function getMarkersList(){
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

		  	/* free the result set */
		  	$result->close();
		}

		$mysqli->close();

		return $markersList;
	}

}

?>