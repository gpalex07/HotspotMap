<?php

require_once("TemplateEngine.php");
require_once("../model/About.php");
require_once("BaseController.php");


class AboutController extends BaseController {
	public function show(){
		// First we get values to put in the template
		$ab = new About();
		$options = $ab->show();

		// Twig
		$en = new TemplateEngine('about', 'show.twig');
		$en->render($options);
	}
}


?>