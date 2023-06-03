<?php
// Assuming you have a database connection established
include('../../dbconfig.php');

// Retrieve the course_id and sem_id from the AJAX request
$course_id = $_POST['course_id'];
$sem_id = $_POST['sem_id'];

// Prepare a query to fetch the subjects based on the course_id and sem_id
$query = "SELECT * FROM subject WHERE course_id = '$course_id' AND sem_id = '$sem_id'";
$result = mysqli_query($conn, $query);

// Check if there are any subjects found
if (mysqli_num_rows($result) > 0) {
    $output = '';

    // Generate the HTML options for each subject
    while ($row = mysqli_fetch_assoc($result)) {
        $subject_id = $row['subject_id'];
        $subject_name = $row['subject_name'];

        $output .= "<option value='$subject_id'>$subject_name</option>";
    }

    echo $output; // Send the HTML content back as the response
} else {
    echo "<option value='' disabled>No subjects found</option>";
}
?>
