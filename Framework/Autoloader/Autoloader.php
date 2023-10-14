<?php

namespace Autoloader;

class Autoloader
{
    public function __construct ()
    {

    }

    public function load(string|Stringable $directory)
    {
        // IF directory is absolute, let it that way.
        // ELSE, make it absolute
        while (true) {
            $file = ""; // Select a file
            try
            {
                // Load the file
            }
            catch (\Exception $exception)
            {
                // Throw an error
            }
        }

    }

    public function singletons() {
        // Instanciate all singletons
    }
}