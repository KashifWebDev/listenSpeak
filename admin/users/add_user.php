<?php
require '../../app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('../../index.php');
}
if(isset($_POST["add"])){
    $name = $_POST["name"] ?? null;
    $email = $_POST["email"] ?? null;
    $pass = $_POST["pass"] ?? null;
    $user_type = $_POST["user_type"] ?? null;
    $country = $_POST["country"] ?? null;
    $phone = $_POST["phone"] ?? null;
    $address = $_POST["address"] ?? null;
    $level = $_POST["level"] ?? null;

    $sql = "INSERT INTO users(email, user_type, fullName, pass, address, phone, country, level) 
            VALUES ('$email', '$user_type', '$name', '$pass', '$address', '$phone', '$country', '$level')";
    $res = mysqli_query($GLOBALS["con"],$sql);
    if($res){
        js_redirect("add_user.php?success=1");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "Add New User"; $path = '../../'; require_once '../../app/head.php'; ?>
<body>

<!-- ======= Header ======= -->
<?php require_once '../../app/top_bar.php'; ?>

<!-- ======= Sidebar ======= -->
<?php require_once '../../app/admin_side_bar.php'; ?>
<!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard">Dashboard</a></li>
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
                ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-person-fill"></i>
                            Add New User
                        </h5>

                        <form action="" method="post">
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Full Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputText" required name="name" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="inputText" required name="email" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="inputText" required name="pass" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">User Type</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" name="user_type" required>
                                        <option selected value>Select Course</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Student">Student</option>
                                        <option value="Teacher">Teacher</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Select Level</label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" name="level" required>
                                        <option value="Foundation 1">Foundation 1</option>
                                        <option value="Foundation 2">Foundation 2</option>
                                        <option value="Foundation 3">Foundation 3</option>
                                        <option value="Basic 1">Basic 1</option>
                                        <option value="Basic 2">Basic 2</option>
                                        <option value="Intermediate 1">Intermediate 1</option>
                                        <option value="Intermediate 2">Intermediate 2</option>
                                        <option value="Advanced 1">Advanced 1</option>
                                        <option value="Advanced 1">Advanced 1</option>
                                        <option value="Student">Student</option>
                                        <option value="Teacher">Teacher</option>
                                    </select>
                                </div>
                            </div>
<!--                            <div class="row mb-3">-->
<!--                                <label for="inputPassword" class="col-sm-3 col-form-label">Country</label>-->
<!--                                <div class="col-sm-9">-->
<!--                                    <input type="text" class="form-control" id="inputText" required name="country" >-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Contact Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputText" required name="phone" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputText" required name="address" >
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="add">
                                    <i class="bi bi-person me-2"></i>
                                    Add User
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php require_once '../../app/footer.php'; ?>
<!-- End Footer -->

</body>

</html>