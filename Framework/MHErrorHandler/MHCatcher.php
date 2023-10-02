<?php

namespace MetaHubFramework\ErrorHandler {

    class MHCatcher
    {
        private $tableau;
        private $level;

        public function __construct($tableau,$level){
            $this->tableau = $tableau;
            $this->level = $level;
        }

        public function getTableau()
        {
            return $this->tableau;
        }

        public function setTableau($tableau): void
        {
            $this->tableau = $tableau;
        }

        public function sort($tableau)
        {

        }

        public function getLevel()
        {
            return $this->level;
        }

        public function setLevel($level): void
        {
            $this->level = $level;
        }
    }
}