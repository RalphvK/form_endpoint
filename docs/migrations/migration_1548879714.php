<?php

    function migration_1548879714() {
        DB::createTable('messages', [
            'id' => 'INT AUTO_INCREMENT NOT NULL',
            'form_id' => 'INT NOT NULL',
            'from' => 'varchar(254) NOT NULL',
            'content' => 'TEXT NOT NULL',
            'ip' => 'varchar(45)',
            'created_at' => 'DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);
        return true;
    }

?>