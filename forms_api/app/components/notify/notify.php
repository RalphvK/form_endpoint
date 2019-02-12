<?php

    class notify {

        protected static $methods;

        static public function init() {
            self::$methods = [];
            includeFolder(path::this('notifiers'));
        }

        static public function register($key, $className) {
            self::$methods[$key] = $className;
            return self::$methods[$key];
        }

        static public function via($key) {
            return new self::$methods[$key];
        }

        /**
         * callHooks function
         * function to be called upon form submission, using the methodsArray from the notifiers column in de forms table
         *
         * @param array $formData
         * @param array $methodsArray
         * @return boolean
         */
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