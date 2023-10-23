<?php

namespace Autoloader;

//use MHErrorHandler\MHException;
//
//class Autoloader
//{
//    public function __construct ()
//    {
//        $this->singletons();
//    }
//
//    public function load(string|Stringable $directory)
//    {
//        // IF directory is absolute, let it that way.
//        // ELSE, make it absolute
//        while (true) {
//            $file = $directory . ""; // Select a file
//            try
//            {
//                require $file;
//            }
//            catch (MHException $exception)
//            {
//                $catcher->catch($exception);
//            }
//        }
//
//    }
//
//    public function singletons() {
//        $GLOBALS['catcher'] = new \Catcher();
//        // ...
//    }
//}

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
            if (file_exists($file)) {
                require $file;
                echo "Loaded ". $file;
                return true;
            }
            return false;
        });
    }
}
Autoloader::register();