<?php

// Create a stream
$opts = array(
    'http'=>array(
        'method'=>"GET",
        'header'=>"x-auth-token: 62xwvmx6tcx23j0rawveh0m0gis8ggx\r\n" .
            "Content-Type: json\r\n" .
            "User-agent: BROWSER-DESCRIPTION-HERE\r\n"
    )
);

$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
$file = file_get_contents('https://api.bigcommerce.com/stores/rp0dhg/v3/catalog/products', false, $context);

echo $file;
?>