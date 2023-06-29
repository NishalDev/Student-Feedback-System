
<?php

//CURL
$ch = curl_init();
$s_searchFor = "Fingerprint reader";
$timeout = 5; // set to zero for no timeout
curl_setopt ($ch, CURLOPT_URL, "https://www.amazon.com/Apple-9-7in-256GB-Cellular-Renewed/dp/B07D42T6MB");//enter your url here
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

$file_contents = curl_exec($ch); //get the page contents
preg_match('"/"',$s_searchFor,'"(.*)"' ,$file_contents, $matches); //match the element
$file_contents = $matches[0]; //set the file_contents var to the matched elements





echo $file_contents;



?>