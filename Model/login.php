<?php
global $userTable;

if(!isset($user, $password))
{
    return;
}

// TODO : ENCODE PASSWORD

if (!$userTable->login($user, $password))
{
    $error = 'Mauvais identifiant ou mot de passe';
}

return;