<?php


require_once("/controller/LocationController.php");
use Symfony\Component\DomCrawler\Crawler;


class LocationControllerTest extends PHPUnit_Framework_TestCase
{
    public function testLocationShowMissingId(){
       $loc = new LocationController();
       $loc->show();
    }
}

?>