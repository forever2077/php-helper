<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\WordCutHelper;

class WordCutHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(WordCutHelper::class, Helper::word());
    }

    public function testWordCut()
    {
        $this->assertEquals(['你好', '中国'], WordCutHelper::cut('你好中国'));
        $this->assertEquals(['你', '你好', '好', '中', '中国', '国'], WordCutHelper::cutAll('你好中国'));
        $this->assertEquals(['你好', '中国'], WordCutHelper::cutForSearch('你好中国'));
    }
}