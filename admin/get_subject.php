<?php
// Assuming you have a database connection established
require('../dbconfig.php');

// Check if the courseId and semesterId are sent through GET request
if (isset($_GET['courseId']) && isset($_GET['semesterId'])) {
    $courseId = $_GET['courseId'];
    $semesterId = $_GET['semesterId'];

    // Prepare and execute the query to fetch subjects based on the course and semester
    $query = "SELECT * FROM subject WHERE course_id = ? AND sem_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $courseId, $semesterId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Fetch the subjects into an array
    $subjects = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $subjects[] = $row;
    }

    // Close the prepared statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Return the subjects as a JSON response
    echo json_encode($subjects);
}
?>