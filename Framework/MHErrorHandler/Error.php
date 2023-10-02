<?php

namespace Framework\ErrorHandler;

class Error implements Throwable
{
    private $message;
    private $code;
    private $file;
    private $line;
    private $niveau;
    private $description;

    public function __construct($message = "", $code = 0)
    {

    }

    private function getMessage()
    {
    }


    private function getCode()
    {

    }
    private function getFile()
    {

    }
    private function getLine()
    {

    }
    private function getTraceAsString()
    {

    }
    private function toString()
    {

    }
    private function clone()
    {

    }
    public function getDescription(): string
    {
        return $this->description;
    }

    public function getNiveau(): int
    {
        return $this->niveau;

    }
}