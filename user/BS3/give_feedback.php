<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../dbconfig.php');
include('../../admin/scripts.php');

$sql = "SELECT * FROM stu_regi";

$result = mysqli_query($conn, $sql);

if ($result) {
    $stud = $_SESSION['stu_id'];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $dep = $row['department_id'];
            $course = $row['course_id'];
            $sem = $row['sem_id'];
        }
    }
}
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
                    <a href="give_feedback.php" class="simple-text">
                        Student Feedback System
                    </a>
                </div>
                <ul class="nav">
                    <li>
                        <a href="dashboard.html">
                            <i class="pe-7s-graph"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="user.html">
                            <i class="pe-7s-user"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="table.html">
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
                        <a class="navbar-brand" href="#">Feedback</a>
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
                                <a href="#">
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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Select Subject</h4>
                                </div>
                                <div style="margin-top: 20px;">
                                    <div style="margin-left: 20px;">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <select class="form-control" id="inputSubject"
                                                    style="font-size: 1.2em; background-color: transparent" name="sub">
                                                    <option value="" disabled selected style="color: black;">
                                                        Subject</option>
                                                    <?php
                                                    // Assuming you have a database connection established, fetch semester data from the database
                                                    $query = "SELECT * FROM subject";
                                                    $result = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        if ($row['subject_name'] == "Select Subject") {
                                                            echo "<option value='" . $row['subject_id'] . "' style='color: white;'>" . $row['subject_name'] . "</option>";
                                                        } else {
                                                            echo "<option value='" . $row['subject_id'] . "' style='color: black;'>" . $row['subject_name'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                    
                                                </select>
                                            </div>
                                         
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="button" class="btn btn-primary" value="Proceed"
                                                        name="save1"
                                                        onclick="loadQuestions('<?php echo $dep; ?>', '<?php echo $course; ?>', '<?php echo $sem; ?>')">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="questionsContainer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</body>

<!--   Core JS Files   -->
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function loadQuestions(dep, course, sem) {
        var subject = document.getElementById('inputSubject').value;
        // Make an AJAX request to a PHP file that will fetch the questions and options
        $.ajax({
            type: 'POST',
            url: 'fetch_question.php',
            data: {
              
                dep: dep,
                course: course,
                sem: sem,
                subject: subject
                
            },
            success: function (response) {
                // Update the HTML content with the fetched questions and options
                document.getElementById('questionsContainer').innerHTML = response;
            },
            error: function () {
                alert('Error occurred while fetching questions.');
            }
        });
    }
</script>
</html>