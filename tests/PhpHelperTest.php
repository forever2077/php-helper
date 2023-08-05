<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\PhpHelper;
use function Forever2077\PhpHelper\dump;
use function Forever2077\PhpHelper\q;

class PhpHelperTest extends TestCase
{
    public function testPhpHelper()
    {
        $this->assertIsString(PhpHelper::$version);
    }

    public function testCountPubMethod()
    {
        try {
            $str = PhpHelper::countPubMethod();
            dump($str);
            $this->assertIsString($str);
        } catch (Exception $e) {
            dump($e->getMessage());
        }
    }

    public function testQ()
    {
        try {
            $this->assertIsObject(Q('array'));
            $this->assertIsObject(Q('image')->instance());
            $this->assertIsString(Q('file')->format(1024));
            $arr = [1, 3, 2, 5, 4];
            $this->assertIsArray(Q('algorithm')->BubbleSort($arr));
        } catch (Exception $e) {
            dump($e->getMessage());
        }
    }
}