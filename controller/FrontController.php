<?php

require_once("Firewall.php");


class FrontController implements FrontControllerInterface
{
    const DEFAULT_CONTROLLER_SHORT_NAME = "home";
    const DEFAULT_CONTROLLER 			= "HomeController";
    const DEFAULT_ACTION     			= "show";
   
    protected $controllerShortName 	= self::DEFAULT_CONTROLLER_SHORT_NAME;
    protected $controller    		= self::DEFAULT_CONTROLLER;
    protected $action        		= self::DEFAULT_ACTION;
    protected $params        		= array();
    protected $basePath      		= "";
   
    public function __construct(array $options = array()) {
        if (empty($options)) {
           $this->parseUri();
        }
        else {
            if (isset($options["controller"])) {
                $this->setController($options["controller"]);
            }
            if (isset($options["action"])) {
                $this->setAction($options["action"]);    
            }
            if (isset($options["params"])) {
                $this->setParams($options["params"]);
            }
        }
    }
   
    protected function parseUri() {
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/"); // Remve last '/' (if any)
        $path = preg_replace('/[^a-zA-Z0-9]\//', "", $path); // Remove all unallowed caracters.
        /*if (strpos($path, $this->basePath) === false) {
            $path = substr($path, strlen($this->basePath));
        }*/
        @list($controller, $action, $params) = explode("/", $path, 3);
        if (isset($controller)) {
            $this->setController($controller);
        }
        if (isset($action)) {
            $this->setAction($action);
        }
        if (isset($params)) {
            $this->setParams(explode("/", $params));
        }
    }
   
    public function setController($controller) {
    	try {
	    	$this->controllerShortName = $controller;
	        $controller = ucfirst(strtolower($controller)) . "Controller";
	        if (!class_exists($controller)) {
	            /*throw new InvalidArgumentException(
	                "The action controller '$controller' has not been defined.");*/
	        }
	        $this->controller = $controller;

    	} catch(Exception $e){}

        return $this;
    }
   
    public function setAction($action) {
    	try {
    		$reflector = new ReflectionClass($this->controller);
	        if (!$reflector->hasMethod($action)) {
	            /*throw new InvalidArgumentException(
	                "The controller action '$action' has been not defined.");*/
	        }
	        $this->action = $action;
    	} catch(Exception $e){}
        
        return $this;
    }
   
    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }
   
    public function run() {
    	// no controller and no action => current url is lcoalhost/
    	if(strlen($this->controllerShortName) == 0 ){
    		$this->controller = "HomeController";
    		$this->controllerShortName = "home";
    		$this->action = "show";
    		$this->params = array();
    	}

    	// The firewall checks that the user has the permissions to acces the page.
    	$fw = new Firewall();
    	if($fw->isAllowed($this->controllerShortName, $this->action)){

			call_user_func_array(array(new $this->controller, $this->action), $this->params);

    	} else {
    		// Twig - 404 NOT FOUND
			$en = new TemplateEngine('', '404.twig');
			$options = array();
			$en->render($options);
    	}
    }
}