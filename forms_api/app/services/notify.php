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

        static public function callHooks($formData, $methodsArray) {
            if (is_array($methodsArray)) {
                $canary = true;
                foreach ($methodsArray as $method => $value) {
                    $result = self::via($method)->hook($formData, $value);
                    if (!$result) {
                        $canary = false;
                    }
                }
                return $canary;
            } else {
                return false;
            }
        }

    }

    notify::init();