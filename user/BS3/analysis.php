<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../dbconfig.php');
include('../../admin/scripts.php');

$sql = "SELECT * FROM stu_regi";

$result = mysqli_query($conn, $sql);


if ($result) {
  

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $dep = $row['department_id'];
            $course = $row['course_id'];
            $sem = $row['sem_id'];
        }
    }
}


    function detect_sentiment($string){
    $string = urlencode($string);
    $api_key = "afad1f63b412d987f421a2dc3b2e83";
    $url = 'https://api.paysify.com/sentiment?api_key='.$api_key.'&string='.$string.'';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $response = json_decode($result,true);
    curl_close($ch);
    return $response;
    }
    

    $db = new mysqli("localhost","root",'',"student_feedback_system");



  $sql = "SELECT review FROM reviews " ;
  $result2 = mysqli_query($db, $sql);
  echo "Study PHP at " . $sql . "<br>";



  $string = json_encode($result2);
  $analz = detect_sentiment($string);

  echo "<br>";
  
  echo "<h2>" . $analz . "</h2>";

  echo $analz;
  echo "<br>";
  echo "<br>";
  echo "<br>";

//   $slice = implode("=>",$analz['state']);
//   $pieces = explode("=>", $slice);
 
//   $neg = $analz[0];
//   $neu = $analz[1];
//   $pos = $analz[2];
//   $compound =$analz[3];
  
//   $query = "INSERT INTO analysis(neg, neu, pos, compound) VALUES ($neg, $neu, $pos, $compound) ";
//   $out = mysqli_query($conn,$query);





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

</html>
