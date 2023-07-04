<?php
// include('../dbconfig.php');

// // Enable error reporting and display all errors
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// if (isset($_GET['id'])) {
// 	$facultyId = $_GET['id'];
// 	echo "<script>console.log('Faculty ID:', " . $facultyId . ");</script>";
// 	// Delete from faculty_subject table
// 	$deleteSubjectQuery = "DELETE FROM faculty_subject WHERE Fac_id = '$facultyId'";
// 	$deleteSubjectResult = mysqli_query($conn, $deleteSubjectQuery);
// 	echo "<script>console.log('Faculty ID:', " . $facultyId . ");</script>";
// 	if ($deleteSubjectResult) {
// 		// Delete from fac_regi table
// 		$deleteFacultyQuery = "DELETE FROM fac_regi WHERE Fac_id = '$facultyId'";
// 		$deleteFacultyResult = mysqli_query($conn, $deleteFacultyQuery);

// 		if ($deleteFacultyResult) {
// 			header('location: dashboard.php?info=contact');
// 			exit();
// 		} else {
// 			$error = mysqli_error($conn);
// 			echo "Error deleting faculty record from fac_regi table: " . $error;
// 		}
// 	} else {
// 		$error = mysqli_error($conn);
// 		echo "Error deleting faculty record from faculty_subject table: " . $error;
// 	}
// } else {
// 	echo "Invalid faculty ID.";
// }
// ?>