<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\PinyinHelper;

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

    public function testPinyin()
    {
        $pinyin = PinyinHelper::sentence('你好，世界');
        $this->assertEquals('shì', $pinyin->toArray()[3]);
    }
}