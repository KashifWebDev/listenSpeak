<?php
function studentUnit($Uid){
    $s_id = $_SESSION["id"];
    $query = "SELECT * FROM student_units WHERE student_id = $s_id AND unit_id=$Uid";
    $result = mysqli_query($GLOBALS['con'], $query);

    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}

$query = "SELECT courses.course_id, courses.course_name, subjects.subject_id, subjects.subject_name, units.unit_id, units.unit_name, units.type
          FROM courses
          LEFT JOIN subjects ON courses.course_id = subjects.course_id
          LEFT JOIN units ON subjects.subject_id = units.subject_id
          ORDER BY courses.course_id, subjects.subject_id";

//$query = "SELECT audio_responses.response_id, audio_responses.date_time, units.unit_name, users.fullName AS student_name, teachers.fullName AS teacher_name, audio_responses.audio_url, audio_responses.status
//            FROM audio_responses
//            JOIN units ON audio_responses.unit_id = units.unit_id
//            JOIN users ON audio_responses.student_id = users.user_id AND users.user_type = 'Student'
//            JOIN teacher_courses ON audio_responses.teacher_id = teacher_courses.teacher_id
//            JOIN users AS teachers ON teacher_courses.teacher_id = teachers.user_id
//            ORDER BY audio_responses.date_time DESC
//            ";


$result = mysqli_query($GLOBALS["con"], $query);

if ($result->num_rows > 0) {
    $courses = array();

    // Fetching the data
    while ($row = $result->fetch_assoc()) {
        $courseId = $row['course_id'];
        $courseName = $row['course_name'];
        $subjectId = $row['subject_id'];
        $subjectName = $row['subject_name'];
        $unitId = $row['unit_id'];
        $unitName = $row['unit_name'];
        $unitType = $row['type']; // Added unitType

        // Creating a nested array for each course
        if (!isset($courses[$courseId])) {
            $courses[$courseId] = array(
                'course_name' => $courseName,
                'subjects' => array(),
            );
        }

        // Adding subjects to the respective course
        if ($subjectId !== null) {
            // Creating a nested array for each subject
            if (!isset($courses[$courseId]['subjects'][$subjectId])) {
                $courses[$courseId]['subjects'][$subjectId] = array(
                    'subject_name' => $subjectName,
                    'units' => array(),
                );
            }

            // Adding units to the respective subject
            if ($unitId !== null) {
                // Modified units array to include unitType
                $courses[$courseId]['subjects'][$subjectId]['units'][$unitId] = array(
                    'unit_name' => $unitName,
                    'unit_type' => $unitType,
                    'unit_id' => $unitId,
                );
            }
        }
    }

    echo '<div class="row">';
    foreach ($courses as $courseId => $course) {
        ?>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $course['course_name'] ?></h5>
                    <?php
                    if (count($course['subjects']) === 0) {
                        echo '<p>No subjects found for this course.</p>';
                    } else {
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="accordion" id="accordion-<?= $courseId ?>">
                                    <?php
                                    foreach ($course['subjects'] as $subjectId => $subject) {
                                        ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading-<?= $subjectId ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-<?= $subjectId ?>" aria-expanded="false"
                                                        aria-controls="collapse-<?= $subjectId ?>">
                                                    <b><?= $subject['subject_name'] ?></b>
                                                    <span class="badge bg-primary rounded-pill ms-2"><?=count($subject['units'])?> units</span>
                                                </button>
                                            </h2>
                                            <div id="collapse-<?= $subjectId ?>" class="accordion-collapse collapse"
                                                 aria-labelledby="heading-<?= $subjectId ?>" data-bs-parent="#accordion-<?= $courseId ?>">
                                                <div class="accordion-body">
                                                    <?php
                                                    if(count($subject['units']) == 0){
                                                        echo 'No units found for this Subject';
                                                    }else{
                                                        foreach ($subject['units'] as $unitId => $unit) {
                                                            $liClass = '';
                                                            $uid = $unit['unit_id'];
                                                            $sid = $_SESSION['id'];
                                                            $a1 ="SELECT * FROM audio_responses WHERE unit_id=$uid AND student_id=$sid ORDER BY response_id DESC LIMIT 1";
//                                                            echo $a1;
                                                            $a2 = mysqli_query($GLOBALS["con"], $a1);
                                                            if(mysqli_num_rows($a2)){
                                                                $a3 = mysqli_fetch_array($a2);
                                                                // Check if the unit ID matches the unit_id in the PHP array
                                                                // Check if the status is 'Approved' and set the liClass accordingly
                                                                if ($a3['status'] === 'Approved') {
                                                                    $liClass = 'bg-success-light';
                                                                }
                                                                if ($a3['status'] === 'Rejected') {
                                                                    $liClass = 'bg-danger-light';
                                                                }
//                                                                echo $unit['unit_name'].' -> '.$a3['status'].' | user ->'.$sid.' | '.' unit# -> '.$uid.' | '.' Audio# -> '.$a3['response_id'];
                                                            }
                                                            ?>
                                                            <ol class="list-group">
                                                                <li class="list-group-item d-flex justify-content-between align-items-start <?=$liClass?>">
                                                                    <?php if($liClass == "bg-success-light") echo '<i class="bi bi-check2-circle text-success fs-5"></i>'; ?>
                                                                    <?php if($liClass == "bg-danger-light") echo '<i class="bi bi-x-circle text-success fs-5"></i>'; ?>
                                                                    <div class="ms-2 me-auto">
                                                                        <div class="fw-bold">
                                                                            <a href="<?=root()?>student/submit/index.php?id=<?=$unit['unit_id']?>" class="text-black">
                                                                                <?= $unit['unit_name'] ?>
                                                                            </a>
                                                                            <span class="badge rounded-pill bg-<?=$unit['unit_type']=='Unit' ? 'secondary' : 'success'?>"><?= $unit['unit_type'] ?></span>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ol>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
    echo '</div>';
} else {
    echo "No courses found.";
}
?>
