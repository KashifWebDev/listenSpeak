<?php
require '../../app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('../../index.php');
}

if(isset($_POST["assign"])){
    $instructor_id = $_POST["instructor_id"] ?? null;
    $course_id = $_POST["course_id"] ?? null;

    $sql = "INSERT INTO teacher_courses(teacher_id, course_id) VALUES ($instructor_id, $course_id)";
    echo $sql;
    $res = mysqli_query($GLOBALS["con"],$sql);
    if($res){
        js_redirect("assign_instructors.php?success=1");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "Manage Subjects"; $path = '../../'; require_once '../../app/head.php'; ?>
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
            <div class="col-lg-12">
                <?php
                if(isset($_GET["success"])){
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        Course was linked successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                ?>
                <?php
                if(isset($_GET["error"])){
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        Please select the required fields.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                ?>

                <?php
                $query = "SELECT courses.course_id, courses.course_name, subjects.subject_id, subjects.subject_name, units.unit_id, units.unit_name
          FROM courses
          LEFT JOIN subjects ON courses.course_id = subjects.course_id
          LEFT JOIN units ON subjects.subject_id = units.subject_id
          ORDER BY courses.course_id, subjects.subject_id";

                $result = mysqli_query($GLOBALS["con"], $query);

                if ($result->num_rows > 0) {
                    $courses = array();

                    // Fetching the data
                    while ($row = $result->fetch_assoc()) {
                        $courseId = $row['course_id'];
                        $courseName = $row['course_name'];
                        $subjectId = $row['subject_id'];
                        $subjectName = $row['subject_name'];
                        $unitId = $row['unit_id'];
                        $unitName = $row['unit_name'];

                        // Creating a nested array for each course
                        if (!isset($courses[$courseId])) {
                            $courses[$courseId] = array(
                                'course_name' => $courseName,
                                'subjects' => array(),
                            );
                        }

                        // Adding subjects to the respective course
                        if ($subjectId !== null) {
                            // Creating a nested array for each subject
                            if (!isset($courses[$courseId]['subjects'][$subjectId])) {
                                $courses[$courseId]['subjects'][$subjectId] = array(
                                    'subject_name' => $subjectName,
                                    'units' => array(),
                                );
                            }

                            // Adding units to the respective subject
                            if ($unitId !== null && $unitName !== 'ListUnitsHere') {
                                $courses[$courseId]['subjects'][$subjectId]['units'][$unitId] = $unitName;
                            }
                        }
                    }

                    echo '<div class="row">';
                    foreach ($courses as $courseId => $course) {
                        ?>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $course['course_name'] ?></h5>
                                    <?php
                                    if (count($course['subjects']) === 0) {
                                        echo '<p>No subjects found for this course.</p>';
                                    } else {
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="accordion" id="accordion-<?= $courseId ?>">
                                                    <?php
                                                    foreach ($course['subjects'] as $subjectId => $subject) {
                                                        ?>
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="heading-<?= $subjectId ?>">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapse-<?= $subjectId ?>" aria-expanded="false"
                                                                        aria-controls="collapse-<?= $subjectId ?>">
                                                                    <b><?= $subject['subject_name'] ?></b>
                                                                    <span class="badge bg-primary rounded-pill ms-2"><?=count($subject['units'])?> units</span>
                                                                </button>
                                                            </h2>
                                                            <div id="collapse-<?= $subjectId ?>" class="accordion-collapse collapse"
                                                                 aria-labelledby="heading-<?= $subjectId ?>" data-bs-parent="#accordion-<?= $courseId ?>">
                                                                <div class="accordion-body">
                                                                    <?php
                                                                    if(count($subject['units']) == 0){
                                                                        echo 'No units found for this Subject';
                                                                    }else{
                                                                        foreach ($subject['units'] as $unitId => $unitName) {
                                                                            ?>
                                                                            <ol class="list-group">
                                                                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                                    <div class="ms-2 me-auto">
                                                                                        <div class="fw-bold"><?= $unitName ?></div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#edit_modal_3">
                                                                                            <i class="bi bi-pencil-fill"></i>
                                                                                        </button>
                                                                                        <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#edit_modal_3">
                                                                                            <i class="bi bi-trash-fill"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </li>
                                                                            </ol>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    echo '</div>';
                } else {
                    echo "No courses found.";
                }
                ?>



            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php require_once '../../app/footer.php'; ?>
<!-- End Footer -->

</body>

</html>