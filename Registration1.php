<?php
session_start();
require('dbconfig.php');

//error_reporting(0);

extract($_POST);
if (isset($save)) {
  //check user alereay exists or not
  $sql = mysqli_query($conn, "SELECT * FROM stu_regi WHERE stu_email='$e'");

  if (!$sql) {
    // Error handling
    $err = "<font color='red'><h3 align='center'>Query Error: " . mysqli_error($conn) . "</h3></font>";
  } else {
    $r = mysqli_num_rows($sql);
  
  if ($r > 0) {
    $err = "<font color='red'><h3 align='center'>This user already exists</h3></font>";
  } else if (strlen($mob) != 10) {
    $err = "<font color='red'><center>Mobile number must be 10 digit</center></font>";
  } else {

    //image
    // $image = $_FILES['image']['name'];

    // $target = "images/" . basename($image);

    //encrypt your password
    $pass = md5($password);

    $departmentIdQuery = "SELECT department_id FROM department WHERE department_name='$dep'";
    $departmentIdResult = mysqli_query($conn, $departmentIdQuery);
    $departmentIdRow = mysqli_fetch_assoc($departmentIdResult);
    $departmentId = $departmentIdRow['department_id'];
    $courseIdQuery = "SELECT course_id FROM course WHERE course_name='$course'";
    $courseIdResult = mysqli_query($conn, $courseIdQuery);
    $courseIdRow = mysqli_fetch_assoc($courseIdResult);
    $courseId = $courseIdRow['course_id'];
    $semIdQuery = "SELECT sem_id FROM semester WHERE sem_name='$sem'";
    $semIdResult = mysqli_query($conn, $semIdQuery);
    $semIdRow = mysqli_fetch_assoc($semIdResult);
    $semId = $semIdRow['sem_id'];
    $query = "INSERT INTO stu_regi (stu_user,stu_email,stu_mob,departmentId,courseId,semId,reg_date) VALUES ('$n','$e','$mob','$dep','$course','$sem',NOW())";
    $result = mysqli_query($conn, $query);
    if ($result) {
      // Registration successful
      $err = "<h3 align='center' style='color: blue'>Registration successful!</h3>";
  } else {
      // Handle the case when the insert query fails
      $err = "<h3 align='center' style='color: red'>Registration failed. Please try again.</h3>";
  }



    // //upload image

    // mkdir("images/$stu_email");

    // move_uploaded_file($_FILES['image']['tmp_name'], "images/$stu_email/" . $_FILES['image']['name']);


    $err = "<h3 align='center' style='color: blue'>Registration successfull !!<h3>";

  }
}
}

?>

<!DOCTYPE HTML>

<html>

<head>

  <link rel="icon" type="image/png" href="images/favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Faculty Feedback System</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="css/main_reg.css">

  <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
  <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
  <!-- Font special for pages-->
  <link
    href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Vendor CSS-->
  <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
  <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">


  <style>
    body {
      width: 100%;
      color: #bfbfbf;
      background-size: cover;
      background: url("images/blur2.jpg");
      background-size: cover;
      background-attachment: fixed;
      background-position: center;
    }

    input[type="radio"] {
      -webkit-appearance: radio;
    }

    input::placeholder {

      font-size: 1.2em;
    }
  </style>
</head>



<body>

  <header id="header" class="alt">
    <div class="logo"><a href="home.php">Welcome to <span> Online Feedback System</span></a></div>
    <a href="#menu">Menu</a>
  </header>

  <!-- Nav -->
  <nav id="menu">

    <ul class="links">

      <li style="color:#FFFFFF">
        <a style="color:#FFFFFF" href="home.php"><i class="fa fa-home fa-fw"></i>Home</a>
      </li>

      <li style="color:#FFFFFF">
        <a style="color:#FFFFFF" href="About1.php"><i class="fa fa-home fa-fw"></i>About</a>
      </li>

      <li style="color:#FFFFFF">
        <a style="color:#FFFFFF" href="Registration1.php"><i class="fa fa-home fa-fw"></i>Registration</a>
      </li>

      <li class="dropdown">
        <a style="color:#FFFFFF" href="#" class="dropdown-toggle" data-toggle="dropdown" href="#"><i
            class="fa fa-sign-in fa-fw"></i>Login
          <span class="caret"></span></a>
        <ul class="dropdown-menu">

          <li><a href="Login1.php">Student</a></li>
          <li><a href="Faculty_login1.php">Faculty</a></li>
          <li><a href="admin_login.php">Admin</a></li>
        </ul>
      </li>


    </ul>
  </nav>

  <!-- One -->
  <div class="wrapper-style4">
    <header class="align-center">
      <h2 style="color:white; margin-top: 20px">Registration Form</h2>
    </header>
  </div>

  <div class="signup-form" style="padding: 10px 50px 50px 300px">
    <div class="main-div">
      <div class="panel panel-default" style="padding: 30px 25px">
        <!-- <h2 style="margin-top: 10px; margin-bottom: 20px; text-align: center; color:#ffffff">Student Signup</h2> -->
        <form id="signup" method="post" enctype="multipart/form-data" onsubmit="return validatePasswords()">

          <div style="color: red ">
            <?php

            echo @$err;

            ?>


            <div class="form-group">
              <input type="Name" class="form-control" id="inputName" style="color:white; font-size: 1.2em"
                placeholder="Name" name="n" required>
            </div>

            <div class="form-group">
              <input type="email" class="form-control" id="inputEmail" style="color:white;font-size: 1.2em"
                placeholder="Email Address" name="e" required>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" id="inputMob" style="color:white;font-size: 1.2em"
                placeholder="Mobile Number" maxlength="10" name="mob" required>
            </div>
            <div class="form-group">

              <select class="form-control" id="inputDepartment" style="font-size: 1.2em; background-color: transparent "
                name="dep" required onchange="getCourse()">


                <option value="" disabled selected style="color: white;">Department</option>
                <?php
                // Assuming you have a database connection established, fetch department data from the database
                $query = "SELECT * FROM department";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  if ($row['department_name'] == "Select Department") {
                    echo "<option value='" . $row['department_id'] . "' style='color: white;'>" . $row['department_name'] . "</option>";
                  } else {
                    echo "<option value='" . $row['department_id'] . "' style='color: black;'>" . $row['department_name'] . "</option>";
                  }
                }
                ?>
              </select>
              <div style="margin-top: 20px;"></div>
              <div class="form-group">
                <select class="form-control" id="inputCourse" style="font-size: 1.2em; background-color: transparent"
                  name="course" required>
                  <option value="" disabled selected style="color: white;">Select Course</option>
                  <?php
                  // Assuming you have a database connection established, fetch course data from the database
                  $query = "SELECT * FROM course";
                  $result = mysqli_query($conn, $query);
                  while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['course_name'] == "Select Course") {
                      echo "<option value='" . $row['course_id'] . "' style='color: white;'>" . $row['course_name'] . "</option>";
                    } else {
                      echo "<option value='" . $row['course_id'] . "' style='color: black;'>" . $row['course_name'] . "</option>";
                    }
                  }
                  ?>
                </select>
              </div>

              <div style="margin-top: 20px;"></div>

              <div class="form-group">
                <select class="form-control" id="inputSemester" style="font-size: 1.2em; background-color: transparent"
                  name="sem" required>
                  <option value="" disabled selected style="color: white;">Semester</option>
                  <?php
                  // Assuming you have a database connection established, fetch semester data from the database
                  $query = "SELECT * FROM semester";
                  $result = mysqli_query($conn, $query);
                  while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['sem_name'] == "Select Semester") {
                      echo "<option value='" . $row['sem_id'] . "' style='color: white;'>" . $row['sem_name'] . "</option>";
                    } else {
                      echo "<option value='" . $row['sem_id'] . "' style='color: black;'>" . $row['sem_name'] . "</option>";
                    }
                  }
                  ?>
                </select>
              </div>

              <!-- <div class="form-group">

                <input type="hidden" name="size" value="1000000">

                <input type="file" class="form-control" id="inputImage"
                  style="color:white;font-size: 1.2em; padding-left: 5px; padding-top: 5px;" placeholder="Image"
                  name="image" required>

                 <input type="file" class="form-control" id="inputImage" style="color:white;font-size: 1.2em; padding-left: 5px; padding-top: 5px;" placeholder="Image" name="img" required> 


              </div> -->

              <!-- <div class="form-group">

                <input type="date" class="form-control" id="inputDate" style="color:white;font-size: 1.2em"
                  placeholder="Birth-Date" name="yy" required>

              </div> -->

              <div class="form-group">
                <input type="password" class="form-control" id="inputPassword" style="color:white;font-size: 1.2em"
                  placeholder="Password" name="password" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="inputConfirmPassword"
                  style="color:white;font-size: 1.2em" placeholder="Confirm Password" name="confirm_password" required>
              </div>
              <div id="passwordError" style="display: none; color: red;">Passwords do not match.</div>

              <input type="submit" value="Save" class="btn btn-info" name="save" />
              <button type="reset" style="background-color: #ff6600" value="Reset" class="btn btn-warning"> Reset
              </button>
              </button>
        </form>
      </div>

    </div>
  </div>


  <!-- Scripts -->
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.scrollex.min.js"></script>
  <script src="js/skel.min.js"></script>
  <script src="js/util.js"></script>
  <script src="js/main.js"></script>
  <script src="vendor/select2/select2.min.js"></script>
  <script src="vendor/datepicker/moment.min.js"></script>
  <script src="vendor/datepicker/daterangepicker.js"></script>

  <!-- Main JS-->
  <script src="js/global.js"></script>
  <script>
    function getCourse() {
      var departmentId = document.getElementById("inputDepartment").value;

      // Make an AJAX request to get_courses.php with the selected departmentId
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "get_courses.php?departmentId=" + departmentId, true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status >= 200 && xhr.status < 400) {
          var courses = JSON.parse(xhr.responseText);
          var courseSelect = document.getElementById("inputCourse");

          // Clear previous options
          courseSelect.innerHTML = "";

          // Add the fetched courses as options
          for (var i = 0; i < courses.length; i++) {
            var option = document.createElement("option");
            option.value = courses[i].course_id;
            option.text = courses[i].course_name;
            option.style.color = "black"; // Set the font color to black
            courseSelect.appendChild(option);
          }
        }
      };

      // Send the AJAX request
      xhr.send();
    }
  </script>

  <script>
    function validatePasswords() {
      var password = document.getElementById("inputPassword").value;
      var confirmPassword = document.getElementById("inputConfirmPassword").value;

      if (password !== confirmPassword) {
        document.getElementById("passwordError").style.display = "block";
        return false;
      } else {
        document.getElementById("passwordError").style.display = "none";
        return true;
      }
    }
  </script>

</body>

</html>