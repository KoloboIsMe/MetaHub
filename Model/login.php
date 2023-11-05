<?php

global $userTable;

if(!isset($username, $password))
{
    return;
}

// TODO : ENCODE PASSWORD

if (!$userTable->login($username, $password))
{
    $error = 'erreur';
    return;
}

//update last connexion

$user = $userTable->find($username, 'username');

return;