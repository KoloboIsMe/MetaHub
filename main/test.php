<?php

use Database\UserDatabaseTest;

require_once('Framework/Database/UserDatabase.php');

$userDB = new UserDatabaseTest();

$users = $userDB->selectFromUsername('myke');
if (count($users) > 0) {
    foreach ($users as $user) {
        echo $user->getPassword() . "<br>";
    }
}


//$maxTam = new \Entity\User(null, 'azertyiop', null, 'maxTam2', '2023-08-16', '2023-09-16');
//$userDB->insert($maxTam);
?>