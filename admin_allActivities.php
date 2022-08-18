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
            <div class="col-lg-12">
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
                    <div class="card-body">
                        <h5 class="card-title">All Students</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Youtube Link</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $qry = "SELECT * FROM activities";
                                $res = mysqli_query($con, $qry);
                                if(mysqli_num_rows($res)){
                                    while ($row = mysqli_fetch_array($res)){
                                        $count =1;
                                        ?>
                                        <tr>
                                            <th scope="row"><?=$count++?></th>
                                            <td><?=$row["name"]?></td>
                                            <td>
                                                <a target="_blank" href="<?=$row["link"]?>">Link</a>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $row["released"] ?
                                                        '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Released</span>' :
                                                        '<span class="badge bg-secondary"><i class="bi bi-collection me-1"></i> Pending</span>';
                                                ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#edit_<?=$row["id"]?>">
                                                    <i class="bi bi-pencil-fill me-1"></i>
                                                    Edit
                                                </button>
                                                <button class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#delete_<?=$row["id"]?>">
                                                    <i class="bi bi-trash-fill me-1"></i>
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="edit_<?=$row["id"]?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Edit Activity</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="row g-3" method="post">
                                                            <input type="hidden" value="<?=$row["id"]?>" name="activity_id">
                                                            <div class="col-12">
                                                                <label for="inputNanme4" class="form-label mt-2 fw-bold">Activity Name</label>
                                                                <input type="text" class="form-control" id="inputNanme4" name="name" value="<?=$row["name"]?>">
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="inputEmail4" class="form-label mt-2 fw-bold">YouTube Link</label>
                                                                <input type="text" class="form-control" id="inputEmail4" name="link" value="<?=$row["link"]?>">
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="inputEmail4" class="form-label mt-2 fw-bold">Description</label>
                                                                <textarea class="form-control" name="desc" style="height: 100px"><?=$row["description"]?></textarea>
                                                            </div>
                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-primary w-50" name="updateActivity">
                                                                    <i class="bi bi-plus-circle"></i>
                                                                    Update
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="delete_<?=$row["id"]?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title">Delete Activity</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete activity <b><?=$row["name"]?></b>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <a class="btn btn-danger" href="admin_allActivities.php?del_id=1">Delete</a>
                                                    </div>
                                                </div>deldel
                                            </div>
                                        </div>
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