<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\StrHelper;

class StrHelperTest extends TestCase
{
    public function testUniqueShortStr()
    {
        $this->assertEquals(16, strlen(StrHelper::uniqueShortStr()));
        $this->assertEquals(16, strlen(StrHelper::uniqueShortStr(2021)));
        $this->assertEquals(16, strlen(StrHelper::uniqueShortStr(2023)));
    }

    public function testUniqueDateNum()
    {
        $this->assertEquals(24, strlen(StrHelper::uniqueDateNum()));
    }

    public function testRandStr()
    {
        $this->assertEquals(6, strlen(StrHelper::randStr(6)));
        $this->assertEquals(6, strlen(StrHelper::randStr(6, '0123456789')));
        $this->assertEquals(6, strlen(StrHelper::randStr(6, '0123456789', true)));
    }
}