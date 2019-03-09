<?php

    function migration_1552155378() {
        return DB::createTable('form_user', [
            'id' => 'INT AUTO_INCREMENT NOT NULL',
            'form_id' => 'INT',
            'user_id' => 'INT'
        ]);
    }

?>