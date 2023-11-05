<?php

global $userTable;

if(!isset($user, $password))
{
    return;
}

// TODO : ENCODE PASSWORD

if (!$userTable->login($user, $password))
{
    $error = 'erreur';
}

//update last connexion

return;