<?php

use MHErrorHandler\ExceptionType;

class Catcher
{
    private $exceptions;

    public function __construct()
    {
        $this->exceptions = array();
    }
    public function exception($message = "Undefined Exception", $level = 0,$type = ExceptionType::Exception)
    {
        switch ($type)
        {
            case ExceptionType::Exception :
                $this->exceptions[] = new Exception($message, $level);
        }
    }
    public function __toString(): string
    {
        $returnString = "";
        if (is_null($this->exceptions))
        {
            $returnString =  "No catched errors";
        }
        foreach ($this->exceptions as $exception)
        {
            $returnString .= $exception . "\n";
        }
        return $returnString;
    }
}
