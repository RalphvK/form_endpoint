<?php

    class formController {

        static public function index($request)
        {
            $forms = ORM::for_table('forms')->find_many();
            if ($forms) {
                $output = [];
                foreach ($forms as $key => $form) {
                    $output[] = $form->as_array();
                }
                return json_file($output);
            } else {
                return json_file([
                    'error' => 'not_found',
                    'error_message' => 'No forms were found.'
                ], 'error');
            }
        }

        static public function create($request)
        {
            // create new form
        }

        static public function read($request)
        {
            // get single form
        }

        static public function update($request)
        {
            // edit form
        }

        static public function delete($request)
        {
            // delete form
        }

    }