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
    $fileName = time().'.mp3';
    $_SESSION["fileName"] = $fileName;
    $target_path = UPLOAD_DIR.'recordedAudios/' . $fileName;
    if(move_uploaded_file($_FILES['fileName']['tmp_name'], $target_path)) {
        echo "The file ". basename( $_FILES['fileName']['name']). " has been uploaded";
    } else{
        echo "There was an error uploading the file, please try again!";
    }
}
?>