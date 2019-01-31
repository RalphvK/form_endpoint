<?php

    require __DIR__.'/config.php';

    $back_end_path = COMPOSER_CFG::BACK_END_PATH;

    // require composer packages
    require $back_end_path.'vendor/autoload.php';

    // load ENV
    $dotenv = new Dotenv\Dotenv($back_end_path);
    $dotenv->load();

    // support for CORS_WHITELIST
    $CORS_headers_path = $back_end_path.'app/CORS_headers.php';
    file_exists($CORS_headers_path) AND include $CORS_headers_path;

    foreach ($_ENV as $key => $value) {
        if ($key == "CORS_WHITELIST") {
            $origin_whitelist = get_origin_whitelist();
            foreach ($origin_whitelist as $index => $value) {
                echo "\033[94m\"".$key."\"\033[0m => \033[92m\"".$value."\"\033[0m\n";
            }
        } else {
            echo "\033[94m\"".$key."\"\033[0m => \033[92m\"".$value."\"\033[0m\n";
        }
    }

?>