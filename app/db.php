<?php

if($GLOBALS["prod"]){
    $con = mysqli_connect("localhost","u953547654_lms","Lms@12345","u953547654_lms");
}else{
    $con = mysqli_connect("localhost","root","","abc_lms");
}

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$GLOBALS["con"] = $con;

?>