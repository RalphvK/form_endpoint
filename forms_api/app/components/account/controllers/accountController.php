<?php

    use Rakit\Validation\Validator;

    class accountController {

        static public function read($request, $response, $service)
        {
            $user = ORM::for_table('users')->where('id', $_SESSION['userID'])->find_one();
            if ($user) {
                // render view
                $service->user = $user;
                $service->navbarButton = new stdClass();
                $service->navbarButton->text = "Save";
                $service->navbarButton->icon = "ion-ios-save";
                $service->navbarButton->class = "btn-danger";
                $service->navbarButton->action = "javascript:;";
                $service->navbarButton->method = "PUT";
                $service->navbarButton->onsubmit = "submitEditForm('/account')";
                $service->title = 'Account Settings';
                $service->render(path::component('account', 'views/read.php'));
            } else {
                // run authentication logic again
                auth::updateSession();
                auth::protect();
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
            $user = ORM::for_table('users')->where('id', $_SESSION['userID'])->find_one();
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
            if (isset($_POST['old_password'])) {
                if (auth::checkCredentials($user->email, $_POST['old_password'])) {
                    $user->password = crypto::hash($_POST['new_password']);
                    $dirty = true;
                } else {
                    return json_file([
                        'error' => 'password_incorrect',
                        'error_message' => 'Please provide your current password.'
                    ], 'error');
                }
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

    }