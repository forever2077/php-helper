<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\RandomHelper;
use Forever2077\RandomString\InvalidStringConfigException;
use Forever2077\RandomString\StringConfig;

class RandomHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(RandomHelper::class, Helper::random());
    }

    public function testRandString()
    {
        try {
            $rand = RandomHelper::string(32);
            $this->assertIsString($rand->generate());
        } catch (InvalidStringConfigException $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testRandStringConfig()
    {
        try {
            $rand = RandomHelper::string();
            $rand->useConfig(
                StringConfig::make()
                    ->length(32)
                    ->charset('~!@#$%^&*()_+85716253uygsdfdgfj')
            );
            $this->assertIsString($rand->generate());
        } catch (InvalidStringConfigException $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testRandStringConfig2()
    {
        try {
            $rand = RandomHelper::string(32,
                StringConfig::make()
                    ->length(32)
                    ->charset('~!@#$%^&*()_+85716253uygsdfdgfj')
            );
            $this->assertIsString($rand->generate());
        } catch (InvalidStringConfigException $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testRandStringConfig3()
    {
        try {
            $rand = RandomHelper::string()::fromArray(['length' => 6, 'charset' => 'ABCD1234']);
            $this->assertIsString($rand->generate());
        } catch (InvalidStringConfigException $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testUserAgent()
    {
        $this->assertIsString(RandomHelper::userAgent([
            'os_type' => 'Windows', 'device_type' => 'Mobile'
        ]));
    }
}