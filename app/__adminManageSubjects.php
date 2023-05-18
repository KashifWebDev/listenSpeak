<?php
$query = "SELECT courses.course_id, courses.course_name, subjects.subject_id, subjects.subject_name, units.unit_id, units.unit_name, units.type
          FROM courses
          LEFT JOIN subjects ON courses.course_id = subjects.course_id
          LEFT JOIN units ON subjects.subject_id = units.subject_id
          ORDER BY courses.course_id, subjects.subject_id";

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
                                                            ?>
                                                            <ol class="list-group">
                                                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                                                    <div class="ms-2 me-auto">
                                                                        <div class="fw-bold">
                                                                            <?= $unit['unit_name'] ?>
                                                                            <span class="badge rounded-pill bg-<?=$unit['unit_type']=='Unit' ? 'secondary' : 'success'?>"><?= $unit['unit_type'] ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <a class="btn btn-primary rounded-pill" href="<?=root()?>admin/units/edit_unit.php?unit=<?=$unit['unit_id']?>">
                                                                            <i class="bi bi-pencil-fill"></i>
                                                                        </a>
                                                                        <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#edit_modal_3">
                                                                            <i class="bi bi-trash-fill"></i>
                                                                        </button>
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
