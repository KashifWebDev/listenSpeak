<?php
require '../../app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('../../index.php');
}

if(isset($_POST["addUnit"])){
    $unitType = !empty($_POST["unitType"]) ? $_POST["unitType"] : null;
    $link = !empty($_POST["link"]) ? $_POST["link"] : null;
    $unitName = !empty($_POST["unitName"]) ? $_POST["unitName"] : null;
    $course = !empty($_POST["course"]) ? $_POST["course"] : null;
    $subject = !empty($_POST["subject"]) ? $_POST["subject"] : null;
    $content = !empty($_POST["content"]) ? $_POST["content"] : null;
    $picture = null;

    if(!empty($_FILES['image']['name'])){
        $banner=$_FILES['image']['name'];
        $expbanner=explode('.',$banner);
        $bannerexptype=$expbanner[1];
        $date = date('m/d/Yh:i:sa', time());
        $rand=rand(10000,99999);
        $encname=$date.$rand;
        $picture=md5($encname).'.'.$bannerexptype;
        $bannerpath="../../assets/img/units/".$picture;
        move_uploaded_file($_FILES["image"]["tmp_name"],$bannerpath);
    }

    $sql = "INSERT INTO units(unit_name, subject_id, content,file, type, link) 
            VALUES ('$unitName', $subject, '$content', '$picture', '$unitType', '$link')";
    $res = mysqli_query($GLOBALS["con"],$sql);
    if($res){
        js_redirect("add_unit.php?success=1");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "Add New Unit"; $path = '../../'; require_once '../../app/head.php'; ?>
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
                <?php
                if(isset($_GET["success"])){
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        Unit was added successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Introduce new Unit</h5>
                        <?php
                        if (isset($_GET['course'])) {
                            $course = $_GET['course'];

                            // Fetch subjects based on the selected course
                            $subjects = fetchSubjects($course);

                            // Return the subjects as JSON response
                            echo json_encode($subjects);
                        }

                        // Function to fetch subjects based on the selected course
                        function fetchSubjects($course) {
                            global $connection;
                            $subjects = [];

                            // Fetch subjects from the database based on the selected course
                            $query = "SELECT subject_id, subject_name FROM subjects WHERE course_id = (SELECT course_id FROM courses WHERE course_name = '$course')";
                            $result = mysqli_query($connection, $query);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $subjects[$row['subject_id']] = $row['subject_name'];
                                }
                            }

                            return $subjects;
                        }


                        // Fetch courses from the database
                        $courses = [];
                        $query = "SELECT course_name FROM courses";
                        $result = mysqli_query($GLOBALS["con"], $query);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $courses[] = $row['course_name'];
                            }
                        }

                        // Function to fetch subjects based on the selected course

                        // Fetch subjects from the database
                        $subjects = [];
                        $query = "SELECT subject_name FROM subjects";
                        $result = mysqli_query($GLOBALS["con"], $query);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $subjects[] = $row['subject_name'];
                            }
                        }

                        function fetchCourses() {
                            $courses = [];

                            // Fetch courses from the database
                            $query = "SELECT course_id, course_name FROM courses";
                            $result = mysqli_query($GLOBALS["con"], $query);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $courses[$row['course_id']] = $row['course_name'];
                                }
                            }

                            return $courses;
                        }
                        $courses = fetchCourses();


                        ?>
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="unitType">Lesson Type</label>
                                <select class="form-control" id="unitType" name="unitType" onchange="toggleFormFields()" required>
                                    <option>Select Lesson Type</option>
                                    <option value="Unit">Unit</option>
                                    <option value="Assessment">Assessment</option>
                                </select>
                            </div>
                            <div id="mustHave" style="display: none">
                                <div class="form-group mb-3">
                                    <label for="unitName">Unit Name</label>
                                    <input type="text" class="form-control" id="unitName" name="unitName" placeholder="Enter unit name" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="course">Course</label>
                                    <select class="form-control" id="course" name="course" onchange="fetchSubjects()" required>
                                        <option value="">Select a course</option>
                                        <?php
                                        // Fetch courses from the database
                                        $courseQuery = "SELECT * FROM courses";
                                        $courseResult = mysqli_query($GLOBALS['con'], $courseQuery);

                                        // Loop through the courses and generate options
                                        while ($courseRow = mysqli_fetch_assoc($courseResult)) {
                                            echo '<option value="' . $courseRow['course_id'] . '">' . $courseRow['course_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3" id="subjectDiv" style="display: none;">
                                    <label for="subject">Subject</label>
                                    <select class="form-control" id="subject" name="subject" required>
                                        <option value="">Select a subject</option>
                                    </select>
                                </div>
                            </div>
                            <div id="unitFields" style="display: none;">
                                <div class="form-group mb-3">
                                    <label for="description">Content</label>
                                    <textarea name="content" class="form-control" placeholder="Unit Content" id="floatingTextarea" style="height: 100px;"></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Additional Resources</label>
                                    <input class="form-control" type="file" id="formFile" name="image">
                                </div>
                            </div>
                            <div id="assessmentFields" style="display: none;">
                                <div class="form-group mb-3">
                                    <label for="link">Assessment Link</label>
                                    <input type="text" class="form-control" id="link" name="link" placeholder="https://abcinternationalonline.com/.......">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 justify-content-center d-flex">
                                    <button type="submit" class="btn btn-primary" name="addUnit">
                                        <i class="bi bi-plus"></i>
                                        Add Unit
                                    </button>
                                </div>
                            </div>
                        </form>



                        <script>
                            function toggleFormFields() {
                                var unitType = document.getElementById("unitType").value;
                                var unitFields = document.getElementById("unitFields");
                                var assessmentFields = document.getElementById("assessmentFields");
                                var mustHave = document.getElementById("mustHave");

                                mustHave.style.display = "block";

                                if (unitType === "Unit") {
                                    unitFields.style.display = "block";
                                    assessmentFields.style.display = "none";
                                } else if (unitType === "Assessment") {
                                    unitFields.style.display = "none";
                                    assessmentFields.style.display = "block";
                                } else {
                                    unitFields.style.display = "none";
                                    assessmentFields.style.display = "none";
                                }
                            }

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