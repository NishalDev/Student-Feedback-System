

<?php
    $page = file_get_contents("https://www.amazon.com/Apple-9-7in-256GB-Cellular-Renewed/dp/B07D42T6MB");
    $doc = new DOMDocument();
    $doc->loadHTML($page);
    $node = $doc->getElementById('cr-ADPlaceholder');
     echo $doc->saveHtml($node), PHP_EOL;
?>




