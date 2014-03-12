<?php 

require_once("User.php");

class Location {
	protected $name = '';
	protected $schedule = array();
	protected $freeConnection = false;
	protected $freeCoffee = false;
	protected $rate;

	public function __construct(){
		if(!isset($_SESSION))
			session_start();
	}	

	public function getLocationById($id = ''){

		$options = array('found' => false);

		if(strlen($id) != 0){
		  	$mysqli = new mysqli("localhost", "isima", "isima", "hotspotmap");
		  
		  	if ($mysqli->connect_errno) { // check connection
		    	printf("Connect failed: %s\n", $mysqli->connect_error);
		    	exit();
		  	}

		  	/* Select queries return a resultset */
		  	if ($result = $mysqli->query("SELECT * FROM `locations` WHERE id=" . $id)) {
		    	if($result->num_rows == 0){ // No result
		      		$data = array( "name" => "Location not found for id='".$id."'.");
		    	} else {


		      	$data = $result->fetch_array(MYSQLI_ASSOC);

		      	$horaires = explode('/', $data['schedule']);
			  	$currentUser = new User();

				$options = array(
					'id' 				=> $data['id'],
					'name' 				=> $data['name'],
					'scheduleMonday' 	=> $horaires[0],
					'scheduleTuesday' 	=> $horaires[1],
					'scheduleWednesday' => $horaires[2],
					'scheduleThursday' 	=> $horaires[3],
					'scheduleFriday' 	=> $horaires[4],
					'scheduleSaturday' 	=> $horaires[5],
					'scheduleSunday' 	=> $horaires[6],
					'freeCoffee' 		=> $data['free_coffee'],
					'freeConnection' 	=> $data['free_connection'],
					'rating' 			=> intval($data["rating"]),
					'loggedIn' 					=> $currentUser->isLoggedIn(),
					'userCanEdit'				=> $currentUser->isAdmin(),
					'loggedAsStatementString' 	=> $currentUser->getLoggedAsStatement()
				);

				$options['found'] = true;
		    }
		    
		    $result->close(); // free the result set
		  }

		  $mysqli->close();

		} else { $data = array( "name" => "Location's id not specified."); }

		return $options;
	}

	public function addLocation($errorCode, $name='', $schedule='', $free_connection='', $free_coffee='', $rating='', $lat='', $lng=''){

		if($free_connection=='true') 	$free_connection=1;
		if($free_connection=='false')	$free_connection=0;
		if($free_coffee=='true') 		$free_coffee=1;
		if($free_coffee=='false') 		$free_coffee=0;


		$res = $errorCode;

		$mysqli = new mysqli("localhost", "isima", "isima", "hotspotmap");
		$name = $mysqli->real_escape_string($name);

		// Check connection
		if ($mysqli->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}

		// Select queries return a resultset
		if ($result = $mysqli->query("INSERT INTO `hotspotmap`.`locations` (`id`, `name`, `schedule`, `free_connection`, `free_coffee`, `rating`, `lat`, `lng`) VALUES (NULL, '$name', '$schedule', '$free_connection', '$free_coffee', '$rating', '$lat', '$lng')")){
			  	
			$res = json_encode($mysqli->insert_id); // MARKER_ADDED_CONFIRMED (return the id of the new marker, which means insertion succeeded).
		}

		$mysqli->close();

		return $res;
	}

	public function removeLocation($id){
		$success =false;

		$mysqli = new mysqli("localhost", "isima", "isima", "hotspotmap");

		/* check connection */
		if ($mysqli->connect_errno) {
		    printf("Connect failed: %s\n", $mysqli->connect_error);
		    exit();
		}

		/* Select queries return a resultset */
		if ($mysqli->query("DELETE FROM `locations` WHERE id=" . $id)) {
			if($mysqli->affected_rows > 0)
		  		$success = true;
		}

		$mysqli->close();

		return $success;
	}

	public function searchLocation($locationName, $radius, $userLat, $usrLng){

		$res = json_encode("");

		$KM_TO_MILES = 0.621371192;
		$MILES_TO_KM = 1.609344;

		$mysqli = new mysqli("localhost", "isima", "isima", "hotspotmap");

		$locationName = $mysqli->real_escape_string($locationName);
		$userLat = $mysqli->real_escape_string($userLat);
		$usrLng = $mysqli->real_escape_string($usrLng);
		if(!is_numeric($radius)) $radius=-1;

		// Check connection
		if ($mysqli->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}

		if($radius<0) // We need to define a >0 radius since there will be no result otherwise.
			$radius = PHP_INT_MAX;

		// We always need to make a request with the distance constraint to be able to display the locations distance from the user position (in the search result, last column).
		$queryString ="SELECT *, ((ACOS(SIN($userLat * PI() / 180) * SIN(lat * PI() / 180) + COS($userLat * PI() / 180) * COS(lat * PI() / 180) * COS(($usrLng - lng) * PI() / 180)) * 180 / PI()) * 60 * 1.1515)*$MILES_TO_KM AS `distance` FROM `locations` WHERE `name` LIKE '%$locationName%' HAVING `distance` <=$radius ORDER BY `distance` ASC";
		
			
		


		if($result = $mysqli->query($queryString)){
			$data = array();
			while($row = $result->fetch_assoc())
				$data[]=$row;
			
			$res = json_encode($data);
		} else {
			//$res = json_encode($mysqli->error);
			throw new Exception($mysqli->error);
		}

		$mysqli->close();		

		return $res;
	}
}

?>