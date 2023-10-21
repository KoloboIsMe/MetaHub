<?php

interface UserInterface{

        public function getUserById($id);
        public function isUser($login, $password);

        public function register($username, $password, $date);
}