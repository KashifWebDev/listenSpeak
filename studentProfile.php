<?php
require 'app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('index.php');
}
if(!isset($_GET["id"])){
    js_redirect("./");
}
$id = $_GET["id"];
$qry = "SELECT * FROM users WHERE id = $id";
$res = mysqli_query($con, $qry);
if(mysqli_num_rows($res)){
    $row = mysqli_fetch_array($res);
}else{
    js_redirect("./");
}

?>
<!DOCTYPE html>
<html lang="en">
<?php $title = "Student Profile"; require_once 'app/head.php'; ?>
<body>

  <!-- ======= Header ======= -->
  <?php require_once 'app/top_bar.php'; ?>

  <!-- ======= Sidebar ======= -->
  <?php
    if($_SESSION["userType"]=="Student") require_once 'app/student_side_bar.php';
    if($_SESSION["userType"]=="Admin") require_once 'app/admin_side_bar.php';
    if($_SESSION["userType"]=="Teacher") require_once 'app/side_bar.php';
  ?>
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

      <section class="section profile dashboard">
          <div class="row">
              <div class="col-xl-12">

                  <div class="card">
                      <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                          <img src="assets/img/students/<?=$row["pic"]?>" alt="Profile" class="rounded-circle shadow">
                          <h2><?=$row["fullName"]?></h2>
                          <h3>Student</h3>
                      </div>
                  </div>

              </div>

              <div class="col-xl-12">

                  <div class="card">
                      <div class="card-body pt-3">
                          <!-- Bordered Tabs -->
                          <ul class="nav nav-tabs nav-tabs-bordered">
                              <li class="nav-item">
                                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                              </li>

                              <li class="nav-item">
                                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#activities">Activities</button>
                              </li>

                              <li class="nav-item">
                                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#grades">Grades</button>
                              </li>
                          </ul>
                          <div class="tab-content pt-2">

                              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                  <h5 class="card-title">Profile Details</h5>

                                  <div class="row">
                                      <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                      <div class="col-lg-9 col-md-8"><?=$row["fullName"]?></div>
                                  </div>

                                  <div class="row">
                                      <div class="col-lg-3 col-md-4 label">Country</div>
                                      <div class="col-lg-9 col-md-8"><?=$row["country"]?></div>
                                  </div>

                                  <div class="row">
                                      <div class="col-lg-3 col-md-4 label">Address</div>
                                      <div class="col-lg-9 col-md-8"><?=$row["address"]?></div>
                                  </div>

                                  <div class="row">
                                      <div class="col-lg-3 col-md-4 label">Phone</div>
                                      <div class="col-lg-9 col-md-8"><?=$row["phone"]?></div>
                                  </div>

                                  <div class="row">
                                      <div class="col-lg-3 col-md-4 label">Email</div>
                                      <div class="col-lg-9 col-md-8"><?=$row["email"]?></div>
                                  </div>

                                  <div class="row">
                                      <div class="col-lg-3 col-md-4 label">Level</div>
                                      <div class="col-lg-9 col-md-8"><?=$row["level"]?></div>
                                  </div>

                              </div>

                              <div class="tab-pane fade profile-edit pt-3" id="activities">

                                  <div class="card-body">
                                      <h5 class="card-title">Recent Activities</h5>

                                      <div class="activity">

                                          <div class="activity-item d-flex">
                                              <div class="activite-label">32 min</div>
                                              <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                              <div class="activity-content">
                                                  Submitted reply to <b>activity No. 4</b>
                                              </div>
                                          </div><!-- End activity item-->

                                          <div class="activity-item d-flex">
                                              <div class="activite-label">56 min</div>
                                              <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                              <div class="activity-content">
                                                  Submitted reply to <b>activity No. 1</b>
                                              </div>
                                          </div><!-- End activity item-->

                                          <div class="activity-item d-flex">
                                              <div class="activite-label">2 hrs</div>
                                              <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                              <div class="activity-content">
                                                  Submitted reply to <b>activity No. 2</b>
                                              </div>
                                          </div><!-- End activity item-->

                                          <div class="activity-item d-flex">
                                              <div class="activite-label">1 day</div>
                                              <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                                              <div class="activity-content">
                                                  Submitted reply to <b>activity No. 3</b>
                                              </div>
                                          </div><!-- End activity item-->

                                          <div class="activity-item d-flex">
                                              <div class="activite-label">2 days</div>
                                              <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                                              <div class="activity-content">
                                                  Submitted reply to <b>activity No. 2</b>
                                              </div>
                                          </div><!-- End activity item-->

                                          <div class="activity-item d-flex">
                                              <div class="activite-label">4 weeks</div>
                                              <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                                              <div class="activity-content">
                                                  Submitted reply to <b>activity No. 4</b>
                                              </div>
                                          </div><!-- End activity item-->

                                      </div>

                                  </div>
                              </div>

                              <div class="tab-pane fade profile-edit pt-3" id="grades">

                                  <div class="card-body">
                                      <h5 class="card-title">Grades</h5>

                                      <table class="table table-striped">
                                          <thead>
                                          <tr>
                                              <th scope="col">#</th>
                                              <th scope="col">Activity Name</th>
                                              <th scope="col">Grades</th>
                                              <th scope="col">Message</th>
                                              <th scope="col">Structure</th>
                                              <th scope="col">Fluency</th>
                                              <th scope="col">Expression</th>
                                              <th scope="col">Projection</th>
                                              <th scope="col">Posture </th>
                                              <th scope="col">Eye Contact</th>
                                              <th scope="col">Pause</th>
                                              <th scope="col">Connection</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                          <tr>
                                              <th scope="row">1</th>
                                              <td>Brandon Jacob</td>
                                              <td>28%</td>
                                              <td>Excellent</td>
                                              <td>Excellent</td>
                                              <td>Excellent</td>
                                              <td>Excellent</td>
                                              <td>Excellent</td>
                                              <td>Excellent</td>
                                              <td>Excellent</td>
                                              <td>Excellent</td>
                                              <td>Excellent</td>
                                          </tr>
                                          </tbody>
                                      </table>

                                  </div>
                              </div>

                          </div><!-- End Bordered Tabs -->

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