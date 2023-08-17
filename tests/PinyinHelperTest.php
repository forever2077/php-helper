<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\PinyinHelper;

class PinyinHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(PinyinHelper::class, Helper::pinyin()::class);
    }

    public function testSentence()
    {
        $pinyin = Helper::pinyin()::sentence('你好，世界');
        $this->assertIsObject($pinyin);
        $this->assertEquals('shì', $pinyin->toArray()[3]);
    }
}