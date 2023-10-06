<?php

namespace MetaHubFramework\ErrorHandler {

    use MHErrorHandler\ExceptionType;

    class MHCatcher
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
                    $this->errors[] += new MHException($message, $level);
            }

        }
    }
}