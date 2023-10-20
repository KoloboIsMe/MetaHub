<?php

namespace service;
class OutputData
{
    protected $outputData;

    public function __destruct()
    {
        $this->outputData = null;
    }

    public function getOutputData()
    {
        return $this->outputData;
    }

    public function setOutputData($outputData)
    {
        $this->outputData = $outputData;
    }
}