<?php
require '../../app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('../../index.php');
}
function fetchCount($table, $column = null, $data = null): int{
    $s = (isset($column) && isset($data)) ?  "SELECT * FROM $table WHERE $column=$data" : "SELECT * FROM $table";
    $res = mysqli_query($GLOBALS["con"], $s);
    return mysqli_num_rows($res);
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "Student Dashboard"; $path = '../../'; require_once '../../app/head.php'; ?>
<body>

<!-- ======= Header ======= -->
<?php require_once '../../app/top_bar.php'; ?>

<!-- ======= Sidebar ======= -->
<?php require_once '../../app/student_side_bar.php'; ?>
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

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Studied Units</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?=fetchCount('student_units', 'student_id', $_SESSION["id"])?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Pending Units</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?=fetchCount('units', 'type', "'Unit'")-fetchCount('student_units', 'student_id', $_SESSION["id"])?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-3 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Courses</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?=fetchCount('courses')?></h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-3 col-xl-12">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Units</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-journal-text"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?=fetchCount('units', 'type', "'Unit'")?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- End Customers Card -->

                </div>
            </div><!-- End Left side columns -->


        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">All Activities</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Unit Link</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $qry = "SELECT * FROM units";
                        $res = mysqli_query($con, $qry);
                        if(mysqli_num_rows($res)){
                            $count =1;
                            while ($row = mysqli_fetch_array($res)){
                                ?>
                                <tr>
                                    <th scope="row"><?=$count++?></th>
                                    <td><?=$row["unit_name"]?></td>
                                    <td>
                                        <a target="_blank" href="<?=$row["link"]?>">Link</a>
                                    </td>
                                    <td>
                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Released</span>
                                    </td>
                                    <td>
                                        <a href="../submit/index.php?id=<?=$row["unit_id"]?>" class="btn btn-primary rounded-pill">
                                            <i class="bi bi-upload me-1"></i>
                                            Submit Solution
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                        </tbody>
                    </table>
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