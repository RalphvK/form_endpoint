<?php

    function json_file($data, $status = "success", $meta = null) {
        header('Content-Type: application/json');
        $output['status'] = $status; // status
        if ($meta) {
            $output = $output + $meta; // meta
        }
        $output['data'] = $data; // data
        return json_encode($output);
    }