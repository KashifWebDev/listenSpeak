<?php
require '../../app/app.php';
//if(!isset($_SESSION["id"])){
//    js_redirect('index.php');
//}
?>
<?php
if(isset($_FILES['fileName']) && $_FILES['fileName'] && isset($_POST["status"]) && isset($_POST["percentage"])){
    define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/listenSpeak/');
    $fileName = basename( $_FILES['fileName']['name']);
    $fileName = md5(date('h:i:s').rand()).'.mp3';
    $_SESSION["fileName"] = $fileName;
//    $target_path = root().'recordedAudios/' . $fileName;
    $target_path = UPLOAD_DIR.'recordedAudios/' . $fileName;

    if(move_uploaded_file($_FILES['fileName']['tmp_name'], $target_path)) {
        // echo "The file ". basename( $_FILES['fileName']['name']). " has been uploaded";


        $response_id = $_SESSION["response_id"];
        $status = $_POST["status"];
        $percentage = $_POST["percentage"];
        $audio = $_SESSION["fileName"];

        $s = "UPDATE audio_responses SET status='$status', percentage ='$percentage',
            teacher_audio='$audio' WHERE response_id = $response_id";
        mysqli_query($GLOBALS['con'], $s);

        if(mysqli_query($GLOBALS['con'], $s)){
            js_redirect('../teacher/pendingSolutions?done=1');
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
