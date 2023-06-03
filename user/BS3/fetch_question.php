<?php
// Assuming you have a database connection established
include('../../dbconfig.php');
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

    // Start the form
    $output .= "<form action='store_options.php' method='post' onsubmit='submitForm(event)'>";

    // Loop through each row
    while ($row = mysqli_fetch_assoc($result)) {
        // Get the question and options
        $questionId = $row['feedback_id'];
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

        // Display the options as radio buttons with unique names
        foreach ($options as $option) {
            $output .= "<label style='margin-right: 10px;'><input type='radio' name='options_$questionId' value='$option'>$option</label>";
        }
    }
    $output .= "<button type='submit'>Submit</button>";

    // End the form
    $output .= "</form>";

    echo $output; // Send the HTML content back as the response
} else {
    echo "No questions found for the selected criteria.";
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function submitForm(event) {
        event.preventDefault(); // Prevent the default form submission

        // Retrieve all the selected options
        var selectedOptions = {};
        var questions = document.getElementsByTagName('h3');

        for (var i = 0; i < questions.length; i++) {
            var questionId = questions[i].textContent;
            var options = document.getElementsByName('options_' + questionId);

            for (var j = 0; j < options.length; j++) {
                if (options[j].checked) {
                    selectedOptions[questionId] = options[j].value;
                    break; // Assuming only one option can be selected
                }
            }
        }

        // Make an AJAX request to store the selected options
        $.ajax({
            type: 'POST',
            url: 'store_options.php', // Replace with the actual PHP file name or endpoint to store the options
            data: {
                options: JSON.stringify(selectedOptions)
            },
            success: function (response) {
                // Handle the response if needed
                console.log(response);
            },
            error: function () {
                alert('Error occurred while storing options.');
            }
        });
    }
</script>