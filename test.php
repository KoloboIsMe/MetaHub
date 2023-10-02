<?php

use Database\UserDatabase;

require_once('Framework/Database/UserDatabase.php');

$userDB = new UserDatabase();

$users = $userDB->selectByFirstConnexion('2023-08-16');
if (count($users) > 0) {
    foreach ($users as $user) {
        echo $user->getUsername() . "<br>";
    }
}

//$maxTam = new \Entity\User(null, 'azertyiop', null, 'maxTam2', '2023-08-16', '2023-09-16');
//$userDB->insert($maxTam);
?>