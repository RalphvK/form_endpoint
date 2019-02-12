<?php

    class auth {

        static public function checkCredentials($email, $password)
        {
            $user = ORM::for_table('users')->where('email', $email)->find_one();
            if ($user) {
                return crypto::checkPassword($password, $user->password);
            } else {
                return false;
            }
        }

        /**
         * set session variables for login
         *
         * @param object $user - ORM object
         * @return boolean $_SESSION['loggedIn']
         */
        static public function loginSession($user)
        {
            // setting session variables
            $_SESSION['loggedIn'] = true;
            $_SESSION['userID'] = $user->id;
            $_SESSION['name'] = $user->name;
            // setting last login
            $user->last_login = self::timestamp();
            $user->save();
            // returning saved value
            return $_SESSION['loggedIn'];
        }

        static public function updateSession($user)
        {
            $_SESSION['userID'] = $user->id;
            $_SESSION['name'] = $user->name;
        }

        static public function logoutSession()
        {
            session_unset();
            session_destroy();
        }

        /**
         * register new user
         *
         * @param string $name
         * @param string $email - must be unique
         * @param string $password - unhashed password string
         * @return void
         */
        static public function register($name, $email, $password)
        {
            // check if email is unique
            if (ORM::for_table('users')->where('email', $email)->count() > 0) {
                throw new Exception('Email address already registered.');
                return false;
            }
            // else register new user
            $user = ORM::for_table('users')->create();
            $user->name = $name;
            $user->email = $email;
            $user->password = crypto::hash($password);
            $user->save();
            $user->id = $user->id();
            return $user;
        }

        static public function timestamp()
        {
            return date("Y-m-d H:i:s");
        }

    }