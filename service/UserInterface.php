<?php

namespace service;

interface UserInterface
{

    public function getUserByUsername($username);

    public function getUserById($id);

    public function getUsersUsername();

    public function isUser($login, $password);

    public function register($username, $password, $date);

    public function getPostsIdByUserId($id);
}