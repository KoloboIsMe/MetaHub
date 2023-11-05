<?php
global $userTable;

if(!isset($user, $password))
{
    return;
}

// TODO : ENCODE PASSWORD

if (!$userTable->register($user, $password))
{
    $error = 'Les mots de passe ne correspondent pas';
}