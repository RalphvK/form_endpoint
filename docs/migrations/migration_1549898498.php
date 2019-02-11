<?php

    function migration_1549898498() {
        $flag = true;
        // add whitelist column
        $sql = "ALTER TABLE forms ADD COLUMN notifiers TEXT NULL AFTER validation_rules;";
        if (DB::conn()->exec($sql) !== 0) {
            $flag = false;
        }
        return $flag;
    }

?>