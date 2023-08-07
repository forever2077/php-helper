<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\RuntimeHelper;

class RuntimeHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(RuntimeHelper::Class, _runtime()::class);
    }

    public function testRuntime()
    {
        RuntimeHelper::instance()->start();
        RuntimeHelper::instance()->stop();
        RuntimeHelper::instance()->reset();
        $this->assertIsFloat(RuntimeHelper::instance()->getMicroTime());
    }
}