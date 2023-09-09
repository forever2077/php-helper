<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\RuntimeHelper;

class RuntimeHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(RuntimeHelper::Class, Helper::runtime()::class);
    }

    public function testRuntime()
    {
        Helper::runtime()->start();
        Helper::runtime()->stop();
        Helper::runtime()->reset();
        $this->assertIsFloat(Helper::runtime()->getMicroTime());
    }
}