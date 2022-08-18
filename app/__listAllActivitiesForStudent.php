<div class="card">
    <div class="card-body">
        <h5 class="card-title">All Activities</h5>
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
            $qry = "SELECT * FROM activities WHERE released=1";
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
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Released</span>
                        </td>
                        <td>
                            <a href="student_UploadAudio.php?id=<?=$row["id"]?>" class="btn btn-primary rounded-pill">
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