<?php
$xd = mysqli_connect('localhost', 'root', '', 'product');

$query = mysqli_query($xd,"ALTER table analysis auto_increment=1");
mysqli_close($xd);

?>













<!DOCTYPE html>
<html>
<head>

</head>
    
<body style="background-color:white;">
        


             <center>
                    <h1>Analizer</h1>
                   
















<?php


$db = new mysqli("localhost","root",'',"product");




function detect_sentiment($string){

$url = "http://text-processing.com/api/sentiment/";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/x-www-form-urlencoded",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POSTFIELDS, "text=$string");

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
//$response = json_decode($resp,true);
curl_close($curl);

return $resp;
}

$sql = "SELECT review FROM reviews " ;
$result = mysqli_query($db, $sql);
$data = array();
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        array_push($data, $row);
    }

} else {
    echo "0 results";
}
echo "<br>";

$count = count($data);
 
for ($x = 1; $x <= $count; $x++){

print_r($data[$x]);

$string = json_encode($data[$x]);
$analz = detect_sentiment($string);

print_r($analz);

//print_r($get);
echo "<br>";
echo "<br>";
$get = json_decode($analz, true);
//print_r($get);
echo "<br>";
print_r($get["probability"]);
echo "<br>";
print_r($get["label"]);
echo "<br>";
echo "<br>";
$neg = $get['probability']['neg'];
$neu = $get['probability']['neutral'];
$pos = $get['probability']['pos'];
//$state = $get['label'];
$cmp = $neg+$neu+$pos ;

//echo $neg, $neu, $pos, $cmp ;
echo "<br>";
$pt = strcmp($get['label'],"pos");
$nt = strcmp($get['label'],"neg");
$nu = strcmp($get['label'],"neutral");
if($pt == 0)
{
$state = "positive";  

}
elseif($nt == 0)
{
$state = "negative";  
}
else
{
    $state = "neutral";  
}

$query = "INSERT INTO analysis(neg, neu, pos, compound, state) VALUES ($neg, $neu, $pos, $cmp ,'".$state."')";   
$out = mysqli_query($db,$query); 



}
 












$db->close();
 
?>

<br><br> <br><br><br><br>
           <footer class="footer"> 
               <div class="container">
               <center>
                   <p>SENTIMENT ANALYSIS FOR PRODUCT RATING</p>
               </center>
               </div>
           </footer>
        </div>
        </center>
        </p>
        </p>
    </body>
</html>


























