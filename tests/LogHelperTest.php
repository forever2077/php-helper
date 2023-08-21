<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\LogHelper;
use Monolog\Logger;
use Monolog\Handler\TestHandler;

class LogHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(Logger::class, Helper::log());
    }

    public function testLog()
    {
        $log = Helper::log();
        $log->pushHandler(new TestHandler());
        $log->warning('Foo');
        $log->error('bar');
        $this->assertEquals('default', $log->getName());
    }
}