<?php

    class layoutScripts {

        static protected $scripts;

        static public function init()
        {
            self::$scripts = [];
        }

        /**
         * add script
         *
         * @param string $type - type of script
         * @param string $script - script code
         * @return void
         */
        static public function add($type, $script)
        {
            if (!is_array(self::$scripts[$type])) {
                self::$scripts[$type] = [];
            }
            self::$scripts[$type][] = $script;
        }

        /**
         * output script type
         * can be safely used even if it is unknown whether any code is defined
         *
         * @param string $type - what type of script to load
         * @param string $open_tag - prepended to each script
         * @param string $closing_tag - appended to each script
         * @return string output if items are found
         * @return boolean if no scripts could be found
         */
        static public function output($type, $open_tag, $closing_tag)
        {
            if (is_array(self::$scripts) && isset(self::$scripts[$type]) && is_array(self::$scripts[$type])) {
                $output = "\n";
                foreach (self::getType($type) as $key => $script) {
                    $output .= $open_tag . "\n" . $script . "\n" . $closing_tag . "\n";
                }
                return $output;
            } else {
                return false;
            }
        }

        static public function getType($type)
        {
            return self::$scripts[$type];
        }

    }

    layoutScripts::init();