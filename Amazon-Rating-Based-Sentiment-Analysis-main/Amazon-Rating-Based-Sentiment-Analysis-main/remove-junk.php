<?php
$db = mysqli_connect('localhost', 'root', '', 'product');
$val = 0 ;

$sql = "DELETE FROM reviews WHERE asin='$val'";
	 if (mysqli_query($db, $sql))
      {
  echo "bitch";
	 } 
     else {
		echo "Error: junk is not there have you contacted Nagarasabhe";
	 }
	 mysqli_close($db);
  


  
    
  

  
  ?>