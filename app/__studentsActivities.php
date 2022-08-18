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
                        <th scope="col">Activity</th>
                        <th scope="col">Solution</th>
                        <th scope="col">Date Submitted</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $uid = $_SESSION["id"];
                        $s = "SELECT * FROM solutions WHERE user_id = $uid";
                        $res = mysqli_query($con, $s);
                        if(mysqli_num_rows($res)){
                            while ($row = mysqli_fetch_array($res)){
                                $count = 1;
                                ?>
                                <tr>
                                    <th scope="row"><?=$count++?></th>
                                    <td>Brandon Jacob</td>
                                    <td>
                                        <a href="javascript:void(0)">Listen Audio</a>
                                    </td>
                                    <td>10 Apr, 2022</td>
                                    <td>
                                        <a href="student_UploadAudio.php?id=<?=$row["activity_id"]?>" class="btn btn-primary rounded-pill">
                                            <i class="bi bi-arrow-clockwise me-1"></i>
                                            Resubmit Solution
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>