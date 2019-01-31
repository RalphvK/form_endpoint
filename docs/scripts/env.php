<?php

    require __DIR__.'/config.php';

    $back_end_path = COMPOSER_CFG::BACK_END_PATH;

    // require composer packages
    require $back_end_path.'vendor/autoload.php';

    // load ENV
    $dotenv = new Dotenv\Dotenv($back_end_path);
    $dotenv->load();

    foreach ($_ENV as $key => $value) {
        echo "\033[94m\"".$key."\"\033[0m => \033[92m\"".$value."\"\033[0m\n";
    }

?>