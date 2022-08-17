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
                        <th scope="col">Submitted Activities</th>
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
                                    <td>28</td>
                                    <td>
                                        <a href="studentProfile.php?id=<?=$row["id"]?>" class="btn btn-primary rounded-pill">
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