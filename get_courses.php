

<?php
// Assuming you have a database connection established
require('dbconfig.php');

// Check if the departmentId is sent through GET request
if (isset($_GET['departmentId'])) {
    $departmentId = $_GET['departmentId'];

    // Prepare and execute the query to fetch courses based on the department
    $query = "SELECT * FROM course WHERE department_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $departmentId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Fetch the courses into an array
    $courses = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $courses[] = $row;
    }

    // Return the courses as a JSON response
    echo json_encode($courses);
}
?>