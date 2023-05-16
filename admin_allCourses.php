<?php
require 'app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('index.php');
}
if(isset($_POST["updateActivity"])){
    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $link = isset($_POST["link"]) ? $_POST["link"] : '';
    $desc = isset($_POST["desc"]) ? $_POST["desc"] : '';
    $id = $_POST["activity_id"];
    $sql = "UPDATE activities SET name='$name', link='$link',
                      description='$desc' WHERE id=$id";
    mysqli_query($con, $sql) ?
        js_redirect('admin_allActivities.php?success=1') :
        js_redirect('admin_allActivities.php?err=1');
}
if(isset($_GET["del_id"])) {
    $id = $_GET["del_id"];
    $qry = "DELETE FROM activities WHERE id= $id";
    mysqli_query($con, $qry) ?
        js_redirect('admin_allActivities.php?delDone=1') :
        js_redirect('admin_allActivities.php?delFail=1');
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "All Activities"; require_once 'app/head.php'; ?>

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
        <div class="row">
            <div class="col-lg-12"  >
                <?php
                if(isset($_GET["success"])){
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        Activity was Updated successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                if(isset($_GET["err"])){
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        Something went wrong while updating activity!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                if(isset($_GET["delDone"])){
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        Activity was deleted successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                if(isset($_GET["delFail"])){
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        Something went wrong while deleting activity!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                ?>

                <div class="card">
                    <div class="card-body mt-2">
                        <!-- Table with stripped rows -->
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Item #1
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in felis dignissim, imperdiet nulla vitae, condimentum nulla. Ut scelerisque a nisl sit amet facilisis. Etiam blandit iaculis tellus, vitae condimentum leo congue a. Vivamus in vehicula massa. Pellentesque libero libero, commodo lacinia volutpat non, tincidunt at lectus. Maecenas ipsum turpis, viverra vitae lacus eu, fringilla ultricies erat. Aenean hendrerit maximus sodales.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Item #2
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Quisque sapien augue, ornare id leo a, tristique elementum justo. Praesent non nulla sagittis, sollicitudin justo id, varius erat. Nunc sed pharetra nisl. Cras et suscipit felis, in lacinia sapien. Integer venenatis sagittis massa, eu eleifend nibh venenatis in. Pellentesque a aliquet urna. Curabitur tortor metus, ultrices sed mi at, sagittis imperdiet turpis. Suspendisse nec luctus nunc. Fusce in arcu quis lacus mollis ultrices.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Item #3
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Praesent nec ipsum scelerisque dui condimentum pellentesque eu at lectus. Vivamus purus purus, bibendum in vestibulum ac, pharetra sit amet sapien. Nunc luctus, orci vel luctus cursus, nibh nisl ullamcorper ipsum, eu malesuada arcu augue id nisi. In auctor mi ac ante tincidunt tincidunt.
                                    </div>
                                </div>
                            </div>
                        </div>
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