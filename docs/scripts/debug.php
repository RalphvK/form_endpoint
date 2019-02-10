<?php

    require __DIR__.'/config.php';

    $_ENV['environment'] = 'debug';

    echo "\033[94mDEBUG START\033[0m\n";
    echo "\033[94m".str_repeat("\u{2588}", 80)."\033[0m\n";

    // bootstrap
    require COMPOSER_CFG::BACK_END_PATH.'app/bootstrap.php';

    notify::via('email')->send([
        'to' => [
            'address' => 'ralphnld@gmail.com',
            'name' => 'Ralph'
        ],
        'replyTo' => [
            [
                'address' => 'test@example.com',
                'name' => 'Example.com'
            ]
        ],
        'html' => 'This is a test mail',
        'plain' => 'This is a test mail'
    ]);