<?php

namespace Database;
use PHPUnit\Framework\TestCase;
class CategoryDatabaseTest extends TestCase
{
    public function testeeee()
    {
        // Arrange
        $a = 1;
        $b = 2;
        // Act
        $c =$a + $b;

        // Assert
        $this->assertEquals(3, $c);
    }
    public function testAdd()
    {
        // Arrange
        $a = 1;
        $b = 2;
        // Act
        $c =$a - $b;

        // Assert
        $this->assertEquals(3, $c);
    }

}