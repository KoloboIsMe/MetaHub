<?php

$page = $_GET['id'] ?? $page = null;
require '../../Model/login.php';
if (isset($error)){
    $page ? $redirect = 'login&id='.$page : $redirect = 'login';
    $url = 'error';
}else{
    $url = '/';
    $page ?  header("refresh:0;url=/$page") : header("refresh:0;url=/");
}

$_SESSION['isLogged'] = true;
$_SESSION['username'] = $user->getUsername();
$_SESSION['user_ID'] = $user->getUser_ID();
$_SESSION['level'] = $user->getLevel();

// Update last connexion date

return;