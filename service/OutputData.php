<?php

namespace service;

class OutputData
{
    protected $outputData;

    public function __destruct()
    {
        $this->outputData = null;
    }

    public function setOutputData($data)
    {
        $this->outputData = $data;
    }

    public function getOutputData()
    {
        return $this->outputData;
    }


}