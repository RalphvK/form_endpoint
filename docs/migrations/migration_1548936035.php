<?php

    function migration_1548936035() {
        $flag = true;
        // make form_id varchar
        $sql = "ALTER TABLE messages MODIFY `form_id` varchar(32) NOT NULL;";
        if (DB::conn()->exec($sql) !== 0) {
            $flag = false;
        }
        // make from not required
        $sql = "ALTER TABLE messages MODIFY `from` varchar(254) NULL;";
        if (DB::conn()->exec($sql) !== 0) {
            $flag = false;
        }
        return $flag;
    }

?>