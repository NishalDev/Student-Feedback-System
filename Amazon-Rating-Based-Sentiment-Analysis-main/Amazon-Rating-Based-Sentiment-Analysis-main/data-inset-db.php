<?php
$xd = mysqli_connect('localhost', 'root', '', 'product');

$query = mysqli_query($xd,"ALTER table reviews auto_increment=1");
mysqli_close($xd);

?>





<!DOCTYPE html>
<html>
    <head>
      






    </head>
    <body><center>
    
        <div>
           <?php
            require 'header.php';
           ?>
           
           <div id="bannerImage">
               <div class="container">
                   <center>
                   <div id="bannerContent">
                       <h1>Amazon Rating Based Analysis </h1>
                       <p>Data From www.kaggle.com</p>
                      
                   </div>
                   </center>
               </div>
           </div>
           
           
           
           
           <?php
$db = mysqli_connect('localhost', 'root', '', 'product');
//Open the file
$fileHandle = fopen("data.csv", "r");

//Loop through the CSV rows
while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
    //Print out my column data
    echo 'Asin: ' . $row[0] . '<br>';
    echo 'Brand: ' . $row[1] . '<br>';
    echo 'Model: ' . $row[2] . '<br>';
    echo 'Title: ' . $row[9] . '<br>';
    echo 'Name: ' . $row[6] . '<br>';
    echo 'Rating: ' . $row[7] . '<br>';
    echo 'Review: ' . $row[10] . '<br>';
    echo 'Link: ' . $row[3] . '<br>';
   
    echo '<br>'; 
    $query = mysqli_query($db,"INSERT INTO reviews(asin, brand, model, title, name,  rating, review, link, img) values ('".$row[0]."', '".$row[1]."','".$row[2]."','".$row[9]."','".$row[6]."','".$row[7]."', '".$row[10]."','".$row[3]."','".$row[4]."')");

}


    
   mysqli_close($db);


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
    </body>
</html>