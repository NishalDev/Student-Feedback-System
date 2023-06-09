<?php
// Assuming you have a database connection established
include('../dbconfig.php');

// Retrieve the selected department, course, semester, and subject from the AJAX request
$dep = $_POST['dep'];
$course = $_POST['course'];
$sem = $_POST['sem'];
$subject = $_POST['subject'];
//$studentId = $_POST['stu_id'];

// Prepare a query to fetch the questions and options based on the selected criteria
$query = "SELECT * FROM feedback_questions WHERE department_id = '$dep' AND course_id = '$course' AND sem_id = '$sem' AND subject_id = '$subject'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $serialNumber = 1; // Counter variable for the serial number
    // echo $studentId;
    // echo '<input type="hidden" name="student_id" value="' . $studentId . '">'; // Hidden field for student ID
    echo '<form action="store_responses.php" method="POST">'; // Form to submit the responses

    while ($row = mysqli_fetch_assoc($result)) {
        $questionId = $row['question_id'];
        $question = $row['question_text'];

        // Retrieve the options for the current question
        $optionsQuery = "SELECT * FROM feedback_question_options WHERE question_id = '$questionId'";
        $optionsResult = mysqli_query($conn, $optionsQuery);

        echo '<div>';
        echo '<p>' . $serialNumber . '. ' . $question . '</p>';

        if (mysqli_num_rows($optionsResult) > 0) {
            echo '<ul>';

            while ($optionRow = mysqli_fetch_assoc($optionsResult)) {
                $optionText = $optionRow['option_text'];

                echo '<li>';
                echo $optionText;
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo 'No options found for this question.';
        }

        echo '</div>';

        $serialNumber++; // Increment the serial number
       
    }

    echo '<input type="submit" value="Submit">';
   
    // echo '</div>'; // Submit button
    echo '</form>';
} else {
    echo 'No questions found for the selected criteria.';
}
?>
