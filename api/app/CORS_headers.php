<?php

    // origin whitelist
    $origin_whitelist = explode(',', $_ENV['CORS_WHITELIST']);

    if (in_array($_SERVER["HTTP_ORIGIN"], $origin_whitelist)) {
        header('Access-Control-Allow-Origin: '.$_SERVER["HTTP_ORIGIN"]);
        header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
        header("Access-Control-Allow-Headers: X-Requested-With");
        header("Access-Control-Allow-Credentials: true");
    }

?>