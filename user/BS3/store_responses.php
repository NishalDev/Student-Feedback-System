<?php
// Assuming you have a database connection established
include('../../dbconfig.php');

// Process the form submission and store the responses

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the comment from the form
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    // Retrieve the selected department, course, semester, and subject from the form
    $dep = $_POST['dep'];
    $course = $_POST['course'];
    $sem = $_POST['sem'];
    $subject = $_POST['subject'];
    //$studentId = $_POST['stu_id'];

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
    $insertCommentQuery = "INSERT INTO feedback_comment (department_id, course_id, sem_id, subject_id, comment_text) VALUES ('$dep', '$course', '$sem', '$subject', '$comment')";
    mysqli_query($conn, $insertCommentQuery);
    echo 'Responses and comment stored successfully.';
} else {
    echo 'Invalid request.';
}
?>