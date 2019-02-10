<?php

    class environment {

        static public function is($name) {
            return $_ENV['environment'] == $name;
        }

    }