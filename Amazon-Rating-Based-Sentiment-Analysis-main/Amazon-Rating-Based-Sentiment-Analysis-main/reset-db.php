
<?php


$db = mysqli_connect('localhost', 'root', '', 'product');


if (isset($_POST['del'])) 
{
  
	 $sql = "DELETE FROM reviews WHERE id!=0";
	 if (mysqli_query($db, $sql))
     
     {
        echo '<script>alert("Done")</script>';
        header("Refresh:1; url=index.php");
     
	 } 
     else {
		echo '<script>alert("Reviews Database is Empty")</script>';
        
	 
  }
  
}
  ?>