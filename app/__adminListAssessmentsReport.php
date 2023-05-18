<?php
function countUnits($id): int {
    $s = "SELECT * FROM units WHERE status != null";
    $res = mysqli_query($GLOBALS["con"], $s);
    return mysqli_num_rows($res);
}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">All Assessments</h5>
                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Assessment Name</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Marked to Teacher</th>
                        <th scope="col">Status</th>
                        <th scope="col">Student Audio File</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT users.fullName AS student_name, 
                             u.fullName AS teacher_name, 
                             audio_responses.audio_url, 
                             units.unit_name, 
                             units.status
                      FROM audio_responses
                      INNER JOIN users ON audio_responses.student_id = users.user_id AND users.user_type = 'Student'
                      INNER JOIN users AS u ON audio_responses.teacher_id = u.user_id AND u.user_type = 'Teacher'
                      INNER JOIN units ON audio_responses.unit_id = units.unit_id";
                    $result = mysqli_query($GLOBALS["con"], $query);

                    if (mysqli_num_rows($result) > 0) {
                        $count = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td scope='row'>".$count++."</td>
                                    <td>".$row['unit_name']."</td>
                                    <td>".$row['student_name']."</td>
                                    <td>".$row['teacher_name']."</td>
                                    <td>
                                        ".getStatusRow($row['status'])."
                                    </td>
                                    <td>
                                        <a href='#".$row['audio_url']."' class='btn btn-primary rounded-pill'>
                                            <i class='bi bi-play-circle-fill'></i>
                                            Play File
                                        </a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "No data available";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<?php
function getStatusRow($status){
    $class = '';
    if($status == 'Pass') $class = 'success';
    if($status == 'Fail') $class = 'danger';
    if($status == 'Pending') $class = 'secondary';
    return "<span class='badge bg-".$class."' style='font-size: small'>".$status."</span>";

}
?>