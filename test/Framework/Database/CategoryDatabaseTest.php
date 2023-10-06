<?php

namespace Database;
class CategoryDatabaseTest extends PHPUnit_Framework_TestCase
{
    public function testSelect()
    {
        $categoryDB = new CategoryDatabase();
        $users = $userDB->selectFromUsername('myke');
        $this->assertEquals($categoryDB->getData(), "ok");
    }
}