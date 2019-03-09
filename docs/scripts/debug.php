<?php

    require __DIR__.'/config.php';

    $_ENV['ENVIRONMENT'] = 'debug';
    $_ENV['cli'] = true;

    session_start();

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

        // forms
        if (arg_is('forms')) {
            $forms = ORM::for_table('forms')->find_many();
            foreach ($forms as $key => $form) {
                var_dump($form->as_array());
            }
        }

        // ORM
        if (arg_is('orm')) {
            require path::app('controllers/formsController.php');
            $public_id = 'exampleid';
            $form = formsController::getForm($public_id);
            if ($form) {
                var_dump($form->as_array());
            } else {
                var_dump($form);
            }
        }

        // admin
        if (arg_is('admin')) {
            require path::bootstrap('admin');
            require path::component('admin', 'formController.php');
            echo formController::index(null);
        }

        // form_user
        // example command: composer debug form_user marry(11,14)
        if (arg_is('form_user')) {
            require path::bootstrap('admin');
            echo "\033[92mexecuting: form_user::".$argv[2]."\033[94m\n";
            eval("print_r(form_user::".$argv[2].");");
        }

    }

    echo "\033[0m\n";