<?php

session_start();
require 'db.php';

date_default_timezone_set('Africa/Johannesburg');

//checkIfUserLoggedIn();
$_SESSION["appAddress"] = "http://abcdatabase.online/";
$_SESSION["appAddress"] = "http://abcdatabase.online/";
$GLOBALS["prod"] = false;

	function root(): string{
		return $GLOBALS["prod"] == true ? "http://abcdatabase.online/" : "http://localhost/listenSpeak/";
	}
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

    function gotoDashboard(){
	    if(isset($_SESSION["id"])){
            $_SESSION["loginRequired"] = false;
            if($_SESSION["userType"]=="Student") js_redirect('studentDashboard.php');
            if($_SESSION["userType"]=="Admin") js_redirect('admin/dashboard');
            if($_SESSION["userType"]=="Teacher") js_redirect('teacherDashboard.php');
        }else{
	        $_SESSION["loginRequired"] = true;
            js_redirect("index.php?no");
        }
    }

    function checkIfUserLoggedIn(){
        $uid = getloggedInUserId();
        if(!$uid){
            js_redirect("./");
        }
    }

    function limitString($string, $link = ''): string{
        return (strlen($string) > 100)?substr($string,0,100).'... <a href="'.$link.'">Read More</a>' : $string;
    }

?>