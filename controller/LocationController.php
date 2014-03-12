<?php

require_once("TemplateEngine.php");
require_once("../model/Location.php");


class LocationController {
	public function show($id = ''){
		if(strlen($id) != 0){
			$loc = new Location();
			$options = $loc->getLocationById($id);

			// Twig
			$en = new TemplateEngine('location', 'show.twig');
			$en->render($options);
		} else {
			// Twig
			$en = new TemplateEngine('infowindow', 'error.twig');
			$options = array('error' => 'The location\'s id was not sent');
			$en->render($options);
		}
	}
}


?>

