<?php
require '../../app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('../../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "Users Management"; $path = '../../'; require_once '../../app/head.php'; ?>
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
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Users</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $s = "SELECT * FROM users WHERE user_type!='Admin'";
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
                                        <td>
                                            <?=$row["email"]?>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?=$row["user_type"]=='Student' ? 'info' : 'success'?>"><?=$row["user_type"]?></span>
                                        </td>
                                        <td>
                                            <a href="../../showProfile.php?id=<?=$row["user_id"]?>" class="btn btn-primary rounded-pill">
                                                <i class="bi bi-person-circle me-1"></i>
                                                Profile
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
<?php require_once '../../app/footer.php'; ?>
<!-- End Footer -->

</body>

</html>