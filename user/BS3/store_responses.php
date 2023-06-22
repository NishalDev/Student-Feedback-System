<?php
// Assuming you have a database connection established
include('../../dbconfig.php');

// Process the form submission and store the responses
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //  echo $studentId;   
    // Iterate through the POST data to retrieve the question responses
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'question_') === 0) {
            $questionId = substr($key, strlen('question_'));
            $optionId = mysqli_real_escape_string($conn, $value);

            // Insert the response into the feedback_response table
            $insertQuery = "INSERT INTO feedback_response (question_id, option_id) VALUES ('$questionId', '$optionId')";
            mysqli_query($conn, $insertQuery);
        }
    }

    echo 'Responses stored successfully.';
} else {
    echo 'Invalid request.';
}
?>