<?php

require_once("Client.php");

class FirewallTest extends PHPUnit_Framework_TestCase {

  
  // The url syntax is localhost/controller/action/params
  function testNonExistingController(){
    $cl = new Client();
    $httpCode = $cl->request('GET', 'http://127.0.0.1:8080/fakecontroller');
    self::assertTrue($httpCode === 404);
  }

  // The url syntax is localhost/controller/action/params
  function testNonExistingAction(){
    $cl = new Client();
    $httpCode = $cl->request('GET', 'http://127.0.0.1:8080/home/fakeaction');
    self::assertTrue($httpCode === 404);
  }

  // The url syntax is localhost/controller/action/params
  function testAccesPageEnDur(){
    $cl = new Client();
    $httpCode = $cl->request('GET', 'http://127.0.0.1:8080/view/templates/head.twig');
    self::assertTrue($httpCode === 404);
  }

  // The url syntax is localhost/controller/action/params
  function testAccesDossierEnDur(){
    $cl = new Client();
    $httpCode = $cl->request('GET', 'http://127.0.0.1:8080/view/templates/');
    self::assertTrue($httpCode === 404);
  }

  // The url syntax is localhost/controller/action/params
  function testAccessHomeShow(){
    $cl = new Client();
    $httpCode = $cl->request('GET', 'http://127.0.0.1:8080/home/show');
    self::assertTrue($httpCode === 200);
  }

  // The url syntax is localhost/controller/action/params
  function testAccessAboutShow(){
    $cl = new Client();
    $httpCode = $cl->request('GET', 'http://127.0.0.1:8080/about/show');
    self::assertTrue($httpCode === 200);
  }

   // The url syntax is localhost/controller/action/params
  function testAccessContactShow(){
    $cl = new Client();
    $httpCode = $cl->request('GET', 'http://127.0.0.1:8080/contact/show');
    self::assertTrue($httpCode === 200);
  }

  // More tests about Location in the FirewallTest.php file
  // Indeed these pages (location/add, location/remove) invoke the Firewall, therefore they have been placed there.

}


?>






    