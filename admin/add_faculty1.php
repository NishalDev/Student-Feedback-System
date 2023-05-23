<?php
session_start();
include('../dbconfig.php');
//error_reporting(0);

if (!isset($_SESSION['admin'])) {
    header('location:../home.php');
}

extract($_POST);
if (isset($save)) {

    $sql = mysqli_query($conn, "SELECT * FROM fac_regi WHERE fac_email='$e'");

    if (!$sql) {
        // Error handling
        $err = "<font color='red'><h3 align='center'>Query Error: " . mysqli_error($conn) . "</h3></font>";
    } else {
        $r = mysqli_num_rows($sql);

        if ($r > 0) {
            $err = "<font color='red'><h3 align='center'>This user already exists</h3></font>";
            //   } else if (strlen($mob) != 10) {
            //     $err = "<font color='red'><center>Mobile number must be 10 digit</center></font>";
        } else {

            //image
            // $image = $_FILES['image']['name'];

            // $target = "images/" . basename($image);

            //encrypt your password
            $pass = md5($password);
            $query = "INSERT INTO fac_regi (Fac_user,Fac_email,Fac_pass,reg_date) VALUES ('$n','$e','$password',NOW())";

            $result = mysqli_query($conn, $query);
            if ($result) {
                // Registration successful
                $err = "<h3 align='center' style='color: blue'>Registration successful!</h3>";
                //   header("Location: Login1.php");
                // exit;
            } else {
                // Handle the case when the insert query fails
                $err = "<h3 align='center' style='color: red'>Registration failed. Please try again.</h3>";
            }
            $facultyId = mysqli_insert_id($conn);
            $queryFacultySubject = "INSERT INTO faculty_subject (Fac_id, department_id, course_id, sem_id) VALUES ($facultyId, $dep, $course, $sem)";
            mysqli_query($conn, $queryFacultySubject);
            if (mysqli_affected_rows($conn) > 0) {
                echo "Data inserted into the faculty_subject table successfully.";
            } else {
                echo "Failed to insert data into the faculty_subject table.";
            }
        }
    }
   
}
//mysqli_close($conn);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Faculty Feedback System</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <style>
        .wrapper {
            background-image: url('assets/img/image7.jpg');
            background-size: cover;
            background-repeat: no-repeat;

        }

        .panel-default {
            background-color: white;
            margin-left: 50px;
            margin-right: 50px;
            padding: 10px 10px;

        }
    </style>

</head>

<body>

    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

            <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        Hello Admin
                    </a>

                    <img src="assets/img/admin.jpeg" style="width:200px;height:180px;border-radius:50%">

                    <br>
                    <!--<img src = "../../images/<?php echo $users['email']; ?>/<?php echo $users['image']; ?>" style="width:100px; height:500px"> -->

                </div>
                <br>
                <ul class="nav">
                    <li class="active">
                        <a href="index.php">
                            <i class="pe-7s-graph"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <br>

                    <li class="dropdown" style="color:black">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user fa-fw"></i>
                            <p>
                                Faculty
                                <b class="caret"></b>
                            </p>

                        </a>
                        <ul class="dropdown-menu" style="background-color: black">
                            <li><a href="add_faculty1.php"><i class="fa fa-plus fa-fw"
                                        style="height: 2px;width:2px;margin-right:50px;color:white"></i>Add Faculty</a>
                            </li>
                            <li><a href="show_faculty1.php"><i class="fa fa-eye"
                                        style="height: 2px;width:2px;margin-right:50px;color:white"></i>Manage Faculty
                                </a></li>
                        </ul>
                    </li>
                    <br>


                    <li class="dropdown" style="color:black">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user fa-fw"></i>
                            <p>
                                Student
                                <b class="caret"></b>
                            </p>

                        </a>
                        <ul class="dropdown-menu" style="background-color: black">
                            <li><a href="display_student1.php"><i class="fa fa-plus fa-fw"
                                        style="height: 2px;width:2px;margin-right:50px;color:white"></i>Manage
                                    Student</a></li>
                        </ul>
                    </li>
                    <br>

                    <li class="dropdown" style="color:black">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user fa-book"></i>
                            Feedback
                            <b class="caret"></b>
                            </p>

                        </a>
                        <ul class="dropdown-menu" style="background-color: black">
                            <li><a href="feedback1.php"><i class="fa fa-eye"
                                        style="height: 2px;width:2px;margin-right:50px;color:white"></i>Feedback</a>
                            </li>
                            <li><a href="feedback_average1.php"><i class="fa fa-eye"
                                        style="height: 2px;width:2px;margin-right:50px;color:white"></i> Feedback
                                    Average </a></li>
                        </ul>
                    </li>
                    <br>




                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-inverse navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Dashboard</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-dashboard"></i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>


                        </ul>

                        <ul class="nav navbar-nav navbar-right">

                            <li>
                                <a href="logout.php">
                                    <p>Log out</p>
                                </a>
                            </li>
                            <li class="separator hidden-lg"></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <form method="post" style="margin-top: 80px">
                <div style="color: red ">
                    <?php

                    echo @$err;

                    ?>
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row panel panel-default">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title" style="color:orange">Add Faculty</h4>
                                        </div>
                                        <div class="content">

                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label><b> Name </b></label>
                                                        <input type="text" class="form-control" placeholder="name"
                                                            name="n" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label><b> Email </b></label>
                                                        <input type="text" class="form-control" placeholder="email"
                                                            name="e" required>
                                                    </div>
                                                </div>


                                                <!-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><b> Designation </b></label>
                                                    <input type="text" class="form-control" placeholder="Designation"  value="<?php echo @$Designation; ?>" name="Designation" required>
                                                </div>
                                            </div> -->

                                                <!-- 
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Mobile Number</label>
                                                    <input type="number" class="form-control" placeholder="Mobile Number" value="<?php echo @$mob; ?>" maxlength="10" name="mob"  required>
                                                </div>-->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">

                                                    <select class="form-control" id="inputDepartment"
                                                        style="font-size: 1.2em; background-color: transparent "
                                                        name="dep">
                                                        <option value="" disabled selected style="color: white;">
                                                            Department
                                                        </option>
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
                                                </div>




                                                <div class="col-md-4">

                                                    <select class=" form-control" id="inputCourse"
                                                        style="font-size: 1.2em; background-color: transparent"
                                                        name="course" required>
                                                        <option value="" disabled selected style="color: white;">
                                                            Course</option>
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





                                                <div class="col-md-4">

                                                    <select class="form-control" id="inputSemester"
                                                        style="font-size: 1.2em; background-color: transparent"
                                                        name="sem" required>
                                                        <option value="" disabled selected style="color: white;">
                                                            Semester</option>
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
                                            </div>
                                            <div style="margin-top: 20px;"></div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <input type="password" class="form-control"
                                                            placeholder="Password" name="password" required>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div style="margin-left: 15px;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-success" name="save"
                                                            value="Add New Faculty">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </form>



        </div>
    </div>


</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>