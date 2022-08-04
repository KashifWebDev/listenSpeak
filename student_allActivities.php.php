<!DOCTYPE html>
<html lang="en">

<?php $title = "All Activities"; require_once 'app/head.php'; ?>

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
                                <th scope="col">Total Attempts</th>
                                <th scope="col">Youtube Link</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Activity</td>
                                <td>28</td>
                                <td>
                                    <a href="javascript:void(0)">Link</a>
                                </td>
                                <td>
                                    <a href="student_UploadAudio.php" class="btn btn-primary rounded-pill">
                                        <i class="bi bi-upload me-1"></i>
                                        Submit Solution
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Activity</td>
                                <td>35</td>
                                <td>
                                    <a href="">Link</a>
                                </td>
                                <td>
                                    <a href="student_UploadAudio.php" class="btn btn-primary rounded-pill">
                                        <i class="bi bi-upload me-1"></i>
                                        Submit Solution
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Activity</td>
                                <td>45</td>
                                <td>
                                    <a href="javascript:void(0)">Link</a>
                                </td>
                                <td>
                                    <a href="student_UploadAudio.php" class="btn btn-primary rounded-pill">
                                        <i class="bi bi-upload me-1"></i>
                                        Submit Solution
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Activity</td>
                                <td>34</td>
                                <td>
                                    <a href="javascript:void(0)">Link</a>
                                </td>
                                <td>
                                    <a href="student_UploadAudio.php" class="btn btn-primary rounded-pill">
                                        <i class="bi bi-upload me-1"></i>
                                        Submit Solution
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Activity</td>
                                <td>47</td>
                                <td>
                                    <a href="javascript:void(0)">Link</a>
                                </td>
                                <td>
                                    <a href="student_UploadAudio.php" class="btn btn-primary rounded-pill">
                                        <i class="bi bi-upload me-1"></i>
                                        Submit Solution
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