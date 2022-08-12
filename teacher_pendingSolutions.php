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
          <li class="breadcrumb-item"><a href="./teacherDashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item active"><?= $title ?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Students</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Submitted Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Activity</td>
                                <td>Ron</td>
                                <td>
                                    22 Apr, 2022
                                </td>
                                <td>
                                    <a href="teacher_checkSolution.php" class="btn btn-primary rounded-pill">
                                        <i class="bi bi-pen-fill me-1"></i>
                                        Grade 
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Activity</td>
                                <td>Rexi</td>
                                <td>
                                    22 Apr, 2022
                                </td>
                                <td>
                                    <a href="student_allActivities.php" class="btn btn-primary rounded-pill">
                                        <i class="bi bi-pen-fill me-1"></i>
                                        Grade 
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Activity</td>
                                <td>Danial</td>
                                <td>
                                    22 Apr, 2022
                                </td>
                                <td>
                                    <a href="teacher_checkSolution.php" class="btn btn-primary rounded-pill">
                                        <i class="bi bi-pen-fill me-1"></i>
                                        Grade 
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Activity</td>
                                <td>Scott</td>
                                <td>
                                    22 Apr, 2022
                                </td>
                                <td>
                                    <a href="teacher_checkSolution.php" class="btn btn-primary rounded-pill">
                                        <i class="bi bi-pen-fill me-1"></i>
                                        Grade 
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Activity</td>
                                <td>Ali</td>
                                <td>
                                    22 Apr, 2022
                                </td>
                                <td>
                                    <a href="teacher_checkSolution.php" class="btn btn-primary rounded-pill">
                                        <i class="bi bi-pen-fill me-1"></i>
                                        Grade 
                                    </a>
                                </td>
                            </tr>
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