<?php

class Autoloader {

    /**
     * @return void
     */
    static function register() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * @param $class
     * @return void
     */
    static function autoload($class) {
        $paths = [
            __DIR__ . '/../routes/' . str_replace('\\', '/', $class) . '.php',
            __DIR__ . '/../modules/views/' . str_replace('\\', '/', $class) . '.php',
            __DIR__ . '/../modules/entities/' . str_replace('\\', '/', $class) . '.php',
            __DIR__ . '/../modules/models/' . str_replace('\\', '/', $class) . '.php',
            __DIR__ . '/../modules/controllers/' . str_replace('\\', '/', $class) . '.php',
            __DIR__ . '/../src/' . str_replace('\\', '/', $class) . '.php'
        ];

        foreach ($paths as $file) {

            if (file_exists($file)) {
                require $file;
                return;
            }
        }
    }
}


