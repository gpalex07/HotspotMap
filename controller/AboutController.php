<?php

require_once("TemplateEngine.php");
require_once("../model/About.php");


class AboutController {
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