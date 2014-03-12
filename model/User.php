<?php

// The current user.

class User {

	public function __construct(){
		if(!isset($_SESSION))
			session_start();
	}

	public function isLoggedIn(){
		$logged = false;
		if(isset($_SESSION['IS_AUTHENTICATED']) &&  $_SESSION['IS_AUTHENTICATED']===true)
			$logged = true;

		return $logged;
	}

	public function isAdmin(){

		// mysqli
		if(isset($_SESSION['username']) && $_SESSION['username']=='gpalex') // TEMPORAIRE à remplacer par des requêtes myqsli
			return true;

		return false;
	}

	public function getLoggedAsStatement(){
		$statement = "";
		if($this->isLoggedIn() === true && isset($_SESSION['username'])) 
			$statement = ' - logged as ' . $_SESSION['username'];

		return $statement;
	}

	public function canEditLocations(){
		
		// mysqli ...

		return false;
	}
}