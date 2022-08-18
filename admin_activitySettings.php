<?php
require 'app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('index.php');
}
if(isset($_POST["update"])){
    $num = $_POST["num"];
    $s = "UPDATE config SET activityPerWeek=$num";
    mysqli_query($con, $s);
    js_redirect('admin_activitySettings.php?done=1');
}
$qry = "SELECT activityPerWeek FROM config";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "Activities Settings"; require_once 'app/head.php'; ?>

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
                <?php
                if(isset($_GET["done"])){ ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    Settings were updated successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php } ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Activity Configurations</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" method="post" action="">
                            <div class="d-flex my-3">
                                <label for="inputText" class="col-form-label">Set Activities per Week: </label>
                                <div class="ms-3">
                                    <input type="number" class="form-control" min="1" value="<?=$row["activityPerWeek"]?>" name="num" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-50" name="update">
                                    <i class="bi bi-plus-circle"></i>
                                    Save
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