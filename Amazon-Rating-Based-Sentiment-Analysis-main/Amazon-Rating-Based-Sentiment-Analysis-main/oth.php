
    
    <?php


  $db = new mysqli("localhost","root",'',"product");


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
	  




    $sql = "SELECT review FROM reviews WHERE id=892 " ;
    $result = mysqli_query($db, $sql);
    $data = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

    } else {
        echo "0 results";
    }
    echo "<br>";

    $count = count($data);

    //for ($x = 1; $x <= $count; $x++) 

    //{


    $string = json_encode($data);
    $analz = detect_sentiment($string);

    echo "<br>";
    $get = array_column($analz, 'state');
    $get1 = array_column($analz, 'scores');
    echo $analz["status_message"];
    echo "<br>";
    print_r($get[0]);
    echo "<br>";
    print_r($get1[0]);
    echo "<br>";
    echo "<br>";

    $slice = implode("=>",$get1[0]);
    $pieces = explode("=>", $slice);
   
    $neg = $pieces[0];
    $neu = $pieces[1];
    $pos = $pieces[2];
    $compound =$pieces[3];
    
   
   // $query = "INSERT INTO analysis(neg, neu, pos, compound) VALUES ($neg, $neu, $pos, $compound) ";
    //$out = mysqli_query($db,$query);
 
   // }
 
 
 
 ?>