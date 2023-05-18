<?php
require '../../app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('../../index.php');
}

$unit = null;
if(isset($_GET['unit'])){
    $unit = $_GET['unit'];
    $s = "SELECT * FROM units where unit_id=$unit";
    $res = mysqli_query($GLOBALS["con"], $s);
    if(mysqli_num_rows($res)){
        $unitRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    }else{
        js_alert('Unit ID not found!');
        die();
    }
}

if(isset($_POST["addUnit"])){
    $unitType = !empty($_POST["unitType"]) ? $_POST["unitType"] : null;
    $link = !empty($_POST["link"]) ? $_POST["link"] : null;
    $unitName = !empty($_POST["unitName"]) ? $_POST["unitName"] : null;
    $course = !empty($_POST["course"]) ? $_POST["course"] : null;
    $subject = !empty($_POST["subject"]) ? $_POST["subject"] : null;
    $content = !empty($_POST["content"]) ? $_POST["content"] : null;

    if($unitType == 'Assessment'){
        $sql = "UPDATE units 
        SET unit_name = '$unitName', link = '$link' WHERE unit_id = $unit";
    }
    if($unitType == 'Unit'){
        $sql = "UPDATE units 
        SET unit_name = '$unitName', content = '$content' WHERE unit_id = $unit";
    }
    $res = mysqli_query($GLOBALS["con"],$sql);
    if($res){
        js_alert('Unit Updated Successfully');
        js_redirect("manage_units.php?success=1");
    }
}

function getSubjectName($id): string{
    $s = "SELECT unit_name FROM units WHERE unit_id = $id";
    $res = mysqli_query($GLOBALS["con"], $s);
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    return $row["unit_name"];
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "Edit  Unit"; $path = '../../'; require_once '../../app/head.php'; ?>
<body>

<!-- ======= Header ======= -->
<?php require_once '../../app/top_bar.php'; ?>

<!-- ======= Sidebar ======= -->
<?php require_once '../../app/admin_side_bar.php'; ?>
<!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit unit details</h5>
                        <form method="post" action="" enctype="multipart/form-data">
                            <input type="hidden" name="unitType" value="<?=$unitRow['type']?>">
                            <div id="mustHave">
                                <div class="form-group mb-3">
                                    <label for="unitName">Unit Name</label>
                                    <input type="text" class="form-control" id="unitName" name="unitName" placeholder="Enter unit name" value="<?=$unitRow['unit_name']?>" required>
                                </div>
                                <div class="form-group mb-3" id="subjectDiv" style="display: none;">
                                    <label for="subject">Subject</label>
                                    <select class="form-control" id="subject" name="subject" required disabled>
                                        <option value="<?=$unitRow['subject_id']?>" selected><?=getSubjectName($unitRow['subject_id'])?><</option>
                                    </select>
                                </div>
                            </div>
                            <?php if($unitRow['type']=='Unit'){ ?>
                            <div id="unitFields">
                                <div class="form-group mb-3">
                                    <label for="description">Content</label>
                                    <textarea name="content" class="form-control" placeholder="Unit Content" id="floatingTextarea" style="height: 100px;"><?=$unitRow['content']?></textarea>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if($unitRow['type']=='Assessment'){ ?>
                            <div id="assessmentFields">
                                <div class="form-group mb-3">
                                    <label for="link">Assessment Link</label>
                                    <input type="text" class="form-control" id="link" value="<?=$unitRow['link']?>" name="link" placeholder="https://abcinternationalonline.com/.......">
                                </div>
                            </div>
                            <?php } ?>
                            <div class="row mb-3">
                                <div class="col-12 justify-content-center d-flex">
                                    <button type="submit" class="btn btn-primary" name="addUnit">
                                        <i class="bi bi-pencil-fill"></i>
                                        Edit Unit
                                    </button>
                                </div>
                            </div>
                        </form>
                        <script>

                            window.onload = function () {
                                toggleFormFields();
                            }
                            document.addEventListener('DOMContentLoaded', function() {
                                toggleFormFields();
                            });


                        </script>



                        <script>

                            function fetchSubjects() {
                                var courseID = document.getElementById("course").value;

                                if (courseID !== "") {
                                    var xhr = new XMLHttpRequest();
                                    xhr.onreadystatechange = function() {
                                        if (xhr.readyState === XMLHttpRequest.DONE) {
                                            if (xhr.status === 200) {
                                                // Update the subject dropdown with the fetched subjects
                                                document.getElementById("subjectDiv").style.display = "block";
                                                document.getElementById("subject").innerHTML = xhr.responseText;
                                            } else {
                                                console.error("Error: " + xhr.status);
                                            }
                                        }
                                    };

                                    // Send the AJAX request to fetch subjects for the selected course
                                    xhr.open("GET", "<?=root().'/app'?>/__api_fetch_subjects.php?courseID=" + courseID, true);
                                    xhr.send();
                                } else {
                                    // Hide the subject dropdown if no course is selected
                                    document.getElementById("subjectDiv").style.display = "none";
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php require_once '../../app/footer.php'; ?>
<!-- End Footer -->

</body>

</html>