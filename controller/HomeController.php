<?php

require_once("TemplateEngine.php");
require_once("../model/Home.php");
require_once("BaseController.php");


class HomeController extends BaseController {
	public function show(){
		// First we get values to put in the template
		$ho = new Home();
		$options = $ho->show();

		// Twig
		$en = new TemplateEngine('home', 'show.twig');
		$en->render($options);
	}
}


?>