<?php

    session_start();

    ini_set("implicit_flush", 1);
    while (@ob_end_flush());
    ob_implicit_flush(true);

    // require composer packages
    require __DIR__.'/../vendor/autoload.php';

    // load ENV
    $dotenv = new Dotenv\Dotenv(__DIR__.'/../');
    $dotenv->load();

    // error reporting
    if (isset($_ENV['ENVIRONMENT']) && $_ENV['ENVIRONMENT'] == 'DEBUG') {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    } else {
        error_reporting(0);
        ini_set('display_errors', 0);
    }

    // helpers
    require __DIR__.'/helpers/path.php';
    require path::app('helpers/database.php');
    require path::app('helpers/prettify.php');
    require path::app('helpers/json.php');
    require path::app('helpers/generate.php');
    require path::app('helpers/CORS.php');
    require path::app('helpers/environments.php');
    require path::app('helpers/redirect.php');

    // components
    require path::component('notify');

    // router
    if (!isset($_ENV['cli']) || $_ENV['cli'] !== true) {
        require path::app('routes.php');
    }