<?php
include '../Framework/Database/DataBaseConnexion.php';
include '../Framework/Database/UserDatabase.php';
include '../Framework/Entity/User.php';
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    //hashage du mot de passe pour le mettre dans la base de données
    $password = password_hash($password, PASSWORD_DEFAULT);

    $user = new \Framework\Entity\User(null, $username, $password, date("Y-m-d"), null);
    \Framework\Database\UserDatabase::getInstance()->insert($user);

    echo "user inserted";
}