<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\ArrayHelper;
use function Forever2077\PhpHelper\dd;

class A
{
    public $a = 1;
    public $b = 2;

    public function __construct()
    {
        $this->a = 1;
        $this->b = 2;
    }
}

class ArrayHelperTest extends TestCase
{
    public function testToArray()
    {
        $a1 = new A();
        $this->assertEquals(['a' => 1, 'b' => 2], ArrayHelper::toArray($a1));
    }

    public function testGetValue()
    {
        $a1 = new A();
        $this->assertEquals('1', ArrayHelper::getValue($a1, 'a'));
    }
}