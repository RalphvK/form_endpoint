<?php

    function migration_1550005302() {
        $flag = true;
        // add whitelist column
        $sql = "ALTER TABLE users ADD COLUMN last_login TIMESTAMP NULL;";
        if (DB::conn()->exec($sql) !== 0) {
            $flag = false;
        }
        return $flag;
    }

?>