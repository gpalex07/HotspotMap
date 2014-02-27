<?php

/*  Look up the informations of a location, given its id
*/

if(isset($_GET['id']))
{
  $id = $_GET['id'];

  $mysqli = new mysqli("localhost", "root", "", "HotspotMap");

  /* check connection */
  if ($mysqli->connect_errno) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
  }

  /* Select queries return a resultset */
  if ($result = $mysqli->query("SELECT * FROM `locations` WHERE id=" . $id)) {
    // No result
    if($result->num_rows == 0)
    {
      $data = array( "name" => "Location not found for id='".$id."'.");
    } else {
      $data = $result->fetch_array(MYSQLI_ASSOC);
      $data["rating"] = intval($data["rating"]);
    }

    /* free the result set */
    $result->close();
  }

  $mysqli->close();

} else { $data = array( "name" => "Location's id not specified."); }





$USER_IS_ADMIN = true;

?>