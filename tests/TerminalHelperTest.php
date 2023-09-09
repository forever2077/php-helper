<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\TerminalHelper;
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