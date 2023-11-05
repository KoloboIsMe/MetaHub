<?php

if(!isset($user, $password))
{
    return;
}

$username = $_POST['username'];
$password = $_POST['password'];
require __DIR__ . '/../../Model/login.php';

if (isset($error)){
    return;
}

$_SESSION['isLogged'] = true;
$_SESSION['username'] = $user->getUsername();
$_SESSION['user_ID'] = $user->getUser_ID();
$_SESSION['level'] = $user->getLevel();

return;