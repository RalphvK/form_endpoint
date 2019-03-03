<?php

    class userController {

        static public function index($request, $response, $service)
        {
            $users = ORM::for_table('users')->find_many();
            // render view
            $service->users = $users;
            $service->title = 'Users';
            $service->render(path::component('users', 'views/index.php'));
        }

        static public function create($request)
        {
            $user = false;
            try {
                $user = auth::register($_POST['name'], $_POST['email'], $_POST['password']);
            } catch (Exception $e) {
                // email not unique
                if ($e->getMessage() == 'Email address already registered.') {
                    return json_file([
                        'error' => 'email_not_unique',
                        'error_message' => 'This is email address already has an account associated with it.'
                    ], 'error');
                } else {
                    return self::unknownError();
                }
            }
            if ($user) {
                return json_file([
                    'name' => $user->name,
                    'email' => $user->email
                ], 'success');
            } else {
                return self::unknownError();
            }
        }

        static public function read($request, $response, $service)
        {

        }

        static public function update($request)
        {

        }

        static public function delete($request)
        {
            $user = ORM::for_table('users')->where('id', $request->user_id)->find_one();
            if (!$user) {
                return json_file([
                    'error' => 'not_found',
                    'error_message' => 'User could not be found.'
                ], 'error');
            }
            if ($user->delete()) {
                return json_file([], 'success');
            } else {
                return self::unknownError();
            }
        }

        static public function unknownError()
        {
            return json_file([
                'error' => 'unknown_error',
                'error_message' => 'An unknown error occurred! Please try again, or send an email to the emailadres listed in the contact section of this website.'
            ], 'error');
        }

    }
