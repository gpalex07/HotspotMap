<?php

$MARKER_ADDED_CONFIRMED = "2"; // The server's response to confirm that a marker has been deleted (is the id of the new marker)
$MARKER_ADDED_FAILED    = "-1";




$response=$MARKER_ADDED_FAILED; 

if(isset($_GET['lat'])) $response=$MARKER_ADDED_CONFIRMED;


echo $response;

?>