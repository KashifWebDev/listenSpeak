<?php
if(isset($_GET["del"])){
    $id = $_GET["del"];
    $s = "DELETE FROM courses WHERE course_id = $id";
    if(mysqli_query($GLOBALS["con"], $s)){
        js_redirect("manage_courses.php?delSuccess=1");
    }

}
if(isset($_POST["addStudent"])){
    $id = $_POST["id"];
    $name = $_POST["name"] ?? '';
    $desc = $_POST["desc"] ?? '';
    $picture = $_POST["oldImg"];

    if(!empty($_FILES['image']['name'])){
        $banner=$_FILES['image']['name'];
        $expbanner=explode('.',$banner);
        $bannerexptype=$expbanner[1];
        $date = date('m/d/Yh:i:sa', time());
        $rand=rand(10000,99999);
        $encname=$date.$rand;
        $picture=md5($encname).'.'.$bannerexptype;
        $bannerpath="../../assets/img/courses/".$picture;
        move_uploaded_file($_FILES["image"]["tmp_name"],$bannerpath);
    }
    $sql = "UPDATE courses SET course_name='$name',thumbnail='$picture',description='$desc' WHERE course_id = $id";

    $res = mysqli_query($GLOBALS["con"],$sql);
    if($res){
        js_redirect("manage_courses.php?success=1");
    }
}
?>
<?php
if(isset($_GET["success"])){
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Course was updated successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
}
if(isset($_GET["delSuccess"])){
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Course was deleted successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
}
?>
<div class="card">
    <div class="card-body">

        <div class="w-100 mt-4">
            <?php
            $qry = "SELECT * FROM courses";
            $res = mysqli_query($con, $qry);
            if(mysqli_num_rows($res)){
                echo '<div class="row">';
                while ($row = mysqli_fetch_array($res)){
                    ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="../../assets/img/courses/<?=$row["thumbnail"]?>" height="207px" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?=$row['course_name']?></h5>
                                <p class="card-text"><?=limitString($row['description'], '')?></p>
                                <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#edit_modal_<?=$row["course_id"]?>">
                                    <i class="bi bi-pencil-fill me-1"></i>
                                    Edit
                                </button>
                                <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#delete_modal_<?=$row["course_id"]?>">
                                    <i class="bi bi-trash-fill me-1"></i>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Modal-->
                    <div class="modal fade" id="delete_modal_<?=$row["course_id"]?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Delete Course</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure to delete this course permanently?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="manage_courses.php?del=<?=$row["course_id"]?>" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Modal-->
                    <div class="modal fade" id="edit_modal_<?=$row["course_id"]?>" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Edit Course Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" value="<?=$row["course_id"]?>" name="id">
                                        <input type="hidden" value="<?=$row["thumbnail"]?>" name="oldImg">
                                        <div class="row mb-3">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Course Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputText"
                                                       required name="name" value="<?=$row["course_name"]?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputNumber" class="col-sm-3 col-form-label">Cover Picture</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="file" id="formFile" name="image">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputNumber" class="col-sm-3 col-form-label">Old Picture</label>
                                            <div class="col-sm-9">
                                                <img src="../../assets/img/courses/<?=$row["thumbnail"]?>"
                                                     height="100px" width="100px">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputPassword" class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" style="height: 100px" name="desc"><?=$row["description"]?></textarea>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary" name="addStudent">
                                                <i class="bi bi-plus me-2"></i>
                                                Update Course
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="bi bi-x me-2"></i>
                                                Close
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                echo '</div>'; // close the row container inside the while loop
            }
            ?>
        </div>

    </div>
</div>


