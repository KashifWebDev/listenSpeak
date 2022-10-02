<?php
require 'app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('index.php');
}
if(isset($_POST["addActivity"])){
    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $link = isset($_POST["link"]) ? $_POST["link"] : '';
    $desc = isset($_POST["desc"]) ? $_POST["desc"] : '';
    $newFileName = null;

if(isset($_FILES['file'])) {
    $errors= array();
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $file_ext= pathinfo($file_name, PATHINFO_EXTENSION);

    $fileNameCmps = explode(".", $file_name);

    // sanitize file-name
    $newFileName = md5(time()). '.' . $file_ext;

    $extensions= array("jpeg","jpg","png", "pdf", "doc", "docx");

    if(in_array($file_ext,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }

    if($file_size > 2097152) {
        $errors[]='File size must be excately 2 MB';
    }

    if(empty($errors)==true) {
        move_uploaded_file($file_tmp,"assets/files/".$newFileName);
        echo "Success";
    }else{
        print_r($errors);
    }
}

    $sql = "INSERT INTO activities (name, link, description, file) 
            VALUES ('$name', '$link', '$desc', '$newFileName')";
    mysqli_query($con, $sql) ?
        js_redirect('admin_addActivity.php?success=1') :
        js_redirect('admin_addActivity.php?err=1');
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
              <?php
              if(isset($_GET["success"])){
                  ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <i class="bi bi-check-circle me-1"></i>
                      Activity was added successfully!
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php
              }
              if(isset($_GET["err"])){
                  ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="bi bi-exclamation-octagon me-1"></i>
                      Error occurred while adding activity!
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php
              }
              ?>
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Add an Activity</h5>

                      <!-- Vertical Form -->
                      <form class="row g-3" method="post" action="" enctype="multipart/form-data">
                          <div class="col-12">
                              <label for="inputNanme4" class="form-label">Activity Name</label>
                              <input type="text" class="form-control" id="inputNanme4" name="name" required>
                          </div>
                          <div class="col-12">
                              <label for="inputEmail4" class="form-label">YouTube Link</label>
                              <input type="text" class="form-control" id="inputEmail4" name="link">
                          </div>
                          <div class="col-12">
                              <label for="inputEmail4" class="form-label">Description</label>
                              <textarea class="form-control" name="desc" style="height: 100px"></textarea>
                          </div>
                          <div class="row my-3">
                              <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                              <div class="col-sm-10">
                                  <input class="form-control" type="file" id="formFile" name="file">
                              </div>
                          </div>
                          <div class="text-center">
                              <button type="submit" class="btn btn-primary w-50" name="addActivity">
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