<?php

namespace Database;
class CommentDatabaseTest extends PHPUnit_Framework_TestCase
{
    public function testSelect()
    {
        $commentDB = new CommentDatabase();
        $commentDB->select();
        $this->assertEquals($commentDB->getData(), "ok");
    }
}