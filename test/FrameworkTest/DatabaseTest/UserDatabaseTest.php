<?php

namespace DatabaseTest;
require 'Framework/Database/UserDatabase.php';


class UserDatabaseTest extends \PHPUnit\Framework\TestCase
{
    public function testSelect()
    {
        $userDB = new \Framework\Database\UserDatabase();
        $user = $userDB->getTest();
        $this->assertEquals($user, "test");
    }

}