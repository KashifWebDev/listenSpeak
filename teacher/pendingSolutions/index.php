<?php
require '../../app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('../../index.php');
}
function fetchCount($table, $column = null, $data = null): int{
    $s = (isset($column) && isset($data)) ?  "SELECT * FROM $table WHERE $column='$data'" : "SELECT * FROM $table";
    $res = mysqli_query($GLOBALS["con"], $s);
    return mysqli_num_rows($res);
}
function dateTime($dateString){
    $dateTime = new DateTime($dateString);
    return $dateTime->format('F j, Y \a\t g:i A');
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "Teacher Dashboard"; $path = '../../'; require_once '../../app/head.php'; ?>
<body>

<!-- ======= Header ======= -->
<?php require_once '../../app/top_bar.php'; ?>

<!-- ======= Sidebar ======= -->
<?php require_once '../../app/teacher_side_bar.php'; ?>
<!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <?php
                if(isset($_GET["grade"])){
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        Grades were saved successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }?>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Students</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Activity Name</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Submitted Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $uid = $_SESSION["id"];
                            $s = "SELECT DISTINCT audio_responses.response_id, audio_responses.date_time, units.unit_name, users.fullName AS student_name, teachers.fullName AS teacher_name, audio_responses.audio_url, audio_responses.status
                                    FROM audio_responses
                                    JOIN units ON audio_responses.unit_id = units.unit_id
                                    JOIN users ON audio_responses.student_id = users.user_id AND users.user_type = 'Student'
                                    JOIN teacher_courses ON audio_responses.teacher_id = teacher_courses.teacher_id
                                    JOIN users AS teachers ON teacher_courses.teacher_id = teachers.user_id
                                    WHERE audio_responses.teacher_id = $uid";
                            $res = mysqli_query($GLOBALS['con'], $s);
                            if(mysqli_num_rows($res)){
                                $count = 1;
                                while ($row = mysqli_fetch_array($res)){
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$count++?></th>
                                        <td><?=$row['unit_name']?></td>
                                        <td><?=$row['student_name']?></td>
                                        <td><?=dateTime($row["date_time"])?></td>
                                        <td>
                                            <a href="../marking/index.php?id=<?=$row["response_id"]?>" class="btn btn-primary rounded-pill">
                                                <i class="bi bi-pen-fill me-1"></i>
                                                Grade
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                } }
                            ?>
                            </tbody>
                        </table>
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