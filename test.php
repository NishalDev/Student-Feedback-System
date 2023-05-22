<?php
// Assuming you have a database connection established
require('dbconfig.php');

if (isset($_POST['submit'])) {
    // Extract data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Prepare and execute the INSERT statement
    $query = "INSERT INTO your_table_name (name, email, phone) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $phone);
    mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data.";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Insert Data Form</title>
</head>
<body>
  <h2>Insert Data</h2>
  <form method="POST" action="home.php">
    <div>
      <label for="inputName">Name:</label>
      <input type="text" id="inputName" name="name" required>
    </div>
    <div>
      <label for="inputEmail">Email:</label>
      <input type="email" id="inputEmail" name="email" required>
    </div>
    <div>
      <label for="inputPhone">Phone:</label>
      <input type="tel" id="inputPhone" name="phone" required>
    </div>
    <div>
      <input type="submit" value="Submit" name="submit">
    </div>
  </form>
</body>
</html>
