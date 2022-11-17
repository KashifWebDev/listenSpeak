<?php
require 'app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('index.php');
}
if(isset($_GET["sendMsg"])){
    whatsapp($_GET["sendMsg"]);
    js_redirect("admin_whatsapp.php?success");
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "Test Whatsapp"; require_once 'app/head.php'; ?>

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
            <div class="col-lg-12">

                <?php
                    if(isset($_GET["success"])){
                        ?>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="alert alert-primary bg-primary text-light border-0 alert-dismissible fade show" role="alert">
                                    Message was sent successfully!
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Students</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Number</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $s = "SELECT * FROM users WHERE userType='Student'";
                            $res = mysqli_query($con, $s);
                            if(mysqli_num_rows($res)){
                                $count = 1;
                                while ($row = mysqli_fetch_array($res)){
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$count++?></th>
                                        <td>
                                            <img height="37px" src="assets/img/students/<?=$row["pic"]?>" alt="" class="me-2">
                                            <?=$row["fullName"]?>
                                        </td>
                                        <td><?=$row["phone"]?></td>
                                        <td>
                                            <a href="admin_whatsapp.php?sendMsg=<?=$row["phone"]?>" class="btn btn-success rounded-pill">
                                                <i class="bi bi-whatsapp me-1"></i>
                                                Send Message
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
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