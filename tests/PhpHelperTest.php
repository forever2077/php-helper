<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper;

class PhpHelperTest extends TestCase
{
    public function testPhpHelper()
    {
        $this->assertIsString(PhpHelper\PhpHelper::$version);
    }

    public function testCountPubMethod()
    {
        try {
            $str = PhpHelper\PhpHelper::countPubMethod();
            dump($str);
            $this->assertIsString($str);
        } catch (Exception $e) {
            dump($e->getMessage());
        }
    }

    public function testQ()
    {
        try {
            $this->assertIsObject(_array());
            $this->assertIsObject(_image()->instance());
            $this->assertIsString(_file()->format(1024));
            $arr = [1, 3, 2, 5, 4];
            $this->assertIsArray(_algorithm()->BubbleSort($arr));
        } catch (Exception $e) {
            dump($e->getMessage());
        }
    }
}