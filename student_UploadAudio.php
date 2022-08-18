<?php
require 'app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('index.php');
}
if(isset($_GET["upload"])){
    $uid = $_SESSION["id"];
    $activity = $_GET["activity"];
    $audio = $_SESSION["fileName"];
    $created_date = date("Y-m-d H:i:s");
    $s = "INSERT INTO solutions (user_id, activity_id, audio, date_time) VALUES ($uid, $activity, '$audio', '$created_date')";
    if(mysqli_query($con, $s)){
        js_redirect('student_allActivities.php?uploaded=1');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "All Activities"; require_once 'app/head.php'; ?>

<script>
    alert("Click on the button to start recording your answer!");
</script>
<body>

  <!-- ======= Header ======= -->
  <?php require_once 'app/top_bar.php'; ?>

  <!-- ======= Sidebar ======= -->
  <?php require_once 'app/student_side_bar.php'; ?>
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
                <div class="container">
                    <h3>Activity Description:</h3>
                    <p>
                        <?php
                            $s = "SELECT * FROM activities WHERE id=".$_GET["id"];
                            $s1 = mysqli_query($con, $s);
                            $s2 = mysqli_fetch_array($s1);
                            echo isset($s2["description"]) ? $s2["description"] : '<i>NIL</i>';
                        ?>
                    </p>
                </div>
                <iframe src="record.php" width="100%" height="100%" style="height: 50vh;"></iframe>
                <div class="d-flex w-100 justify-content-center">
                    <a type="button" class="btn btn-primary rounded-pill" href="student_UploadAudio.php?upload&activity=<?=$_GET["id"]?>">
                        <i class="bi bi-check-lg"></i>
                        Submit Your Audio
                    </a>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php require_once 'app/footer.php'; ?>

</body>

</html>