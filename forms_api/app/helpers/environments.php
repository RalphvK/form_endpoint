<?php

    class environment {

        static public function is($name) {
            return $_ENV['ENVIRONMENT'] == $name;
        }

    }