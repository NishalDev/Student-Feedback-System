<?php
// Assuming you have a database connection established
include('dbconfig.php');

// Check if the connection was successful
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Fetch options from the 'options' table
$query = "SELECT * FROM options";
$result = mysqli_query($conn, $query);

$options = array();
while ($row = mysqli_fetch_assoc($result)) {
    $options[] = $row['option1'] . ", " . $row['option2'] . ", " . $row['option3'] . ", " . $row['option4'] . ", " . $row['option5'];
}

// Close the database connection
mysqli_close($conn);

// Return options as JSON
echo json_encode($options);
?>
