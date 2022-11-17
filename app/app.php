<?php

session_start();
require 'db.php';

date_default_timezone_set('Africa/Johannesburg');

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

    function whatsapp($number){

    $curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://graph.facebook.com/v15.0/103515472578637/messages',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '{ "messaging_product": "whatsapp", "to": "'.$number.'", "type": "template", "template": { "name": "lesson", "language": { "code": "en" }, "components": [
    {
        "type": "body",
        "parameters": [
            {
                "type": "text",
                "text": "Count 1 to 5"
            }
        ]
    }
] } }',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer EAAHn30tXZB5ABAIlyL75ZA285n000rw63Q1gZC8HI7HerEOMcr4cteYjtfPh5LYyCo9XZAVzZC9ZAdLiouwmt9iOgxni044d95vK9aUav7nsKA7UJmLzDsiCEGX4KhWy88zlbZBi0wW3Uq6Cz5wpuAz6ZABdSFwpIcFTa798KJmGBLiHlBDS9oGgSIHELcCQwUPrThAZCe6PGigZDZD',
        'Content-Type: application/json'
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

}
?>