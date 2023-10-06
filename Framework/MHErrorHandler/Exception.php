<?php

namespace MHErrorHandler;

class Exception implements \MHErrorHandler\Throwable
    {
        private $message;
        private $level;
        private $time;

        public function __construct($message ="Undefined Exception", $level = 0)
        {
            global $categoryDatabase;
            $this->message = $message;
            $this->level = $level;
            $this->time = date("Y-m-d H:i:s", time());
        }
    }