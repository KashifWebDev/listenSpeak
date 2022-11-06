<?php
require 'app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('index.php');
}
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
                            $s = "SELECT * FROM solutions WHERE graded=0";
                            $res = mysqli_query($con, $s);
                            if(mysqli_num_rows($res)){
                                $count = 1;
                            while ($row = mysqli_fetch_array($res)){
                                $userID = $row["user_id"];
                                $activityID = $row["activity_id"];
                                $qry = "SELECT * FROm users WHERE id=$userID";
                                $qry1 = mysqli_query($con, $qry);
                                $qry2 = mysqli_fetch_array($qry1);
                                $username = $qry2["fullName"];
                                $qry = "SELECT * FROm activities WHERE id=$activityID";
                                $qry1 = mysqli_query($con, $qry);
                                $qry2 = mysqli_fetch_array($qry1);
                                $activityName = $qry2["name"] ?? '';
                            ?>
                                <tr>
                                    <th scope="row"><?=$count++?></th>
                                    <td><?=$activityName?></td>
                                    <td><?=$username?></td>
                                    <td><?=$row["date_time"]?></td>
                                    <td>
                                        <a href="teacher_checkSolution.php?id=<?=$row["id"]?>" class="btn btn-primary rounded-pill">
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
  <?php require_once 'app/footer.php'; ?>
  <!-- End Footer -->

</body>

</html>