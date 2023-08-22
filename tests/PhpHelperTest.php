<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\PhpHelper;

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
            print_r($str);
            $this->assertIsString($str);
        } catch (Exception $e) {
            dump($e->getMessage());
        }
    }

    public function testQ()
    {
        try {
            $this->assertIsString(Helper::file()->format(1024));
            $arr = [1, 3, 2, 5, 4];
            $this->assertIsArray(Helper::algorithm()->BubbleSort($arr));
        } catch (Exception $e) {
            dump($e->getMessage());
        }
    }
}