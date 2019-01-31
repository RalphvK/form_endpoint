<?php

    use Rakit\Validation\Validator;

    class formController {

        static public function post($request) {
            // validate
            $validator = new Validator;
            $validation = $validator->validate($_POST, [
                'name'                  => 'required|max:200',
                'company'               => 'max:200',
                'email'                 => 'required|email',
                'phone'                 => 'max:50',
                'message'              => 'required|max:50000'
            ]);

            if ($validation->fails()) {
                // return errors
                return json_file($validation->errors()->firstOfAll(), 'error');
            } else {
                // return success
                return json_file([], 'success');
            }
        }

    }

?>