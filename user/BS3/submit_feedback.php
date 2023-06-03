<!-- submit_feedback.php -->
<?php
include('../../dbconfig.php');
extract($_POST);

if (isset($submit)) {
    // Retrieve the feedback_id from the query parameters
$feedbackId = $_GET['feedback_id'];

    // Convert the JSON string to an array or object
    $questionData = json_decode($decodedQuestions, true);

    // Check if decoding was successful
    if ($questionData !== null) {
        // Iterate over each question and display them
        foreach ($questionData as $question) {
            $questionId = $question['question_id'];
            $questionText = $question['question_text'];
            $options = $question['options'];

            echo "<h3>$questionText</h3>";

            // Display the options for each question
            foreach ($options as $option) {
                $optionId = $option['option_id'];
                $optionText = $option['option_text'];

                echo "<input type='radio' name='question_$questionId' value='$optionId'> $optionText<br>";
            }

            echo "<br>";
        }
    } else {
        // JSON decoding error occurred
        echo "Error decoding JSON: " . json_last_error_msg();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Submit Feedback</title>
</head>

<body>
    <h1>Submit Feedback</h1>

    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Retrieve the questions and options from the URL parameters
    $questions = $_GET['questions'];
    $decodedQuestions = urldecode($questions);

    // Convert the JSON string to an array or object
    $questionData = json_decode($decodedQuestions, true);

    // Check if decoding was successful
    if ($questionData !== null) {
        // Iterate over each question and display them
        foreach ($questionData as $question) {
            $questionId = $question['question_id'];
            $questionText = $question['question_text'];
            $options = $question['options'];

            echo "<h3>$questionText</h3>";

            // Display the options for each question
            foreach ($options as $option) {
                $optionId = $option['option_id'];
                $optionText = $option['option_text'];

                echo "<input type='radio' name='question_$questionId' value='$optionId'> $optionText<br>";
            }

            echo "<br>";
        }
    } else {
        // JSON decoding error occurred
        echo "Error decoding JSON: " . json_last_error_msg();
    }
    ?>

    <div class="col-md-4">
        <div class="form-group">
            <input type="submit" class="btn btn-success" name="submit" value="Submit">
        </div>
    </div>

    <script>
        function submitForm() {
            // Get the selected options
            var selectedOptions = [];
            var optionElements = document.querySelectorAll('input[type="radio"]:checked');
            optionElements.forEach(function (option) {
                var questionId = option.name.replace('question_', '');
                var optionId = option.value;
                selectedOptions.push({
                    questionId: questionId,
                    optionId: optionId
                });
            });

            // Make an AJAX request to submit the feedback
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'submit_feedback_process.php');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Feedback submitted successfully
                    console.log(xhr.responseText);
                    // Redirect or show a success message
                } else {
                    // Error occurred while submitting feedback
                    console.error(xhr.statusText);
                    // Display an error message
                }
            };
            xhr.onerror = function () {
                // Error occurred while making the AJAX request
                console.error(xhr.statusText);
                // Display an error message
            };
            xhr.send(JSON.stringify(selectedOptions));
        }
    </script>

</body>

</html>