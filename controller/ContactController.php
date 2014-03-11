<?php

require_once("TemplateEngine.php");


class ContactController {
	public function show(){
		$en = new TemplateEngine('contact', 'show.twig');

		$options= array();
		$en->render($options);
	}
}


?>