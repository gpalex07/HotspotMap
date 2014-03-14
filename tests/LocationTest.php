<?php

require_once("../../model/Location.php");


class FirewallTest extends PHPUnit_Framework_TestCase {

  protected static $errorCode;
  protected static $name;
  protected static $schedule;
  protected static $free_connection;
  protected static $free_coffee;
  protected static $rating;
  protected static $lat;
  protected static $lng;
  protected static $res;

  public static function setUpBeforeClass(){
        self::$name             = "Test location + " . time();
        self::$errorCode        = -1;
        self::$schedule         = '480;1380/480;1380/480;1380/480;1380/480;1380/480;1380/660;1260';
        self::$free_connection  = 1;
        self::$free_coffee      = 1;
        self::$rating           = 3;
        self::$lat              = 0.33;
        self::$lng              = 0.33;
  }

  // Add a new location
  function testAddLocation(){
    // The Location's constructor calls session_star() which we don't want to call since it would not succeed because phpunit would send the header before session_start would get called.
    // By using this mock, we make sure that the constructor is not called.
    $mock = $this->getMockBuilder('Location')
    ->setMethods(array('__constructor'))
    ->disableOriginalConstructor()
    ->getMock();

    self::$res = $mock->addLocation(self::$errorCode, self::$name, self::$schedule, self::$free_connection, self::$free_coffee, self::$rating, self::$lat, self::$lng);

    self::assertTrue(self::$res !== self::$errorCode); // If true, the request did not fail.
        
    self::assertTrue(self::$res >= 0); // If true, $res contains the id of the new row inserted.
    
  }


  // Check that the new location has indeed been added.
  function testLocationHasBeenAdded(){

    // The Location's constructor calls session_star() which we don't want to call since it would not succeed because phpunit would send the header before session_start would get called.
    // By using this mock, we make sure that the constructor is not called.
    $mock = $this->getMockBuilder('Location')
    ->setMethods(array('__constructor'))
    ->disableOriginalConstructor()
    ->getMock();

    self::assertTrue($mock->getLocationById(self::$res)['found']);
    self::assertTrue($mock->getLocationById(self::$res)['name']            === self::$name);
    self::assertTrue($mock->getLocationById(self::$res)['freeConnection']  ==  self::$free_connection);
    self::assertTrue($mock->getLocationById(self::$res)['freeCoffee']      ==  self::$free_coffee);
    self::assertTrue($mock->getLocationById(self::$res)['rating']          ==  self::$rating);

  }

  // Remove the new location
  function testRemoveLocation(){

    // The Location's constructor calls session_star() which we don't want to call since it would not succeed because phpunit would send the header before session_start would get called.
    // By using this mock, we make sure that the constructor is not called.
    $mock = $this->getMockBuilder('Location')
    ->setMethods(array('__constructor'))
    ->disableOriginalConstructor()
    ->getMock();

    self::assertTrue($mock->removeLocation(self::$res)); // Returns true if success.

  }

  // Check that the location has indeed been deleted
  function testLocationHasBeenRemoved(){

    // The Location's constructor calls session_star() which we don't want to call since it would not succeed because phpunit would send the header before session_start would get called.
    // By using this mock, we make sure that the constructor is not called.
    $mock = $this->getMockBuilder('Location')
    ->setMethods(array('__constructor'))
    ->disableOriginalConstructor()
    ->getMock();

    self::assertTrue($mock->getLocationById(self::$res)['found'] === false);
    
  }

}


?>






    