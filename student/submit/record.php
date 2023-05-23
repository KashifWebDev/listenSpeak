<?php
require '../../app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('index.php');
}
print_r($_POST);
?>
<?php
if(isset($_FILES['fileName']) && $_FILES['fileName']){
    define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/listenSpeak/');
    $fileName = basename( $_FILES['fileName']['name']);
    $fileName = md5(date('h:i:s').rand()).'.mp3';
    $_SESSION["fileName"] = $fileName;
//    $target_path = root().'recordedAudios/' . $fileName;
    $target_path = UPLOAD_DIR.'recordedAudios/' . $fileName;
    echo $target_path;

    if(move_uploaded_file($_FILES['fileName']['tmp_name'], $target_path)) {
        // echo "The file ". basename( $_FILES['fileName']['name']). " has been uploaded";


        $uid = $_SESSION["id"];
        $activity = $_SESSION["unit_id"];
        $audio = $_SESSION["fileName"];
        $created_date = date("Y-m-d H:i:s");

        $s = "INSERT INTO student_units (student_id, unit_id) VALUES 
                   ($uid, $activity)";
        mysqli_query($GLOBALS['con'], $s);

        $s = "INSERT INTO audio_responses (student_id, unit_id, audio_url, date_time) VALUES 
                   ($uid, $activity, '$audio', '$created_date')";
        echo $s;
        if(mysqli_query($GLOBALS['con'], $s)){
            js_redirect('../progress/index.php?uploaded=1');
        }else{
            echo "There was an error running qry!";
            die(); exit();
        }
    } else{
        echo "There was an error uploading the file, please try again!";
        die(); exit();
    }
}
?>
