<?php

$url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$url .= "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if ($_SERVER['HTTP_HOST'] === 'localhost' || substr($_SERVER['HTTP_HOST'], 0, 9) === '127.0.0.1') {
    $GLOBALS["prod"] = false;
} else {
    $GLOBALS["prod"] = true;
}

$host = $_ENV['host'];
$user = $_ENV['user'];
$pass = $_ENV['pass'];
$db = $_ENV['db'];

//if($GLOBALS["prod"]){
//    $con = mysqli_connect("localhost","u953547654_lms","Lms@12345","u953547654_lms");
//}else{
//    $con = mysqli_connect("localhost","root","","abc_lms");
//}
$con = mysqli_connect("localhost",$user,$pass,$db);

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$GLOBALS["con"] = $con;

?>