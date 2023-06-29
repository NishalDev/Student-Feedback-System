<?php
      function detect_sentiment($string){
      $string = urlencode($string);
     
      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, 'http://text-processing.com/api/sentiment/');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, "$string");
      
      $headers = array();
      $headers[] = 'Content-Type: application/x-www-form-urlencoded';
      curl_setopt($ch, -d CURLOPT_HTTPHEADER, $headers);

      $result = curl_exec($ch);
      $response = json_decode($result,true);
      curl_close($ch);
      return $response;
      }
	  



      $string = "This Sentiment analysis api is very good!";
      $data = detect_sentiment($string);
      echo "<pre>";
      print_r($data);
      echo "</pre>";
?>