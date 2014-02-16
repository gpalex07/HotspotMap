<?php

$MARKER_DELETION_CONFIRMED = "MARKER_DELETION_CONFIRMED"; // The server's response to confirm that a marker has been deleted
$MARKER_DELETION_FAILED    = "MARKER_DELETION_FAILED";




$response=$MARKER_DELETION_FAILED; 

if(isset($_GET['id'])) $response=$MARKER_DELETION_CONFIRMED; 


echo $response;

?>