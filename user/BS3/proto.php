<?php
// Text to analyze
$text = "I hate this product! It's amazing.";

// Prepare the request payload
$data = array(
    'text' => $text
);

// Send the request to the API
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://text-processing.com/api/sentiment/');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
$response = curl_exec($curl);
curl_close($curl);
// Process the API response
if ($response) {
    $result = json_decode($response, true);
    if (isset($result['label']) && isset($result['probability'])) {
        $label = $result['label'];
        $probability = $result['probability'][$label];

        // Output the sentiment analysis results
        echo "Text: " . $text . "<br>";
        echo "Sentiment: " . $label . "<br>";
        echo "Probability: " . $probability . "<br>";
    } else {
        echo "Unable to analyze sentiment.";
    }
} else {
    echo "Error occurred during API request.";
}
?>
