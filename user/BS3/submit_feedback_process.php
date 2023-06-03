<?php
// Retrieve the feedback_id from the query parameters
$feedbackId = $_GET['feedback_id'];

// Perform any necessary database operations to store the feedback_id in the feedback_responses table
// Assuming you are using MySQLi, you can establish a database connection and execute the query like this:

// Create a new MySQLi object and connect to the database
include('../../dbconfig.php');

// Check if the connection was successful
if ($conn->connect_errno) {
    // Handle the connection error
    die("Failed to connect to MySQL: " . $conn->connect_error);
}

// Prepare the SQL statement to insert the feedback_id into the feedback_responses table
$sql = "INSERT INTO feedback_responses (feedback_id) VALUES ('$feedbackId')";

// Execute the query
if ($conn->query($sql) === true) {
    echo "Feedback response submitted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
