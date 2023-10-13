<?php

namespace Database;
use Framework\Database\CommentDatabase;

class DataBaseConnexionTest extends PHPUnit_Framework_TestCase
{
    public function testSelect()
    {
        $commentDB = new CommentDatabase();
        $commentDB->select();
        $this->assertEquals($commentDB->getData(), "ok");
    }
}