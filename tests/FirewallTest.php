<?php

require_once("Client.php");
require_once("../../controller/Firewall.php");


class FirewallTest extends PHPUnit_Framework_TestCase {

	// Check that we get 200 http code (success)
    function testVisitorCanReadLocation() {

    	$cl = new Client();
    	$httpCode = $cl->request('GET', 'http://127.0.0.1:8080/location/show/1');
    	self::assertTrue($httpCode === 200);

    }

    // Can't add location if not logged in (authorization requiered)
    function testVisitorCantAddLocation() {

    	$cl = new Client();
    	$httpCode = $cl->request('GET', 'http://127.0.0.1:8080/location/add');
    	self::assertTrue($httpCode === 401);

    }

    // Can't remove location if not admin (authorization requiered)
    function testVisitorCantRemoveLocation() {

    	$cl = new Client();
    	$httpCode = $cl->request('GET', 'http://127.0.0.1:8080/location/remove');
    	self::assertTrue($httpCode === 401);

    }

}


?>