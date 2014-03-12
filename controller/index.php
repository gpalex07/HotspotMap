<?php


require_once("FrontControllerInterface.php");
require_once("FrontController.php");

require_once("HomeController.php");
require_once("AboutController.php");
require_once("ContactController.php");
require_once("LoginController.php");
require_once("LocationController.php");
 
$frontController = new FrontController();
$frontController->run();