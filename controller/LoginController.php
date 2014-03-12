<?php

require_once("TemplateEngine.php");
require_once("../model/Login.php");
require_once("BaseController.php");


class LoginController extends BaseController {
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

