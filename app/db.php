<?php

//$con = mysqli_connect("localhost","j18jocnn_18joris","CPvvGapgy)Oy","j18jocnn_listenSpeak");

$con = mysqli_connect("localhost","abcdaevx_abc","3}t{Zt?x.Y3)","abcdaevx_abcDatabase");
//$con = mysqli_connect("localhost","root","","projects_listenSpeak");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$GLOBALS["con"] = $con;

?>