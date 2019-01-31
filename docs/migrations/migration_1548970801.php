<?php

    function migration_1548970801() {
        $flag = true;
        // make form_id varchar
        $sql = "ALTER TABLE forms ADD COLUMN whitelist VARCHAR(256) AFTER validation_rules;";
        if (DB::conn()->exec($sql) !== 0) {
            $flag = false;
        }
        return $flag;
    }

?>