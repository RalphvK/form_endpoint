<?php

    require __DIR__.'/config.php';

    $_ENV['environment'] = 'debug';

    echo "\033[94mDEBUG START\033[0m\n";
    echo "\033[94m".str_repeat("\u{2588}", 80)."\033[0m\n";

    // bootstrap
    require COMPOSER_CFG::BACK_END_PATH.'app/bootstrap.php';

    $post = json_decode($_ENV['DEBUG_POST'], true);
    $formCfg = json_decode($_ENV['DEBUG_FORMCFG'], true);

    var_dump($formCfg);

    notify::via('email')->hook($post, $formCfg);