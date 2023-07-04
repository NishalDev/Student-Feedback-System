<?php
// Assuming you have a database connection established
include('dbconfig.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $email = $_POST['stu_email'];
    $password = $_POST['stu_pass'];

    // Validate the form data (you can add more validation if needed)

    // Update the password in the database
    $query = "UPDATE stu_regi SET stu_pass = ? WHERE stu_email = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "ss", $password, $email);
    mysqli_stmt_execute($statement);

    // Check if the password update was successful
    if (mysqli_stmt_affected_rows($statement) > 0) {
        // Password updated successfully
        echo "Password changed successfully.";
    } else {
        // Password update failed
        echo "Failed to change the password. Please try again.";
    }

    // Close the statement
    mysqli_stmt_close($statement);

    // Close the database connection
    mysqli_close($conn);
} else {
    // If the form is not submitted, retrieve the necessary information from the URL or session
    $email = $_GET['stu_email']; // Retrieve the email from the URL or session, modify accordingly
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
</head>

<body>
    <h2>Forgot Password</h2>
    <form method="POST" action="">
        <label for="stu_email">Email:</label>
        <input type="email" name="stu_email" required><br><br>

        <label for="stu_pass">New Password:</label>
        <input type="password" name="stu_pass" required><br><br>

        <input type="submit" value="Reset Password">
    </form>



</body>

</html>