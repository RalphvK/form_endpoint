<?php

    require __DIR__.'/config.php';

    $_ENV['ENVIRONMENT'] = 'debug';
    $_ENV['cli'] = true;

    // bootstrap
    require COMPOSER_CFG::BACK_END_PATH.'app/bootstrap.php';

    if (isset($argv[1])) {

        function arg_is($arg) {
            global $argv;
            return ($argv[1] == $arg);
        }

        echo "\n\n\033[104m USER MANAGER \033[0m\n";
        echo "\033[94m\n";

        /**
         * AUTH FUNCTIONS
         */

        // register
        if (arg_is('register')) {
            require path::bootstrap('admin');

            $name = $argv[2];
            $email = $argv[3];
            $password = $argv[4];
            
            $user = auth::register($name, $email, $password);

            if ($user) {
                echo "User $name registered with identifiers:\nemail: $email\nid: $user->id\n";
            } else {
                echo "error";
            }
        }

        // check username + password combination
        if (arg_is('check')) {
            require path::bootstrap('admin');
            $email = $argv[2];
            $password = $argv[3];
            if (auth::checkCredentials($email, $password)) {
                echo "\033[92m";
                echo 'VALID!';
            } else {
                echo "\033[91m";
                echo "INVALID!";
            }
        }

        // set new password
        if (arg_is('set_password')) {
            require path::bootstrap('admin');
            $email = $argv[2];
            $password = $argv[3];
            function setPassword($email, $password) {                
                $user = ORM::for_table('users')->where('email', $email)->find_one();
                if ($user) {
                    $user->password = crypto::hash($password);
                    if ($user->save()) {
                        return true;
                    }
                }
                return false;
            }
            if (setPassword($email, $password)) {
                echo "Password set for $email";
            } else {
                echo "ERROR";
            }
        }

        // delete user
        if (arg_is('delete')) {
            require path::bootstrap('admin');
            $email = $argv[2];
            $user = ORM::for_table('users')->where('email', $email)->find_one();
            if ($user) {
                $user->delete();
                echo "\033[91m";
                echo "User $email deleted.";
            } else {
                echo "\033[93m";
                echo "User not found.";
            }
        }

        // list users
        if (arg_is('list')) {
            $users = ORM::for_table('users')->find_many();
            foreach ($users as $key => $user) {
                foreach ($user->as_array() as $column => $value) {
                    echo $value."\t";
                }
                echo "\n";
            }
            echo "\n";
        }

    }

    echo "\033[0m\n";