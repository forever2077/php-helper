<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\ArrayHelper;

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

    public function testMapFrom()
    {
        $map = ArrayHelper::from([0 => 'b', 1 => 'a'])->after('b');
        $this->assertEquals([1 => 'a'], $map->toArray());
        $map = ArrayHelper::from(['b' => 0, 'a' => 1])->arsort();
        $this->assertEquals(['a' => 1, 'b' => 0], $map->toArray());
    }

    public function testMapCreate()
    {
        $arr = ArrayHelper::create(['Lars' => ['lastname' => 'Moelleken']]);
        $this->assertEquals('Moelleken', $arr->get('Lars.lastname'));
        $this->assertEquals('bàř,fòô', ArrayHelper::create(['fòô', 'bàř', 'bàř'])->unique()->reverse()->implode(','));
    }
}