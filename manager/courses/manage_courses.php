<?php
require '../../app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('../../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "Manage Courses"; $path = '../../'; require_once '../../app/head.php'; ?>
<body>

<!-- ======= Header ======= -->
<?php require_once '../../app/top_bar.php'; ?>

<!-- ======= Sidebar ======= -->
<?php require_once '../../app/manager_side_bar.php'; ?>
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
        <?php require '../../app/__listAllCoursesForAdmin.php'; ?>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php require_once '../../app/footer.php'; ?>
<!-- End Footer -->

</body>

</html>