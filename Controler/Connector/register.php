<?php

$page = $_GET['id'] ?? $page = null;
require '../Model/register.php';
if (isset($error)){
    $url = 'register';
}else
    $url = 'login_verification';