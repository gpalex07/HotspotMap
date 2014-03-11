<?php

require_once("TemplateEngine.php");


class AboutController {
	public function show(){
		$en = new TemplateEngine('about', 'show.twig');

		$options= array();
		$en->render($options);
	}
}


?>