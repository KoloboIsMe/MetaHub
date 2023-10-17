<?php
include '../Framework/Database/DataBaseConnexion.php';
include '../Framework/Database/UserDatabase.php';
include '../Framework/Entity/User.php';
session_start();
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username !== "" && $password !== "") {
        $user = \Framework\Database\UserDatabase::getInstance()->selectByUsername($username);
        if (sizeof($user) > 0) {
            if (password_verify($password, $user[0]->getPassword())) //verification si le nom d'utilisateur existe et si le mot de passe est correct
            {
                $_SESSION['user'] = $user[0];
                $_SESSION['admin'] = $user[0]->getAdmin();
                $_SESSION['username'] = $user[0]->getUsername();
                \Framework\Database\UserDatabase::getInstance()->updateLastConnexion($_SESSION['user'], date("Y-m-d"));
                header('Location: ../View/principal.php');
            }
            else {
                header('Location: ../View/login.php?erreur=1'); // mot de passe incorrect
            }
        } else {
            header('Location: ../View/login.php?erreur=1'); // nom d'utilisateur incorrect
        }
    } else {
        header('Location: ../View/login.php?erreur=2'); // utilisateur ou mot de passe vide
    }
} else {
    header('Location: ../View/login.php');
}

?>