<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\ArrayHelper;

class Foo
{
    public int $a = 1;
    public int $b = 2;

    public function __construct()
    {
        $this->a = 1;
        $this->b = 2;
    }
}

class ArrayHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(ArrayHelper::Class, Helper::array()::class);
    }

    public function testToArray()
    {
        $a1 = new Foo();
        $this->assertEquals(['a' => 1, 'b' => 2], ArrayHelper::toArray($a1));
    }

    public function testGetValue()
    {
        $a1 = new Foo();
        $this->assertEquals('1', ArrayHelper::getValue($a1, 'a'));
    }

    public function testIsAssoc()
    {
        $this->assertTrue(ArrayHelper::isAssoc(['a' => 1, 'b' => 2]));
        $this->assertFalse(ArrayHelper::isAssoc([1, 2]));
    }

    public function testGetTree()
    {
        $data = [
            ['id' => 1, 'pid' => 0, 'name' => 'a'],
            ['id' => 2, 'pid' => 0, 'name' => 'b'],
            ['id' => 3, 'pid' => 1, 'name' => 'c'],
            ['id' => 4, 'pid' => 1, 'name' => 'd'],
            ['id' => 5, 'pid' => 2, 'name' => 'e'],
            ['id' => 6, 'pid' => 2, 'name' => 'f'],
            ['id' => 7, 'pid' => 3, 'name' => 'g'],
            ['id' => 8, 'pid' => 3, 'name' => 'h'],
            ['id' => 9, 'pid' => 4, 'name' => 'i'],
            ['id' => 10, 'pid' => 4, 'name' => 'j'],
        ];
        $tree = ArrayHelper::getTree($data, 2, 'pid');
        $this->assertIsArray($tree);
    }
}