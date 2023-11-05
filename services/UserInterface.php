<?php

namespace services;

interface UserInterface
{
    public function existsUsername($username);

    public function existsUser($user_ID);

    public function getUserByUsername($username);

    public function isUser($username, $password);

    public function register($username, $password, $date);

    public function updateUser($username, $password, $user_ID);

    public function updateLastConnexion($user_ID);

    public function getUserById($id);

    public function getUsersID();

    public function get10LastConnectedUsersID();

    public function setOnline($user_ID, $online);
}