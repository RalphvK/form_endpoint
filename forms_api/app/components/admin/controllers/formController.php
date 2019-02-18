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
            $service->title = 'Form Endpoints';
            $service->render(path::component('admin', 'views/index.php'));
        }

        static public function create($request)
        {
            $insert = formsController::insert([
                'name' => filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)
            ]);
            redirect::relative('/admin/form/'.$insert->public_id);
        }

        static public function read($request, $response, $service)
        {
            $form = ORM::for_table('forms')->where('public_id', $request->public_id)->find_one();
            if ($form) {
                // pretty print json
                $form->validation_rules = prettify_json($form->validation_rules);
                $form->notifiers = prettify_json($form->notifiers);
            } else {
                $form = 'Form not found.';
            }
            // render view
            $service->form = $form;
            $service->navbarButton = new stdClass();
            $service->navbarButton->text = "Save";
            $service->navbarButton->icon = "ion-ios-save";
            $service->navbarButton->class = "btn-danger";
            $service->navbarButton->action = "javascript:;";
            $service->navbarButton->method = "PUT";
            $service->navbarButton->onsubmit = "submitEditForm('/admin/form/$form->public_id')";
            $service->title = 'Edit Form';
            $service->render(path::component('admin', 'views/read.php'));
        }

        static public function update($request)
        {
            $form = ORM::for_table('forms')->where('public_id', $request->public_id)->find_one();
            // generic insert
            foreach ($_POST as $key => $value) {
                $form->$key = $value;
            }
            // override with sanitized vars
            $form->name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // push changes
            $form->save();
            // return success
            return json_file([], 'success');
        }

        static public function delete($request)
        {
            $form = ORM::for_table('forms')->where('public_id', $request->public_id)->find_one();
            $form->delete();
            redirect::relative('/admin');
        }

    }