
<?php

$connect= new mysqli("localhost","root",'',"product");
?>
<?php
if (isset($_POST['rst'])) 
{
  $del = $_POST['del'];
  alert("Hello\nHow are you?");
  }
?>





<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <title>SENTIMENT ANALYSIS </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">

<style>
.button_css
{
	background-color: black;
	color: white;
	width: 150px;
	height: 40px;
}


</style>




    </head>
    <body>
    
        <div>
           <?php
            require 'header.php';
           ?>
           
           <div id="bannerImage">
               <div class="container">
                   <center>
                   <div id="bannerContent">
                   <form method = 'POST' action = 'reset-db.php'>
                   <input type="submit" class="button_css" name="del" value="Reset Reviews">
                   </form>
                   <form method = 'POST' action = 'reset-db2.php'>
                   <input type="submit" class="button_css" name="del2" value="Reset Analysis">
                   </form>
                       <h1>Amazon Rating Based Sentiment Analysis </h1>
                       <p>Data From www.kaggle.com</p>
                       
                   </div>
                   </center>
               </div>
           </div>
           <?php
				$query = "SELECT  re.*,an.* FROM reviews re,analysis an WHERE re.id=an.id ";
				$result = mysqli_query($connect, $query);
                
			
					while($row = mysqli_fetch_array($result))
					{ 
				?>
           <div class="container">
          
               <div class="row">
                   <div class="col-xs-4">
                       <div  class="thumbnail">
                           
                           <img src="<?php echo $row["img"]; ?>"  />
                           </a>
                           <center>
                                <div class="caption">
                                        <p ><?php echo $row["model"]; ?></p>
                                        
                                </div>
                           </center>
                          
                        </div>
                      
                    </div>


                    <div class="col-xs-4">
                       <div class="thumbnail">
                           
                           <center>
                               <div class="caption">
                                   <p><?php 
                                   echo "<b>".$row["rating"].' Star' ."</b>"; 
                                   echo "<br>";
                                   echo $row["title"]; 
                                   echo "<br>";
                                   echo $row["name"]; 
                                   echo "<br>";
                                   echo  "<a href=".$row["link"].">"."Feature Ratings Live"."</a>";
                                   echo "<br>";
                                   echo  " <p style='color:red;'>"."NEG  NEU  POS  COMPOUND"."</p>";
                                   
                                   echo " <p style='color:green;'>"."<b>".$row["neg"]."  ".$row["neu"]."  ".$row["pos"]."  ".$row["compound"]."</b>"."</p>";
                                   echo "<br>";
                                   echo $row["state"]; 
                                   
                                   ?></p>
                                   
                               </div>
                           </center>
                       </div>
                   </div>
                   
                   <div class="col-xs-4">
                       <div class="thumbnail">
                           
                           <center>
                               <div class="caption">
                                   <p><?php 
                                   echo "<br>";
                                   echo $row["review"]; 
                                   echo "<br>";
                                   ?></p>
                                   <p></p>
                               </div>
                           </center>
                       </div>
                   </div>

             </div>  
           
               
           </div>
           
           <?php
				   }
				
                
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
        
    </body>
</html>