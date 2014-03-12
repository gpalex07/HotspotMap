<?php

class Request {
    const GET  = 0;
    const POST = 1;
}


class Firewall {
	protected $allowed = [
		'home/show'    		=> [ Request::GET ],
		'about/show'   		=> [ Request::GET ],
		'login/login'  		=> [ Request::GET ],
		'location/show'  	=> [ Request::GET ],
		'location/search'  	=> [ Request::GET ],
		'contact/show' 		=> [ Request::GET ]
	];

	protected $restricted = [
		'location/add'    	=> [ Request::POST ],
		'login/logout'    	=> [ Request::GET ]
	];

	protected $adminonly = [
		'location/remove'    => [ Request::GET ]
	];

	public function __construct(){
		if(!isset($_SESSION))
			session_start();
	}

	public function isPublic($controller, $action){
		// The uri without the parameters (only "controller/action").
		$str = $controller . '/' . $action;

		// public pages
		foreach($this->allowed as $uri => $methods){
			if($str === $uri)
				return true;
		}

		return false;
	}

	public function isRestricted($controller, $action){
		// The uri without the parameters (only "controller/action").
		$str = $controller . '/' . $action;

		// public pages
		foreach($this->restricted as $uri => $methods){
			if($str === $uri)
				return true;
		}

		return false;
	}

	public function isAdminOnly($controller, $action){
		// The uri without the parameters (only "controller/action").
		$str = $controller . '/' . $action;

		// public pages
		foreach($this->adminonly as $uri => $methods){
			if($str === $uri)
				return true;
		}

		return false;
	}
}

?>