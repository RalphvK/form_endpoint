<?php

    use Rakit\Validation\Validator;
    require path::app('controllers/formsController.php');

    class messageController {

        static public function post($request) {
            // get rules from database
            $form = formsController::getForm($request->form_id);
            $rules = $form->validation_rules;
            if (!$rules) {
                // return error
                return json_file([
                    'error' => 'form_not_found',
                    'error_message' => 'This form could not be found.'
                ], 'error');
            }
            // validate
            $validator = new Validator;
            $validation = $validator->validate($_POST, $rules);

            if ($validation->fails()) {
                // return errors
                return json_file($validation->errors()->firstOfAll(), 'error');
            } else {
                if (self::insertMessage($request->form_id, $_POST)) {
                    // send success response
                    $response = json_file_expedite([], 'success');
                    // notify
                    notify::callHooks($_POST, $form->notifiers);
                    // return response
                    return $response;
                } else {
                    return json_file([
                        'error' => 'unknown_error',
                        'error_message' => 'An unknown error occurred! Please try again, or send an email to the emailadres listed in the contact section of this website.'
                    ], 'error');
                }
            }
        }

        static public function insertMessage($form_id, $fields) {
            $message = ORM::for_table('messages')->create();
            
            $message->form_id = $form_id;
            $message->from = isset($fields['email']) ? $fields['email'] : 'unknown';
            $message->content = json_encode($fields);
            $message->ip = $_SERVER['REMOTE_ADDR'];

            return $message->save();
        }

    }

?>