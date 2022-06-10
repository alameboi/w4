<?php

class Autoloader {
    private $ROOT = '/var/www/html/';

    public static function register() {
        spl_autoload_register(function ($class) {
            if (class_exists($class, false))
                return true;
        
            $fileNames = [
                $ROOT . substr('classes/ ', 0, -1) .  $class . '.php',
                $ROOT . substr('controllers/ ', 0, -1) .  $class . '.php',
                $ROOT . substr('models/ ', 0, -1) .  $class . '.php',
            ];

            foreach ($fileNames as $fileName) {
                if (file_exists($fileName)) {
                    require $fileName;
                    return true;
                }
            }
        });
    }
}

Autoloader::register();