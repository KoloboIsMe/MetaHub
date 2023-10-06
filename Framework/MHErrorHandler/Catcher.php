<?php

namespace MetaHubFramework\ErrorHandler {

    class Catcher
    {
        private $errors;

        public function __construct()
        {
            $this->errors = array();
        }
        public function exception($type, $message, $level)
        {
            switch ($type)
            {
                case ExceptionType::Exception :
                    $this->errors[] += new Exception($message, $level);
            }
        }
        public function __toString(): string
        {
            return "Je suis un Catcher";
        }
    }
}