<?php

namespace service;

interface UserInterface
{
    public function existsUsername($username);
    public function existsUser($user_ID);
    public function getUserByUsername($username);

    public function getUsersUsername();

    public function isUser($login, $password);

    public function register($username, $password, $date);
    public function updateUser($username, $password, $user_ID);
    public function updateLastConnexion($user_ID);
    public function getUserById($id);
    public function getUsersID();
    public function getPostsIdByUserId($userId);
}