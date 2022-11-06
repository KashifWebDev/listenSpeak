<?php
require 'app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('index.php');
}
?>
<?php
define('UPLOAD_DIR', './');
if(isset($_FILES['fileName']) && $_FILES['fileName']){
    $fileName = basename( $_FILES['fileName']['name']);
    $fileName = md5(date('h:i:s').rand()).'.mp3';
    $_SESSION["fileName"] = $fileName;
    $target_path = UPLOAD_DIR.'recordedAudios/' . $fileName;
	
    if(move_uploaded_file($_FILES['fileName']['tmp_name'], $target_path)) {
       // echo "The file ". basename( $_FILES['fileName']['name']). " has been uploaded";
		    $uid = $_SESSION["id"];
    $activity = $_GET["activity"];
    $audio = $fileName;
    $created_date = date("Y-m-d H:i:s");
    echo $s = "INSERT INTO solutions (user_id, activity_id, audio, date_time) VALUES ($uid, $activity, '$audio', '$created_date')";
    if(mysqli_query($con, $s)){
        js_redirect('student_allActivities.php?uploaded=1');
		//header("Location: student_allActivities.php?uploaded=1");
    }
    } else{
        echo "There was an error uploading the file, please try again!";
    }
}
?>
