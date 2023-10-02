<?php

namespace MetaHubFramework\ErrorHandler {

    class MHException
    {
        private $message;
        private $code;
        private $file;
        private $line;
        private $description;
        private $time;

        public function __construct($message, $code, $file, $line, $description, $time)
        {
            $this->message = $message;
            $this->code = $code;
            $this->file = $file;
            $this->line = $line;
            $this->description = $description;
            $this->time = $time;
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

        public function getTime()
        {
            $t = time();
            echo(date("Y-m-d H:i:s", $t));
            return $this->time;
        }
}
}