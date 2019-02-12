<?php

    require __DIR__.'/config.php';

    $_ENV['environment'] = 'debug';

    // bootstrap
    echo "\n\033[102m DOCUMENT START \033[0m\n\n";
    echo "\033[32m";
    require COMPOSER_CFG::BACK_END_PATH.'app/bootstrap.php';
    echo "\033[0m\n";

    if (isset($argv[1])) {

        function arg_is($arg) {
            global $argv;
            return ($argv[1] == $arg);
        }

        echo "\n\n\033[104m DEBUG START \033[0m\n";
        echo "\033[94m\n";

        // email test
        if (arg_is('mail')) {
            $post = json_decode($_ENV['DEBUG_POST'], true);
            $formCfg = json_decode($_ENV['DEBUG_FORMCFG'], true);
            notify::callHooks($post, $formCfg);
        }

        // ORM
        if (arg_is('orm')) {
            $messages= ORM::for_table('messages')->find_many();
            var_dump($messages);
        }

    }

    echo "\033[0m\n";