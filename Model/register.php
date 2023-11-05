<?php
global $userTable;

if(!isset($user, $password))
{
    return;
}

// TODO : ENCODE PASSWORD

if (!$userTable->register($user, $password))
{
    $error = 'Erreur lors de la création du compte';
}

return;