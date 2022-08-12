<?php

session_start();
require 'db.php';
//checkIfUserLoggedIn();
$_SESSION["appAddress"] = "http://abcdatabase.online/";

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
	}

    function getloggedInUserId(){
	    return isset($_SESSION["id"]) ? $_SESSION["id"] : null;
    }

    function gotoDashboard(){
	    if(isset($_SESSION["id"])){
            $_SESSION["loginRequired"] = false;
            if($_SESSION["userType"]=="Student") js_redirect('studentDashboard.php');
            if($_SESSION["userType"]=="Admin") js_redirect('adminDashboard.php');
            if($_SESSION["userType"]=="Teacher") js_redirect('teacherDashboard.php');
        }else{
	        $_SESSION["loginRequired"] = true;
            js_redirect("index.php");
        }
    }

    function checkIfUserLoggedIn(){
        $uid = getloggedInUserId();
        if(!$uid){
            js_redirect("./");
        }
    }
?>