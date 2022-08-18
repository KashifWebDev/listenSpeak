<?php
require 'app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('index.php');
}
if(isset($_POST["save"])){
    $grades = $_POST["grades"];
    $message = $_POST["message"];
    $structure = $_POST["structure"];
    $logic = $_POST["logic"];
    $fluency = $_POST["fluency"];
    $expression = $_POST["expression"];
    $projection = $_POST["projection"];
    $posture = $_POST["posture"];
    $eyeContact = $_POST["eyeContact"];
    $pause = $_POST["pause"];
    $connection = $_POST["connection"];
    $user_id = $_POST["user_id"];
    $activity_id = $_POST["activity_id"];
    $solutionID = $_POST["solutionID"];

    $s = "INSERT INTO grades(user_id, activity_id, percentage, message, structure, logic, fluency, expression, projection, posture, eyeContact, pause, connection)
 VALUES ($user_id, $activity_id, $grades ,'$message', '$structure', '$logic', '$fluency', '$expression', '$projection', '$posture', '$eyeContact', '$pause', '$connection')";
    if(mysqli_query($con, $s)){
        $s = "UPDATE solutions SET graded=1 WHERE id = $solutionID";
        mysqli_query($con, $s);
        js_redirect('teacher_pendingSolutions.php?grade=done');
    }
}
if(!isset($_GET["id"])){
    js_redirect("./");
}
$id = $_GET["id"];
$qry = "SELECT * FROM solutions WHERE id=$id";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "All Activities"; require_once 'app/head.php'; ?>

<body>

  <!-- ======= Header ======= -->
  <?php require_once 'app/top_bar.php'; ?>

  <!-- ======= Sidebar ======= -->
  <?php require_once 'app/side_bar.php'; ?>
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
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Grade Activity</h5>
                        <div class="row my-3">
                            <audio controls src="recordedAudios/<?=$row["audio"]?>"></audio>
                        </div>
                        <form class="row g-3 mt-3" method="post" action="">
                            <input type="hidden" name="solutionID" value="<?=$id?>">
                            <input type="hidden" name="user_id" value="<?=$row["user_id"]?>">
                            <input type="hidden" name="activity_id" value="<?=$row["activity_id"]?>">
                            <div class="d-flex my-3">
                                <label for="inputText" class="col-form-label">Grades Percentage: </label>
                                <div class="ms-3">
                                    <input type="number" class="form-control" min="0" max="100" name="grades" required>
                                </div>
                            </div>
                            <?php
                                $form = array(
                                        array('heading' => 'Message', 'name' => 'message'),
                                        array('heading' => 'Structure', 'name' => 'structure'),
                                        array('heading' => 'Logic', 'name' => 'logic'),
                                        array('heading' => 'Fluency: Use of Language', 'name' => 'fluency'),
                                        array('heading' => 'Expression', 'name' => 'expression'),
                                        array('heading' => 'Projection', 'name' => 'projection'),
                                        array('heading' => 'Posture and Body Language', 'name' => 'posture'),
                                        array('heading' => 'Eye Contact', 'name' => 'eyeContact'),
                                        array('heading' => 'Pause', 'name' => 'pause'),
                                        array('heading' => 'Connection', 'name' => 'connection')
                                );
                                foreach ($form as $filed){
                                    ?>
                                    <div class="row mb-3">
                                        <label class="col-sm-5 col-form-label"><?=$filed["heading"]?></label>
                                        <div class="col-sm-7">
                                            <select class="form-select" required name="<?=$filed["name"]?>">
                                                <option selected="" value>-- SELECT --</option>
                                                <option value="Excellent">Excellent</option>
                                                <option value="Proficient">Proficient</option>
                                                <option value="Needs Attention">Needs Attention</option>
                                            </select>
                                        </div>
                                    </div>
                            <?php
                                }
                            ?>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-50" name="save">
                                    <i class="bi bi-check-circle"></i>
                                    Save Grade
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
  <?php require_once 'app/footer.php'; ?>
  <!-- End Footer -->

</body>

</html>