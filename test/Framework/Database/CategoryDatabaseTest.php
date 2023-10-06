<?php

namespace Database;
class CategoryDatabaseTest extends \PHPUnit_Framework_TestCase
{
    public function testSelect()
    {
        $categoryDB = new CategoryDatabase();
        $categoryDB->select();
        $this->assertEquals($categoryDB->getData(), "ok");
    }
}