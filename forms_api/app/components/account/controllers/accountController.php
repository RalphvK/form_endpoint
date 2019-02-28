<?php

    class accountController {

        static public function read($request, $response, $service)
        {
            $user = ORM::for_table('users')->where('id', $_SESSION['userID'])->find_one();
            if ($user) {
                // render view
                $service->user = $user;
                $service->render(path::component('account', 'views/read.php'));
            } else {
                // run authentication logic again
                auth::updateSession();
                auth::protect();
            }
        }

        static public function update($request)
        {
            
        }

    }