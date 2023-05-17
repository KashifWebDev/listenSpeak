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

<?php $title = "Assign Instructors"; $path = '../../'; require_once '../../app/head.php'; ?>
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
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Assign courses to instructors</h5>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Course</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" name="course_id" required>
                                        <option selected value>Select Course</option>
                                        <?php
                                        $s = "SELECT * FROM courses";
                                        $res = mysqli_query($GLOBALS["con"], $s);
                                            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                                ?>
                                                <option value="<?=$row["course_id"]?>"><?=$row["course_name"]?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Instructor</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" name="instructor_id" required>
                                        <option selected value>Select Instructor</option>
                                        <?php
                                        $s = "SELECT * FROM users WHERE user_type='Teacher'";
                                        $res = mysqli_query($GLOBALS["con"], $s);
                                        while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                            ?>
                                            <option value="<?=$row["user_id"]?>"><?=$row["fullName"]?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="assign">
                                    <i class="bi bi-link me-2"></i>
                                    Assign Course
                                </button>
                            </div>
                        </form>

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