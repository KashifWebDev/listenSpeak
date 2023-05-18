<?php
    function countUnits($id): int {
        $s = "SELECT * FROM student_units WHERE student_id = $id";
        $res = mysqli_query($GLOBALS["con"], $s);
        return mysqli_num_rows($res);
    }
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">All Students</h5>
                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Progress</th>
                        <th scope="col">Completed Units</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $s = "SELECT * FROM users WHERE user_type='Student'";
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
                                        <div class="progress" style="width: 175px">
                                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                        </div>
                                    </td>
                                    <td>
                                        <?=countUnits($row["user_id"])?>
                                    </td>
                                    <td>
                                        <a href="<?=root()?>showProfile.php?id=<?=$row["user_id"]?>" class="btn btn-primary rounded-pill">
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