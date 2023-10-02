<?php

namespace ErrorHandler;

class Exception implements Throwable
{
    private $message;
    private $code;
    private $file;
    private $line;
    private $level;
    private $description;
    private $time;

    public function __construct($message = "", $code = 0)
    {

    }

    public function getMessage()
    {
        return $this->message;
    }
    public function getCode()
    {
        return $this->code;
    }
    public function getFile()
    {
        return $this->file;
    }
    public function getLine()
    {
        return $this->line;
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function getLevel()
    {
        return $this->level;

    }

    public function getTime()
    {
        $t=time() ;
        echo(date("Y-m-d H:i:s",$t));
        return $this->time;
    }
}