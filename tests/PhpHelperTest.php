<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\PhpHelper;
use function Forever2077\PhpHelper\dump;

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
}