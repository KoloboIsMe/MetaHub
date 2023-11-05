<?php
global $userTable;

if(!isset($user, $password))
{
    return;
}

// TODO : ENCODE PASSWORD

$userTable->register($user, $password);