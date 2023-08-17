<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\TerminalHelper;
use League\CLImate\CLImate;

class TerminalHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(CLImate::class, Helper::terminal());
    }

    public function testCLImate()
    {
        $this->assertEquals(CLImate::class, TerminalHelper::instance()::class);
    }
}