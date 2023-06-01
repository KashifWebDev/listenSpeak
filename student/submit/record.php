<?php
// Create an associative array to represent your data
$output = array(
    'status' => false
);
header('Content-Type: application/json');

require '../../app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('index.php');
}
?>
<?php
if(isset($_FILES['fileName']) && $_FILES['fileName']){
    define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/listenSpeak/');
    $fileName = basename( $_FILES['fileName']['name']);
    $fileName = md5(date('h:i:s').rand()).'.mp3';
    $_SESSION["fileName"] = $fileName;
//    $target_path = root().'recordedAudios/' . $fileName;
    $target_path = UPLOAD_DIR.'recordedAudios/' . $fileName;

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

        if(mysqli_query($GLOBALS['con'], $s)){
            $output['status'] = true;
        }else{
            echo "There was an error running qry!";
            $output['status'] = false;
        }
    } else{
        echo "There was an error uploading the file, please try again!";
        $output['status'] = false;
    }
}
$jsonResponse = json_encode($output);
echo $jsonResponse;
?>
