<?php
require '../../app/app.php';
//if(!isset($_SESSION["id"])){
//    js_redirect('index.php');
//}
$output = array(
    'status' => false
);
header('Content-Type: application/json');
?>




<?php
//print_r($_POST); exit(); die();

    $unitType = !empty($_POST["unitType"]) ? $_POST["unitType"] : null;
    $link = !empty($_POST["link"]) ? $_POST["link"] : null;
    $unitName = !empty($_POST["unitName"]) ? $_POST["unitName"] : null;
    $course = !empty($_POST["course"]) ? $_POST["course"] : null;
    $subject = !empty($_POST["subject"]) ? $_POST["subject"] : null;
    $content = !empty($_POST["desc"]) ? $_POST["desc"] : null;
    $picture = null;

    if(!empty($_FILES['attachment']['name'])){
        $banner=$_FILES['attachment']['name'];
        $expbanner=explode('.',$banner);
        $bannerexptype=$expbanner[1];
        $date = date('m/d/Yh:i:sa', time());
        $rand=rand(10000,99999);
        $encname=$date.$rand;
        $picture=md5($encname).'.'.$bannerexptype;
        $bannerpath="../../assets/img/units/".$picture;
        move_uploaded_file($_FILES["attachment"]["tmp_name"],$bannerpath);
    }


    define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/listenSpeak/');
    $fileName = basename( $_FILES['fileName']['name']);
    $fileName = md5(date('h:i:s').rand()).'.mp3';
    $_SESSION["fileName"] = $fileName;
    $target_path = UPLOAD_DIR.'recordedAudios/' . $fileName;
    if(move_uploaded_file($_FILES['fileName']['tmp_name'], $target_path)) {
        // echo "The file ". basename( $_FILES['fileName']['name']). " has been uploaded";


//        $response_id = $_SESSION["response_id"];
//        $status = $_POST["status"];
//        $percentage = $_POST["percentage"];
        $audio = $_SESSION["fileName"];

        $sql = "INSERT INTO units(unit_name, subject_id, content,file, type, link, audio) 
            VALUES ('$unitName', $subject, '$content', '$picture', '$unitType', '$link', '$audio')";
//        mysqli_query($GLOBALS['con'], $s);
        if(mysqli_query($GLOBALS['con'], $sql)){
            $output['status'] = true;
        }else{
            echo "There was an error running qry!";
            $output['status'] = false;
        }
    } else{
        echo "There was an error uploading the file, please try again!";
        $output['status'] = false;
    }
$jsonResponse = json_encode($output);
echo $jsonResponse;
?>
