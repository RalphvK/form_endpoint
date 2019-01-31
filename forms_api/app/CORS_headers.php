<?php

    // origin whitelist
    function get_origin_whitelist() {
        $expression = '/,\s*/';
        return preg_split($expression, $_ENV['CORS_WHITELIST']);
    }

    if (isset($_SERVER["HTTP_ORIGIN"])) {
        if (in_array($_SERVER["HTTP_ORIGIN"], get_origin_whitelist())) {
            header('Access-Control-Allow-Origin: '.$_SERVER["HTTP_ORIGIN"]);
            header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
            header("Access-Control-Allow-Headers: X-Requested-With");
            header("Access-Control-Allow-Credentials: true");
        }
    }

?>