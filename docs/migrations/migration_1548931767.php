<?php

    function migration_1548931767() {
        return DB::createTable('forms', [
            'id' => 'INT AUTO_INCREMENT NOT NULL',
            'public_id' => 'varchar(32) NOT NULL UNIQUE',
            'validation_rules' => 'TEXT',
            'created_at' => 'DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);
    }

?>