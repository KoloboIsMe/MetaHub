<?php

use Database\UserDatabase;

require_once('Framework/Database/UserDatabase.php');

$userDB = new UserDatabase();

$users = $userDB->selectFromFirstConnexion('2023-08-16');
if (count($users) > 0) {
    foreach ($users as $user) {
        echo $user->getPassword() . "<br>";
    }
}

$maxTam = new \Entity\User(null, 'azerty', null, 'maxTam', '2023-08-16', '2023-09-16');
$userDB->insert($maxTam);
$uuuu = $userDB->selectFromUsername('maxTam');
$uuuu[0]->showData();
$users = $userDB->selectFromFirstConnexion('2023-09-04');
?>