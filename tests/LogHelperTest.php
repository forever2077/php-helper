<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Monolog\Logger;
use Monolog\Level;
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
        $log->pushHandler(new TestHandler(Level::Warning));
        $log->warning('Foo');
        $log->error('bar');
        $this->assertEquals('default', $log->getName());
    }
}