<?php

class BaseController {

	// The default behavior for a controller, is to redirect the user on home page when an error occurs. We however overloaded this function in specific controllers.
	public function error(array $options = []){

		header('Location: /home/show');
		die();

	}

}