<?php

session_start();
require 'db.php';
//checkIfUserLoggedIn();

session_start();
$_SESSION["appAddress"] = "http://abcdatabase.online/";

//error_reporting(0);

	function js_alert($msg){
		echo '
			<script>alert("'.$msg.'");</script>;
		';
	}

	function js_console_log($msg){
		echo '
			<script>console.log("'.$msg.'");</script>;
		';
	}

	function js_redirect($url){
		echo '
			<script>window.location.replace("'.$url.'");</script>
		';
//		header('Location: '.$url);
	}



    function getloggedInUserId(){
	    return isset($_SESSION["id"]) ? $_SESSION["id"] : null;
    }

    function checkIfUserLoggedIn(){
        $uid = getloggedInUserId();
        if(!$uid){
            js_redirect("./");
        }
    }
?>