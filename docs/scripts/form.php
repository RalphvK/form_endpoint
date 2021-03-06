<?php

    require __DIR__.'/config.php';

    if (isset($argv[1])) {
        $name = $argv[1];
    } else {
        $name = null;
    }

    $back_end_path = COMPOSER_CFG::BACK_END_PATH;

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
    $result = formsController::insert(['name' => $name]);

    if ($result) {
        echo "\033[92mAdded form with public ID: ".$result."\033[0m\n";
    } else {
        echo "\033[91mERROR: Could not add form.\033[0m\n";
    }

?>