<?php

class Request {
    const GET  = 0;
    const POST = 1;
}


class Firewall {
	protected $allowed = [
		'home/show'    => [ Request::GET ],
		'about/show'   => [ Request::GET ],
		'login/login'  => [ Request::GET ],
		'contact/show' => [ Request::GET ]
	];

	public function __construct(){
		if(!isset($_SESSION))
			session_start();
	}

	public function isAllowed($controller, $action){

		if(isset($_SESSION['IS_AUTHENTICATED'])){
			return true;
		}

		$str = $controller . '/' . $action;
		foreach($this->allowed as $uri => $methods){
			if($str === $uri)
				return true;
		}

		return false;
	}
}

?>