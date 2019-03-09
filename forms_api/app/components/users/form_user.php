<?php

    class form_user {

        static public function get($form_id, $user_id)
        {
            return ORM::for_table('form_user')->where([
                'form_id' => $form_id,
                'user_id' => $user_id
            ])->find_one();
        }

        static public function has($form_id, $user_id)
        {
            $record = self::get($form_id, $user_id);
            if ($record) {
                return true;
            } else {
                return false;
            }
        }
        
        static public function marry($form_id, $user_id)
        {
            try {
                $record = ORM::for_table('form_user')->create();
                $record->form_id = $form_id;
                $record->user_ID = $user_id;
                return $record->save();
            } catch (Exception $e) {
                return false; // probably a duplicate
            }
        }

        static public function divorce($form_id, $user_id)
        {
            $record = self::get($form_id, $user_id);
            if (!$record) {
                return false;
            } else {
                return $record->delete();
            }
        }

    }