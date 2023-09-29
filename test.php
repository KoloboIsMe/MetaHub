<?php

use Database\UserDatabase;

require_once('Framework/Database/UserDatabase.php');

echo 'Test de la classe UserDatabase<br>';
$userDB = new UserDatabase();
$user1 = $userDB->testRequest();
echo '<br>Test de la méthode selectFromUser<br>';
$user1->showData();
?>