<?php

namespace controls;
use const App\Controllers\VIEWS;

class Controller
{
    private $outputData;

    public function __construct($outputData)
    {
        $this->outputData = $outputData;
    }
}