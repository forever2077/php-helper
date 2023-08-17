<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\ValidateHelper;

class ValidateHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(ValidateHelper::Class, Helper::validate()::class);
    }

    public function testIsPhone()
    {
        $this->assertTrue(ValidateHelper::isPhone('13800138000'));
        $this->assertFalse(ValidateHelper::isPhone('1380013800'));
    }

    public function testIsEmail()
    {
        $this->assertTrue(ValidateHelper::isEmail('13800138000@qq.com.cn'));
    }

    public function testIsHttp()
    {
        $this->assertTrue(ValidateHelper::isHttp('http://www.baidu.com'));
        $this->assertTrue(ValidateHelper::isHttp('https://www.baidu.com'));
        $this->assertFalse(ValidateHelper::isHttp('www.baidu.com'));
    }

    public function testIsJson()
    {
        $this->assertTrue(ValidateHelper::isJson('{"a":1}'));
        $this->assertFalse(ValidateHelper::isJson('{"a":1'));
    }
}