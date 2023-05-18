<?php
require 'app.php';
// Check if the course ID is provided in the request
if (isset($_GET['courseID'])) {
    $courseID = $_GET['courseID'];

    // Fetch subjects for the selected course from the database
    $query = "SELECT * FROM subjects WHERE course_id = $courseID";
    $result = mysqli_query($GLOBALS['con'], $query);

    // Check if there are any subjects available
    if (mysqli_num_rows($result) > 0) {
        // Generate the options for the subject dropdown
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['subject_name'] . '</option>';
        }
    } else {
        echo '<option value="">No subjects available</option>';
    }
}

?>
