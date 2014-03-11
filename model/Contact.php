<?php

class Contact {

	public function __construct(){
		if(!isset($_SESSION))
			session_start();
	}

	public function show(){

		// Determines if we need to display the logged in statement.		
		$userIsLogged = false;
		if(isset($_SESSION['IS_AUTHENTICATED']) &&  $_SESSION['IS_AUTHENTICATED']===true)
			$userIsLogged = true;


		$loggedAsStatementString = "";
		if($userIsLogged === true && isset($_SESSION['username'])) $loggedAsStatementString = ' - logged as ' . $_SESSION['username'];

		$options = array(
			'controller' => 'contact',
			'loggedIn' => $userIsLogged,
			'loggedAsStatementString' => $loggedAsStatementString
		);
		return $options;
	}
}

?>