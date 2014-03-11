<?php

require_once '../vendor/twig/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();


class TemplateEngine {
	private $loader;
	private $engine;
	private $template;

	public function __construct($controllerName, $templateName) {
		$this->loader = new Twig_Loader_Filesystem('../templates/');
		$this->engine = new Twig_Environment($this->loader);

		$this->template = $this->engine->loadTemplate( $controllerName . '/' . $templateName);
	}

	public function render(array $options = []){ // options <=> array()
		echo $this->template->render( $options ); 
	}
}

?>