<?php

    function migration_1550484329() {
        $flag = true;
        // add whitelist column
        $sql = "ALTER TABLE forms ADD COLUMN name VARCHAR(128) NULL AFTER id;";
        if (DB::conn()->exec($sql) !== 0) {
            $flag = false;
        }
        return $flag;
    }

?>