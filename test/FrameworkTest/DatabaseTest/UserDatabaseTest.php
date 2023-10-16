<?php

namespace DatabaseTest;
use Framework\Database\UserDatabase;
use PHPUnit\Framework\TestCase;

require 'Framework/Database/UserDatabase.php';


class UserDatabaseTest extends TestCase
{
    public function testSelect()
    {
        $userDB = new UserDatabase();
        $user = $userDB->getTest();
        $this->assertEquals("test", $user);
    }
}