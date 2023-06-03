
<?php
// Assuming you have a database connection established
include('../../dbconfig.php');

// Get the JSON payload from the request
$jsonPayload = file_get_contents('php://input');

// Check if the JSON payload is empty or invalid
if (empty($jsonPayload)) {
    http_response_code(400); // Bad Request
    exit('Empty JSON payload');
}

// Decode the JSON payload
$options = json_decode($jsonPayload, true);

// Check if JSON decoding was successful
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400); // Bad Request
    exit('Error decoding JSON: ' . json_last_error_msg());
}

// Loop through each question and its selected option
foreach ($options as $questionId => $selectedOption) {
    // Sanitize the values before inserting into the database to prevent SQL injection
    $questionId = mysqli_real_escape_string($conn, $questionId);
    $selectedOption = mysqli_real_escape_string($conn, $selectedOption);

    // Insert the selected option into the database
    $insertQuery = "INSERT INTO feedback_responses (feedback_id, selected_option, response_date) VALUES ('$questionId', '$selectedOption', NOW())";

    if (mysqli_query($conn, $insertQuery)) {
        // Option successfully inserted
        echo "Option for question ID $questionId stored successfully.";
    } else {
        // Error occurred while inserting option
        echo "Error storing option for question ID $questionId: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
