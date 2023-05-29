<?php
// Assuming you have a database connection established
include('../dbconfig.php');
// Retrieve the selected department, course, semester, and subject from the AJAX request
$dep = $_POST['dep'];
$course = $_POST['course'];
$sem = $_POST['sem'];
$subject = $_POST['subject'];

// Prepare a query to fetch the questions and options based on the selected criteria
$query = "SELECT * FROM feedback WHERE department_id = '$dep' AND course_id = '$course' AND sem_id = '$sem' AND subject_id = '$subject'";
$result = mysqli_query($conn, $query);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    $output = '';

    // Loop through each row
    while ($row = mysqli_fetch_assoc($result)) {
        // Get the question and options
        $question = $row['question'];
        $optionId = $row['Option_id'];

        // Retrieve the options from the database based on the optionId
        $optionsQuery = "SELECT option1, option2, option3, option4, option5 FROM options WHERE Option_id = '$optionId'";
        $optionsResult = mysqli_query($conn, $optionsQuery);
        $optionsRow = mysqli_fetch_assoc($optionsResult);

        // Extract the options from the row
        $options = array_values($optionsRow);

        // Display the question
        $output .= "<h3>$question</h3>";

        // Display the options
        $output .= "<ul>";
        foreach ($options as $option) {
            $output .= "<li>$option</li>";
        }
        $output .= "</ul>";
    }

    echo $output; // Send the HTML content back as the response
} else {
    echo "No questions found for the selected criteria.";
}
?>