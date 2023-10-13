<?php

use Database\UserDatabase;

require_once('Framework/Database/UserDatabase.php');

$userDB = new \Framework\Database\UserDatabase\UserDatabase();


$users = $userDB->selectFromUsername('myke3');
if (count($users) > 0) {
    foreach ($users as $user) {
        echo $user->getUsername() . "<br>";
    }
}echo "pas de user";

//$maxTam = new \EntityTest\User(null, 'azertyiop', null, 'maxTam2', '2023-08-16', '2023-09-16');
//$userDB->insert($maxTam);
?>