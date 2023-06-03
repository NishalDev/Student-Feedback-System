<?php
// Assuming you have a database connection established
include('../../dbconfig.php');

// Retrieve the data sent from the AJAX request
$feedbackId = $_POST['feedbackId'];
$studentId = $_POST['studentId'];
$responses = json_decode($_POST['responses'], true);

// Loop through each question and store the response in the database
foreach ($responses as $questionId => $selectedOption) {
  // Prepare and execute the database insertion query
  $query = "INSERT INTO feedback_responses (feedback_id, stu_id, question_id, selected_option) VALUES ('$feedbackId', '$studentId', '$questionId', '$selectedOption')";
  $result = mysqli_query($conn, $query);

  // Check if the insertion was successful
  if (!$result) {
    // Handle the error, if any
    echo "Error occurred while submitting feedback.";
    exit; // Stop further processing
  }
}

// Return a success response
echo "Feedback submitted successfully!";
?>
