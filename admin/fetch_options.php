<?php
// Assuming you have a database connection established
include('../dbconfig.php');
// Create an array to store the options
$options = [];

// Fetch department options
$query = "SELECT * FROM department";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $options[] = [
        'type' => 'department',
        'value' => $row['department_id'],
        'label' => $row['department_name']
    ];
}

// Fetch course options
$query = "SELECT * FROM course";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $options[] = [
        'type' => 'course',
        'value' => $row['course_id'],
        'label' => $row['course_name']
    ];
}

// Fetch semester options
$query = "SELECT * FROM semester";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $options[] = [
        'type' => 'semester',
        'value' => $row['sem_id'],
        'label' => $row['sem_name']
    ];
}

// Fetch subject options
$query = "SELECT * FROM subject";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $options[] = [
        'type' => 'subject',
        'value' => $row['subject_id'],
        'label' => $row['subject_name']
    ];
}

// Set the response header to JSON
header('Content-Type: application/json');

// Return the options as JSON
echo json_encode($options);
?>