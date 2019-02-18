<?php

    class formController {

        static public function index($request, $response, $service)
        {
            $forms = ORM::for_table('forms')->find_many();
            if ($forms) {
                $output = $forms;
            } else {
                $output = 'No forms found.';
            }
            // render view
            $service->forms = $output;
            $service->render(path::component('admin', 'views/index.php'));
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