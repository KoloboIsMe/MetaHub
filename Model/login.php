<?php
global $userTable;

if(!isset($user, $password))
{
    return;
}

// TODO : ENCODE PASSWORD

$userTable->login($user, $password);