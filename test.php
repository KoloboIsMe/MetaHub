<?php

use Database\UserDatabase;

require_once('Framework/Database/UserDatabase.php');

$userDB = new UserDatabase();
//echo $userDB->selectFromUser();
//$userDB->testRequest()->showData();
$users = $userDB->selectFromFirstConnexion('2023-09-04');
if (count($users) > 0) {
    foreach ($users as $user) {
        echo $user->getUsername() . "<br>";
    }
}
$users = $userDB->selectFromFirstConnexion('2023-09-04');
?>