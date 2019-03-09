<?php

    class form_user {

        /**
         * get forms belonging to user
         *
         * @param int $user_id
         * @return ORM - form model
         */
        static public function getForms($user_id)
        {
            return ORM::for_table('form_user')->join('forms', ['form_user.form_id', '=', 'forms.id'])->where('user_id', $user_id)->find_many();
        }

        /**
         * get users belonging to form
         *
         * @param int $form_id
         * @return ORM - user model
         */
        static public function getUsers($form_id)
        {
            return ORM::for_table('form_user')->join('users', ['form_user.user_id', '=', 'users.id'])->where('form_id', $form_id)->find_many();
        }

        /**
         * assign form_user relationship
         *
         * @param int $form_id
         * @param int $user_id
         * @return boolean - returns false when combination already exists
         */
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

        /**
         * unassign form_user relationship
         *
         * @param int $form_id
         * @param int $user_id
         * @return boolean
         */
        static public function divorce($form_id, $user_id)
        {
            $record = self::get($form_id, $user_id);
            if (!$record) {
                return false;
            } else {
                return $record->delete();
            }
        }

        /**
         * check if form_user combination exists
         *
         * @param int $form_id
         * @param int $user_id
         * @return boolean
         */
        static public function has($form_id, $user_id)
        {
            $record = self::get($form_id, $user_id);
            if ($record) {
                return $record;
            } else {
                return false;
            }
        }

        static public function get($form_id, $user_id)
        {
            return ORM::for_table('form_user')->where([
                'form_id' => $form_id,
                'user_id' => $user_id
            ])->find_one();
        }

    }