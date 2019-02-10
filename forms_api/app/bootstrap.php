<?php

    // error reporting
    if (isset($_ENV['environment']) && $_ENV['environment'] == 'debug') {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    } else {
        error_reporting(0);
        ini_set('display_errors', 0);
    }

    // require composer packages
    require __DIR__.'/../vendor/autoload.php';

    // load ENV
    $dotenv = new Dotenv\Dotenv(__DIR__.'/../');
    $dotenv->load();

    // helpers
    require __DIR__.'/helpers/path.php';
    require path::app('helpers/database.php');
    require path::app('helpers/json.php');
    require path::app('helpers/generate.php');
    require path::app('helpers/CORS.php');
    require path::app('helpers/includeFolder.php');
    require path::app('helpers/environments.php');

    // services
    require path::app('services/service.class.php');
    require path::app('services/notify.php');

    // router
    require path::app('routes.php');