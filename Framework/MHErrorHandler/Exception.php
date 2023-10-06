<?php

class Exception implements Throwable
    {
        private $message;
        private $level;
        private $time;

        public function __construct($message ="Undefined Error", $level = 0)
        {
            $this->message = $message;
            $this->level = $level;
            $this->time = date("Y-m-d H:i:s", time());
        }
    }