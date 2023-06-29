<?php
// Assuming you have a database connection established
include('../dbconfig.php');
// Retrieve the submitted faculty information
$name = $_POST['name'];
$email = $_POST['email'];
$department = $_POST['department'];
$course = $_POST['course'];
$semester = $_POST['semester'];
$subject = $_POST['subject'];

// Perform data validation and sanitization if required

// Update the faculty record in the database
$query = "UPDATE faculty SET name='$name', email='$email', department='$department', course='$course', semester='$semester', subject='$subject' WHERE faculty_id='$facultyId'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Faculty record updated successfully
    echo "Faculty information updated successfully.";
} else {
    // Error occurred while updating faculty record
    echo "Error updating faculty information: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>