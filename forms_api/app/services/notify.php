<?php

    class notify extends service {

        protected static $methods;

        static public function init() {
            self::$methods = [];
            self::includeAll('notifiers');
        }

        static public function register($key, $className) {
            self::$methods[$key] = $className;
            return self::$methods[$key];
        }

        static public function via($key) {
            return new self::$methods[$key];
        }

    }

    notify::init();