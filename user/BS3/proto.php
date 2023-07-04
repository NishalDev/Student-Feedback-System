<?php
// Assuming you have a database connection established
include('../../dbconfig.php');

// Check if the database connection is successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Retrieve the faculty information from the database
$facultyQuery = "SELECT Fac_id FROM faculty_subject";
$facultyResult = mysqli_query($conn, $facultyQuery);

if ($facultyResult) {
    if (mysqli_num_rows($facultyResult) > 0) {
        // Loop through each faculty
        while ($facultyRow = mysqli_fetch_assoc($facultyResult)) {
            $facultyId = $facultyRow['Fac_id'];

            // Retrieve the comments for the specific faculty from the database
            $commentQuery = "SELECT comment_text FROM feedback_comment WHERE department_id = ? AND course_id = ? AND sem_id = ? AND subject_id = ? AND Fac_id = ?";
            $statement = mysqli_prepare($conn, $commentQuery);

            if ($statement) {
                mysqli_stmt_bind_param($statement, "iiiii", $departmentId, $courseId, $semId, $subjectId, $facultyId);

                
                $departmentId = 1;
                $courseId = 1;
                $semId = 1;
                $subjectId = 1;

                mysqli_stmt_execute($statement);
                $commentResult = mysqli_stmt_get_result($statement);

                if ($commentResult) {
                    if (mysqli_num_rows($commentResult) > 0) {
                        // Initialize variables
                        $totalSentimentScore = 0;
                        $totalComments = 0;

                        while ($commentRow = mysqli_fetch_assoc($commentResult)) {
                            $commentText = $commentRow['comment_text'];

                            // Prepare the request payload
                            $data = array(
                                'text' => $commentText
                            );

                            // Send the request to the API
                            $curl = curl_init();
                            curl_setopt($curl, CURLOPT_URL, 'http://text-processing.com/api/sentiment/');
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($curl, CURLOPT_POST, true);
                            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                            $response = curl_exec($curl);
                            curl_close($curl);

                            if ($response) {
                                $result = json_decode($response, true);
                                if (isset($result['label']) && isset($result['probability'])) {
                                    $label = $result['label'];
                                    $probability = $result['probability'][$label];

                                    // Calculate the sentiment score
                                    $sentimentScore = 0;
                                    if ($label == 'positive') {
                                        $sentimentScore = 1;
                                    } elseif ($label == 'negative') {
                                        $sentimentScore = -1;
                                    }

                                    // Accumulate the sentiment score and increment the total comments count
                                    $totalSentimentScore += $sentimentScore;
                                    $totalComments++;

                                    // Output the sentiment analysis results
                                    echo "Comment: " . $commentText . "<br>";
                                    echo "Sentiment: " . $label . "<br>";
                                    echo "Probability: " . $probability . "<br>";
                                } else {
                                    echo "Unable to analyze sentiment for the comment: " . $commentText . "<br>";
                                }
                            } else {
                                echo "Error occurred during API request for the comment: " . $commentText . "<br>";
                            }
                        }

                        // Calculate the average sentiment score
                        $averageSentimentScore = $totalSentimentScore / $totalComments;

                        // Send the average sentiment score to the respective faculty (email or other method)
                        echo "Average Sentiment Score for Faculty ID " . $facultyId . ": " . $averageSentimentScore . "<br>";
                    } else {
                        echo "No comments found for the specified faculty (Faculty ID: " . $facultyId . ").<br>";
                    }
                } else {
                    echo "Error occurred during database query for the faculty (Faculty ID: " . $facultyId . ").<br>";
                }

                mysqli_stmt_close($statement);
            } else {
                echo "Error occurred while preparing the database statement for the faculty (Faculty ID: " . $facultyId . ").<br>";
            }
        }
    } else {
        echo "No faculty found in the database.<br>";
    }
} else {
    echo "Error occurred during database query for faculty information.<br>";
}

// Close the database connection
mysqli_close($conn);
?>