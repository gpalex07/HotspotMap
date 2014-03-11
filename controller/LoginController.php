<?php

require_once("TemplateEngine.php");
require_once("../model/Login.php");


class LoginController {
	public function login(){
		$log = new Login();
		$log->doLogin();
	}

	public function logout(){
		$log = new Login();
		$log->doLogout();
	}
}


?>

