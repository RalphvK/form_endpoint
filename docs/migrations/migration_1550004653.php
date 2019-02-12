<?php

    function migration_1550004653() {
        return DB::createTable('users', [
            'id' => 'INT AUTO_INCREMENT NOT NULL',
            'name' => 'varchar(100)',
            'email' => 'varchar(255)',
            'password' => 'varchar(255)',
            'created_at' => 'DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);
    }

?>