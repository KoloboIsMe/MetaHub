<?php

use MHErrorHandler\ExceptionType;

class Catcher
{
    public function __construct(private array $exceptions = array())
    {

    }
    public function catch($message = "Undefined Exception", $code = 0, $type = ExceptionType::Exception, Throwable $previous = null)
    {
        switch ($type)
        {
            case ExceptionType::Exception :
                $this->exceptions[] = new MHException($message, $code, $previous);
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
