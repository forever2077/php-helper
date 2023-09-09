<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\UserAgentHelper;

class UserAgentHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(UserAgentHelper::class, Helper::userAgent()::class);
    }

    public function testUserAgent()
    {
        $this->assertIsString(UserAgentHelper::random());

        $this->assertIsString(UserAgentHelper::random([
            'os_type' => 'Windows', 'device_type' => 'Mobile'
        ]));
    }

    public function testParser()
    {
        try {
            UserAgentHelper::parser();
        } catch (\Exception $e) {
            $this->assertIsString($e->getMessage());
        }
    }
}