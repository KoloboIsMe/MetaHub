<?php

$username = $_POST['username'];
$password = $_POST['password'];

require __DIR__ . '/../../Model/register.php';

if (isset($error)){
    $page = 'register';
    require 'display.php';
    return;
}

return;