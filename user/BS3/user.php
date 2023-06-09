<?php
session_start();
include('../../dbconfig.php');

// Assuming you have already established a database connection

// SQL query to retrieve all rows from a table
$student_id = $_SESSION['stu_regi'];
echo $student_id; 
$sql = "SELECT * FROM stu_regi WHERE stu_email = '$student_id'";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query executed successfully
if ($result) {
    // Check if there are rows returned
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $n = $row['stu_user'];
        echo $n;
        
        // Retrieve and display other data if needed
        $e = $row['stu_email'];
        $mob = $row['stu_mob'];
        $dep = $row['department_id'];
        $course = $row['course_id'];
        $sem = $row['sem_id'];
        // ... and so on for other columns
        
        // Retrieve and display department name
        $dep_name = "";
        $dep_query = mysqli_query($conn, "SELECT department_name FROM department WHERE department_id = '$dep'");
        if ($dep_row = mysqli_fetch_assoc($dep_query)) {
            $dep_name = $dep_row['department_name'];
            echo $dep_name;
        }
        
        // Retrieve and display course name
        $course_name = "";
        $course_query = mysqli_query($conn, "SELECT course_name FROM course WHERE course_id = '$course'");
        if ($course_row = mysqli_fetch_assoc($course_query)) {
            $course_name = $course_row['course_name'];
            echo $course_name;
        }
        
        // Retrieve and display semester name
        $sem_name = "";
        $sem_query = mysqli_query($conn, "SELECT sem_name FROM semester WHERE sem_id = '$sem'");
        if ($sem_row = mysqli_fetch_assoc($sem_query)) {
            $sem_name = $sem_row['sem_name'];
            echo $sem_name;
        }
    } else {
        echo "No rows found in the table.";
    }
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Light Bootstrap Dashboard by Creative Tim</title>

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
</head>

<body>

    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

            <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="../../About1.php" class="simple-text">
                        SFS
                    </a>
                </div>

                <ul class="nav">
                    <li>
                        <a href="dashboard.php">
                            <i class="pe-7s-graph"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="user.php">
                            <i class="pe-7s-user"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li>
                        <a href="give_feedback1.php">
                            <i class="pe-7s-note2"></i>
                            <p>Feedback</p>
                        </a>
                    </li>


                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">User</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-dashboard"></i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>
                                    <span class="notification hidden-sm hidden-xs">5</span>
                                    <p class="hidden-lg hidden-md">
                                        5 Notifications
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Notification 1</a></li>
                                    <li><a href="#">Notification 2</a></li>
                                    <li><a href="#">Notification 3</a></li>
                                    <li><a href="#">Notification 4</a></li>
                                    <li><a href="#">Another notification</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-search"></i>
                                    <p class="hidden-lg hidden-md">Search</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="">
                                    <p>Account</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
                                        Dropdown
                                        <b class="caret"></b>
                                    </p>

                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="../logout.php">
                                    <p>Log out</p>
                                </a>
                            </li>
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
                    </div>
                </div>
            </nav>


            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Edit Profile</h4>
                                </div>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="content">
                                    <form>
                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $n; ?>"
                                                        readonly>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email address</label>
                                                    <input type="email" class="form-control" value="<?php echo $e; ?>"readonly>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Mobile Number</label>
                                                    <input type="text" class="form-control" maxlength="10"
                                                        value="<?php echo $mob; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Department</label>
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $dep_name; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Course</label>
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $course_name; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Semester</label>
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $sem_name; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>About Me</label>
                                                    <textarea rows="5" class="form-control"
                                                        placeholder="Here can be your description"
                                                        value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
                                                </div>
                                            </div>
                                        </div> -->

                                        <button type="submit" onclick="dashboard.php" class="btn btn-info btn-fill pull-right"><-- Dashboard
                                            </button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="card card-user">
                                <div class="image">
                                    <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400"
                                        alt="..." />
                                </div>
                                <div class="content">
                                    <div class="author">
                                        <a href="#">
                                            <img class="avatar border-gray" src="assets/img/faces/face-3.jpg"
                                                alt="..." />
                                            <h4 class="title">Mike Andrew<br />
                                                <small>michael24</small>
                                            </h4>
                                        </a>
                                    </div>
                                    <p class="description text-center"> "Lamborghini Mercy <br>
                                        Your chick she so thirsty <br>
                                        I'm in that two seat Lambo"
                                    </p>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <button href="#" class="btn btn-simple"><i
                                            class="fa fa-facebook-square"></i></button>
                                    <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                                    <button href="#" class="btn btn-simple"><i
                                            class="fa fa-google-plus-square"></i></button>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="../../home.php">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="../../about.php">
                                    About
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </footer>
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