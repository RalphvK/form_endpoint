<?php

    function migration_1552159517() {
        $flag = true;
        // add roles column
        $sql = "ALTER TABLE users ADD COLUMN roles VARCHAR(256) NULL AFTER `password`;";
        if (DB::conn()->exec($sql) !== 0) {
            $flag = false;
        }
        return $flag;
    }

?>