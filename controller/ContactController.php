<?php

require_once("TemplateEngine.php");
require_once("../model/Contact.php");
require_once("BaseController.php");


class ContactController extends BaseController {
	public function show(){
		// First we get values to put in the template
		$co = new Contact();
		$options = $co->show();

		// Twig
		$en = new TemplateEngine('contact', 'show.twig');
		$en->render($options);
	}
}


?>