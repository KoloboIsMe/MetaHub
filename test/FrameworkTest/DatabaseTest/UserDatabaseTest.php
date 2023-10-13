<?php

namespace DatabaseTest;

require "main/Framework/Database/UserDatabase.php";

use PHPUnit\Framework\TestCase;

class UserDatabaseTest extends TestCase
{
    public function testSelect()
    {
        $userDB = new UserDatabase();
        $users = $userDB->selectFromUsername('myke');
        $this->assertEquals(count($users), 1);
    }
    public function testDelete()
    {
        $a = 1;
        $this->assertEquals($a, 1);
    }
}