<?php

    class path {

        static protected $openComponent;

        /**
         * path to app/ folder
         *
         * @param string $path
         * @return string
         */
        static public function app($path) {
            return __DIR__.'/../'.$path;
        }

        /**
         * set or get openComponent
         *
         * @param string $name
         * @return string self::$openComponent
         */
        static public function openComponent($name = null) {
            if ($name) {
                self::$openComponent = $name;
            }
            return self::$openComponent;
        }

        // unsets openComponent
        static public function closeComponent() {
            self::$openComponent = null;
        }

        /**
         * path within current component folder
         *
         * @param string $path
         * @return string
         */
        static public function this($path) {
            return self::component(self::$openComponent, $path);
        }

        /**
         * path in given component's folder
         *
         * @param string $component - name of component folder
         * @param string $path - path after components/<name>/, defaults to "index.php"
         * @return string
         */
        static public function component($component, $path = "index.php") {
            return __DIR__.'/../components/'.$component.'/'.$path;
        }

    }