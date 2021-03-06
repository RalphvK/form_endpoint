<?php

    class formsController {

        static public function getForm($public_id) {
            $form = ORM::for_table('forms')->where('public_id', $public_id)->find_one();
            if ($form) {
                // set CORS headers
                CORS::setHeaders($form->whitelist);
                // return object
                $form->validation_rules = json_decode($form->validation_rules, true);
                $form->notifiers = json_decode($form->notifiers, true);
                return $form; // decode to array
            } else {
                return false;
            }
        }

        static public function insert($fields = []) {
            $defaults = ["validation_rules" => "{}", "whitelist" => "", "notifiers" => "{}"];
            $fields = array_merge($defaults, $fields);
            // generate id
            $public_id = generate::form_id();
            // check if public_id already exists, generate new if not unique
            while (ORM::for_table('forms')->where('public_id', $public_id)->count() > 0) {
                $public_id = generate::form_id();
            }
            // check if name is set
            if (!isset($fields['name'])) {
                $fields['name'] = $public_id;
            }
            // insert new record
            $form = ORM::for_table('forms')->create();
            $form->public_id = $public_id;
            $form->name = $fields['name'];
            $form->validation_rules = $fields['validation_rules'];
            $form->whitelist = $fields['whitelist'];
            $form->notifiers = $fields['notifiers'];
            $form->save();
            return $form;
        }

    }

?>