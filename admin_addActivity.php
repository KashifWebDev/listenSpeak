<?php
require 'app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "Add Activity"; require_once 'app/head.php'; ?>

<body>

  <!-- ======= Header ======= -->
  <?php require_once 'app/top_bar.php'; ?>

  <!-- ======= Sidebar ======= -->
  <?php require_once 'app/admin_side_bar.php'; ?>
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
                      <h5 class="card-title">Add an Activity</h5>

                      <!-- Vertical Form -->
                      <form class="row g-3">
                          <div class="col-12">
                              <label for="inputNanme4" class="form-label">Activity Name</label>
                              <input type="text" class="form-control" id="inputNanme4">
                          </div>
                          <div class="col-12">
                              <label for="inputEmail4" class="form-label">YouTube Link</label>
                              <input type="email" class="form-control" id="inputEmail4">
                          </div>
                          <div class="col-12">
                              <label for="inputEmail4" class="form-label">Description</label>
                              <textarea class="form-control" style="height: 100px"></textarea>
                          </div>
                          <div class="text-center">
                              <button type="submit" class="btn btn-primary w-50">
                                  <i class="bi bi-plus-circle"></i>
                                  Add
                              </button>
                          </div>
                      </form><!-- Vertical Form -->

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