<?php

    class service {

        static public function includeAll($plural = false) {
            $path = $plural ? path::app('services/'.$plural) : path::app('services/'.static::class.'s');
            includeFolder($path);
        }

    }