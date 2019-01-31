<?php

    if (isset($argv[1])) {
        $validation_rules = json_decode($argv[1]);
    } else {
        $validation_rules = [];
    }

    $back_end_path = 'api/';

    // require composer packages
    require $back_end_path.'vendor/autoload.php';

    // load ENV
    $dotenv = new Dotenv\Dotenv($back_end_path);
    $dotenv->load();

    // helpers
    require $back_end_path.'app/helpers/path.php';
    require path::app('helpers/database.php');
    require path::app('helpers/generate.php');

    // controller
    require path::app('controllers/formsController.php');

    // insert
    $result = formsController::insert($validation_rules);

    if ($result) {
        echo "\033[92mAdded form with public ID: ".$result."\033[0m\n";
    } else {
        echo "\033[91mERROR: Could not add form.\033[0m\n";
    }

?>