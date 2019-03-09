<?php

    use Rakit\Validation\Validator;

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
            $user = ORM::for_table('users')->where('id', $request->user_id)->find_one();
            if ($user) {
                // render view
                $service->user = $user;
                $service->url = htmlspecialchars('/user/'.$user->id);
                $service->navbarButton = new stdClass();
                $service->navbarButton->text = "Save";
                $service->navbarButton->icon = "ion-ios-save";
                $service->navbarButton->class = "btn-danger";
                $service->navbarButton->action = "javascript:;";
                $service->navbarButton->method = "PUT";
                $service->navbarButton->onsubmit = "submitEditForm('".$service->url."')";
                $service->title = 'Edit user: '.$user->name;
                $service->render(path::component('users', 'views/read.php'));
            } else {
                return json_file([
                    'error' => 'not_found',
                    'error_message' => 'User could not be found.'
                ], 'error');
            }
        }

        static public function update($request)
        {
            // validation rules
            $rules = (include path::component('users', 'validation_rules.php'));
            // then validate
            $validator = new Validator;
            $validation = $validator->validate($_POST, $rules);

            if ($validation->fails()) {
                // return errors
                return json_file($validation->errors(), 'error');
                exit;
            }

            // get current user
            $user = ORM::for_table('users')->where('id', $request->user_id)->find_one();
            $dirty = false; // dirty flag
            // update name
            if (isset($_POST['name'])) {
                $user->name = $_POST['name'];
                $dirty = true;
            }
            // update email
            if (isset($_POST['email']) && $_POST['email'] !== $user->email) {
                if (auth::isUnique('email', $_POST['email'])) {
                    $user->email = $_POST['email'];
                    $dirty = true;
                } else {
                    return json_file([
                        'error' => 'email_not_unique',
                        'error_message' => 'This is email address already has an account associated with it.'
                    ], 'error');
                }
            }
            // update password
            if (isset($_POST['new_password'])) {
                $user->password = crypto::hash($_POST['new_password']);
                $dirty = true;
            }
            // save to DB
            if ($dirty) {
                if ($user->save()) {
                    return json_file([
                        'name' => $user->name,
                        'email' => $user->email
                    ], 'success');
                } else {
                    return json_file([
                        'error' => 'unknown_error',
                        'error_message' => 'An unknown error occurred! Please try again, or send an email to the emailadres listed in the contact section of this website.'
                    ], 'error');
                }
            }
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
                if (isset($_POST['_redirect']) && $_POST['_redirect'] == 'true') {
                    redirect::relative('/users');
                } else {
                    return json_file([], 'success');
                }
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
