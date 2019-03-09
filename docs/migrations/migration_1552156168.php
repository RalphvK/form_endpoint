<?php

    function migration_1552156168() {
        $flag = true;
        // add whitelist column
        $sql = "CREATE UNIQUE INDEX form_user_combination ON form_user (form_id, user_id);";
        if (DB::conn()->exec($sql) !== 0) {
            $flag = false;
        }
        return $flag;
    }

?>