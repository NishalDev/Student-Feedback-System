$ curl -d "text=great" http://text-processing.com/api/sentiment/
{
        "probability": {
                "neg": 0.39680315784838732,
                "neutral": 0.28207586364297021,
                "pos": 0.60319684215161262
        },
        "label": "pos"
}

$ curl -d "text=terrible" http://text-processing.com/api/sentiment/
{
        "probability": {
                "neg": 0.68846305481785608,
                "neutral": 0.38637609994709854,
                "pos": 0.31153694518214375
        },
        "label": "neg"
}

$ curl -d "text=hi friend" http://text-processing.com/api/sentiment/
{
        "probability": {
                "neg": 0.59797768649386562,
                "neutral": 0.74939503025120124,
                "pos": 0.40202231350613421
        },
        "label": "neutral"



// $query = "INSERT INTO analysis(neg, neu, pos, compound) VALUES ($neg, $neu, $pos, $cmp)";   
// $out = mysqli_query($db,$query); 
 
 <?php
include("simple_html_dom.php");
$html = file_get_contents("https://www.amazon.com/Apple-9-7in-256GB-Cellular-Renewed/dp/B07D42T6MB");
$doc = new DOMDocument();
$doc->loadHTML($html);
$node = $doc->getElementById('histogramTable');
echo $doc->saveHtml($node), PHP_EOL;
?>
