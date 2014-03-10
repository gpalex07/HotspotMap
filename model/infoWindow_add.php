<?php

/*  Look up the informations of a location, given its id
*/

//$MARKER_ADDED_CONFIRMED = "2"; // The server's response to confirm that a marker has been deleted (is the id of the new marker)
$MARKER_ADDED_FAILED    = "-1";

if(isset($_POST["name"]))
{
  $name="test";
  $free_connection=0;
  $free_coffee=9;
  $rating=-1;
  $lat="";
  $long="";

  if(isset($_POST['name']))             $name=mysql_real_escape_string($_POST['name']);
  if(isset($_POST['free_connection']))  $free_connection=$_POST['free_connection'];
  if(isset($_POST['free_coffee']))      $free_coffee=$_POST['free_coffee'];
  if(isset($_POST['rating']))           $rating=$_POST['rating'];
  if(isset($_POST['lat']))              $lat=$_POST['lat'];
  if(isset($_POST['long']))             $long=$_POST['long'];


  $mysqli = new mysqli("localhost", "isima", "isima", "hotspotmap");

  /* check connection */
  if ($mysqli->connect_errno) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
  }

  /* Select queries return a resultset */
  if ($result = $mysqli->query("INSERT INTO `hotspotmap`.`locations` (`id`, `name`, `free_connection`, `free_coffee`, `rating`, `lat`, `lng`) VALUES (NULL, '$name', '$free_connection', '$free_coffee', '$rating', '$lat', '$long')")){
  //if ($result = $mysqli->query("INSERT INTO `locations` (`id`, `name`, `free_connection`, `free_coffee`, `rating`, `lat`, `long`) VALUES (NULL, " . $name . ", " . $free_connection . ", " . $free_coffee . ", " . $rating . ", " . $lat . ", " . $long . ")")) {
    
    echo $mysqli->insert_id; // MARKER_ADDED_CONFIRMED

  } else echo $MARKER_ADDED_FAILED;

  // No result
  /*if(!$result)
    echo $MARKER_ADDED_CONFIRMED;
  else 
    echo $MARKER_ADDED_CONFIRMED;*/

  $mysqli->close();

} else { 
  //echo 'No data recieved about the location ($_POST[name] is empty)';
  echo $MARKER_ADDED_FAILED;
}
?>