<?php

    use Rakit\Validation\Validator;
    require path::app('controllers/formsController.php');

    class formController {

        static public function post($request) {
            // get rules from database
            $rules = formsController::getRules($request->form_id);
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
                    // return success
                    return json_file([], 'success');
                } else {
                    return json_file([
                        'error' => 'unknown_error',
                        'error_message' => 'An unknown error occurred! Please try again, or send an email to the emailadres listed in the contact section of this website.'
                    ], 'error');
                }
            }
        }

        static public function insertMessage($form_id, $fields) {
            // prepare query
            $stmt = DB::conn()->prepare('INSERT INTO messages (`form_id`, `from`, `content`, `ip`) VALUES (:form_id, :from, :content, :ip)');
            return $stmt->execute([
                'form_id' => $form_id,
                'from' => isset($fields['email']) ? $fields['email'] : 'unknown',
                'content' => json_encode($fields),
                'ip' => $_SERVER['REMOTE_ADDR']
            ]);
        }

    }

?>