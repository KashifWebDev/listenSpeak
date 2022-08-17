<?php
require 'app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('index.php');
}
if(isset($_POST["addStudent"])){
    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $country = isset($_POST["country"]) ? $_POST["country"] : '';
    $address = isset($_POST["address"]) ? $_POST["address"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : '';
    $pass = isset($_POST["pass"]) ? $_POST["pass"] : '';
    $level = isset($_POST["level"]) ? $_POST["level"] : '';
    $picture = "default.jpg";

    if(!empty($_FILES['image']['name'])){
        $banner=$_FILES['image']['name'];
        $expbanner=explode('.',$banner);
        $bannerexptype=$expbanner[1];
        date_default_timezone_set('Africa/Johannesburg');
        $date = date('m/d/Yh:i:sa', time());
        $rand=rand(10000,99999);
        $encname=$date.$rand;
        $picture=md5($encname).'.'.$bannerexptype;
        $bannerpath="assets/img/students/".$picture;
        move_uploaded_file($_FILES["image"]["tmp_name"],$bannerpath);
    }

    $qry = "SELECT * FROM users where email='$email'";
    $result = mysqli_query($con, $qry);
    $num_rows = mysqli_num_rows($result);
    if($num_rows >= 1){
        js_redirect("admin_registerStudent.php?err=1");
    }else{
        $sql = mysqli_query ($con,
            "INSERT INTO
                    users(fullName, country, address, phone, email, pass, userType, pic, level) 
                    VALUES ('$name', '$country', '$address', '$phone', '$email', '$pass', 'Student', '$picture', '$level')"
        );
        if($sql){
            js_redirect("admin_registerStudent.php?success=1");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "Add New Student"; require_once 'app/head.php'; ?>

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
                      User was added successfully!
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              <?php
              }
              if(isset($_GET["err"])){
                  ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="bi bi-exclamation-octagon me-1"></i>
                      Email Already Exists!
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              <?php
              }
              ?>
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Registration Form</h5>

                      <!-- Horizontal Form -->
                      <form action="" method="post" enctype="multipart/form-data">
                          <div class="row mb-3">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Full Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputText" required name="name">
                              </div>
                          </div>
                          <div class="row mb-3">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                  <input type="email" class="form-control" id="inputEmail" required name="email">
                              </div>
                          </div>
                          <div class="row mb-3">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                              <div class="col-sm-10">
                                  <input type="password" class="form-control" id="inputPassword" required name="pass">
                              </div>
                          </div>
                          <div class="row mb-3">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Country</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputPassword" required name="country">
                              </div>
                          </div>
                          <div class="row mb-3">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputPassword" required name="address">
                              </div>
                          </div>
                          <div class="row mb-3">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputPassword" required name="phone">
                              </div>
                          </div>
                          <div class="row mb-3">
                              <label for="inputPassword3" class="col-sm-2 col-form-label">Level</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputPassword" required name="level" placeholder="Foundation-1">
                              </div>
                          </div>
                          <div class="row mb-3">
                              <label for="inputNumber" class="col-sm-2 col-form-label">Picture</label>
                              <div class="col-sm-10">
                                  <input class="form-control" type="file" id="formFile" name="image">
                              </div>
                          </div>
                          <div class="text-center">
                              <button type="submit" class="btn btn-primary" name="addStudent">
                                  <i class="bi bi-person-plus me-2"></i>
                                  Save Student
                              </button>
                          </div>
                      </form><!-- End Horizontal Form -->

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