<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\VersionHelper;

class VersionHelperTest extends TestCase
{
    public function testInstance()
    {
        $version = Helper::version('1.0.0');
        $this->assertInstanceOf(VersionHelper::class, $version);
    }

    public function testComplies()
    {
        $this->assertTrue(VersionHelper::complies('^7.0', '7.0.0'));
        $this->assertFalse(VersionHelper::complies('^7.0', '6.4.34'));
        $this->assertTrue(VersionHelper::complies('~1.1.0', '1.1.4'));
        $this->assertFalse(VersionHelper::complies('~1.1.0', '1.2.0'));
    }

    public function testGreaterThan()
    {
        $leftVersion = Helper::version('3.0.0-alpha.1');
        $rightVersion = Helper::version('3.0.0-alpha.2');
        $this->assertFalse($leftVersion->isGreaterThan($rightVersion));
        $this->assertTrue($rightVersion->isGreaterThan($leftVersion));
    }
}