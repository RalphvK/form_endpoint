<?php

    /*
    Include all php files in folder
    */
    function includeFolder($path, $file = '*.php') {
        foreach (glob($path.'/'.$file) as $filename)
        {
            include $filename;
        }
    }