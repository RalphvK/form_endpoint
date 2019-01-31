<?php

    // error reporting
    error_reporting(0);
    ini_set('display_errors', 0);

    // require composer packages
    require __DIR__.'/../vendor/autoload.php';

    // load ENV
    $dotenv = new Dotenv\Dotenv(__DIR__.'/../');
    $dotenv->load();

    // CORS enable
    require __DIR__.'/CORS_headers.php';

    // helpers
    require __DIR__.'/helpers/path.php';
    require path::app('/helpers/database.php');
    require path::app('/helpers/json.php');
    require path::app('/helpers/generate.php');

    // router
    require path::app('routes.php');