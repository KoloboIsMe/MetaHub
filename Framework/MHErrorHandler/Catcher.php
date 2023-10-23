<?php

use MHErrorHandler\ExceptionType;

class Catcher
{
    public function __construct(private array $exceptions = array())
    {

    }
    public function catch(Throwable $exception)
    {
        $this->exceptions[] = $exception;
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
