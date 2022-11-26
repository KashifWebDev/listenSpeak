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
//            js_redirect("admin_registerStudent.php?success=1");

            $_SESSION["id"] = mysqli_insert_id($con);;
            $_SESSION["fullName"] = $name;
            $_SESSION["pic"] = $picture;
            $_SESSION["userType"] = 'Student';
            $_SESSION["loginRequired"] = false;
            gotoDashboard();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Register - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

        <section class="section register mt-4">
            <div class="row justify-content-center">
                <div class="col-lg-6">


                    <div class="d-flex justify-content-center py-4">
                        <a href="/" class="logo d-flex align-items-center w-auto">
                            <img src="assets/img/logo.png" alt="">
                            <span class="d-none d-lg-block">Listen&Speak</span>
                        </a>
                    </div><!-- End Logo -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Student Registration Form</h5>

                            <!-- Horizontal Form -->
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Full Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" required="" name="name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" required="" name="email">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword" required="" name="pass">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Country</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPassword" required="" name="country">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPassword" required="" name="address">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPassword" required="" name="phone">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Course</label>
                                    <div class="col-sm-10">
                                        <select id="inputState" class="form-select" name="course">
                                            <option value="Basic">Basic</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="Advance">Advance</option>
                                        </select>
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

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>