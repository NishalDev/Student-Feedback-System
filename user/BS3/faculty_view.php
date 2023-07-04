<?php
// Assuming you have a database connection established
include('../../dbconfig.php');

// Retrieve the average sentiment score from the URL parameter
if (isset($_GET['avg_result'])) {
    $averageSentimentScore = $_GET['avg_result'];
} else {
    echo "Average sentiment score not provided.";
    exit;
}

// Retrieve the faculty email from the database
$query = "SELECT Fac_email FROM faculty_subject";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $facultyEmail = $row['Fac_email'];

            // Send the average sentiment score to the respective faculty (email or other method)
            echo "Average Sentiment Score: " . $averageSentimentScore . "<br>";
            echo "Sending the average sentiment score to the respective faculty: " . $facultyEmail . "<br>";
        }
    } else {
        echo "No faculty found.";
    }
} else {
    echo "Error occurred during database query: " . mysqli_error($conn);
}
?>

<!-- HTML content for displaying the average sentiment score to the faculty -->
<!DOCTYPE html>
<html>
<head>
    <title>Faculty View</title>
</head>
<body>
    <h1>Average Sentiment Score</h1>
    <p><?php echo "Score: " . $averageSentimentScore; ?></p>
</body>
</html>
