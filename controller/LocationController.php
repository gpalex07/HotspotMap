<?php

require_once("TemplateEngine.php");
require_once("../model/Location.php");
require_once("BaseController.php");


class LocationController extends BaseController {

	protected $errorCode = '-1';

	public function show($id = ''){
		if(strlen($id) != 0){
			$loc = new Location();
			$options = $loc->getLocationById($id);

			$currentUser = new User();
			$loginOptions = array(	'loggedIn' 					=> $currentUser->isLoggedIn(),
									'userCanEdit'				=> $currentUser->isAdmin(),
									'loggedAsStatementString' 	=> $currentUser->getLoggedAsStatement());

			$options = array_merge($options, $loginOptions);

			if($options['found'] === true){
				// Twig
				$en = new TemplateEngine('location', 'show.twig');
				$en->render($options);
			} else {
				$options = array('error' => "There is no location with this id (id='" . $id . "').");
				$this->error($options);
			}

		} else {
			$options = array('error' => 'The location\'s id was not sent');
			$this->error($options);
		}
	}

	public function error(array $options = []){
		// Twig
		$en = new TemplateEngine('location', 'error.twig');
		$en->render($options);
	}

	public function add(){

		if($_SERVER['REQUEST_METHOD'] === 'GET'){ // Get the html form to enter the location's caracteristics.
			$this->getAddForm();
		} else if($_SERVER['REQUEST_METHOD'] === 'POST'){ // Send to completed form in order to add the new location to database.
			$this->addNewLocation();
		}

	}

	public function getAddForm(){
		// Twig
		$en = new TemplateEngine('location', 'add.twig');
		$options = array();
		$en->render($options);
	}

	public function addNewLocation(){
		$name				= '';
		$schedule			= '';
		$free_connection 	= '';
		$free_coffee		= '';
		$rating 			= '';
		$lat 				= '';
		$lng 				= '';

		if(isset($_POST['name']))             	$name				= $_POST['name']; //mysqli_real_escape_string
		if(isset($_POST['schedule'])) 			$schedule			= $_POST['schedule'];
		if(isset($_POST['free_connection']))  	$free_connection	= $_POST['free_connection'];
		if(isset($_POST['free_coffee']))      	$free_coffee		= $_POST['free_coffee'];
		if(isset($_POST['rating']))           	$rating 			= $_POST['rating'];
		if(isset($_POST['lat']))              	$lat 				= $_POST['lat'];
		if(isset($_POST['lng']))             	$lng 				= $_POST['lng'];



		if(isset($_POST['name']) 
			&& strlen($name) != 0
			&& isset($_POST['schedule']) 
			&& isset($_POST['free_connection']) 
			&& isset($_POST['free_coffee']) 
			&& isset($_POST['rating']) 
			&& isset($_POST['lat']) 
			&& isset($_POST['lng'])){

				$loc = new Location();
				$res = $loc->addLocation($this->errorCode, $name, $schedule, $free_connection, $free_coffee, $rating, $lat, $lng);

				if($res === $this->errorCode){
					http_response_code(500); // Internal error
				} else {
					http_response_code(201); // Created
					echo $res; // Return the id of the new marker.
				}

		} else {
			http_response_code(400); // Bad request
			$errorMessage = 'Please enter a name for the location!';
			/*$errorMessage = 'Some fields are empty!' . "\n"
						  . '$name= ' 				. $name . "\n"
						  . '$schedule= ' 			. $schedule . "\n"
						  . '$free_connection= ' 	. $free_connection . "\n"
						  . '$free_coffee= ' 		. $free_coffee . "\n"
						  . '$rating= ' 			. $rating . "\n"
						  . '$lat= ' 				. $lat . "\n"
						  . '$lng= ' 				. $lng . "\n";*/


			echo json_encode($errorMessage);
			// Twig
			/*$en = new TemplateEngine('location', 'error.twig');
			$options = array('error' => $errorMessage);
			$en->render($options);*/
		}
	}

	public function remove($id = -1){

		if($_SERVER['REQUEST_METHOD'] === 'DELETE'){ // DELETE a location.
			$this->removeLocation($id);
		}

	}

	public function removeLocation($id){
		if(is_numeric($id) && $id > 0){
			$loc = new Location();
			$res = $loc->removeLocation($id);

			if($res){
				http_response_code(200); // Success
			} else {
				http_response_code(500); // Internal server error
			}
		}
	}

	public function search(){

		if(isset($_GET['name']) && isset($_GET['radius']) /*&& (!empty($_GET['name']) || !empty($_GET['radius']))*/){
			if(isset($_GET['userLat']) && isset($_GET['userLng'])){

				$loc = new Location();
				try {
					$res = $loc->searchLocation($_GET['name'], $_GET['radius'], $_GET['userLat'], $_GET['userLng']);
					http_response_code(200); // Success
					echo $res;
				} catch(Exception $e){
					http_response_code(500); // Internal error
					echo json_encode($e->getMessage());
				}


			} else {
				http_response_code(400); // Bad request
				echo json_encode("Sorry, geolocalisation failed. Your location has not been detected. Search aborted.");
			}
		} else {
			http_response_code(400); // Bad request
			$options = array('error' => "Please type the name of the location or a radius.");
			$this->error($options);
		}

	}
}


?>

