<?php

use Forever2077\PhpHelper\StrHelper;
use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\SensitiveHelper;
use DfaFilter\Exceptions\PdsBusinessException;
use DfaFilter\Exceptions\PdsSystemException;

class DfaHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(SensitiveHelper::class, Helper::sensitive()::class);
    }

    public function testSensitiveWord()
    {
        $wordData = [
            '察象蚂', '拆迁灭', '车牌隐', '成人电', '成人卡通',
        ];
        $badWord = '这是敏感词：成 人 卡 通';
        try {
            // 字符串过滤
            $badWord = StrHelper::filterSpecialCharacters($badWord, true);

            $handle = SensitiveHelper::dfa($wordData);
            $this->assertTrue($handle->islegal($badWord));
            $this->assertEquals('这是敏感词****', $handle->replace($badWord, '*', true));
            $this->assertEquals('这是敏感词***', $handle->replace($badWord, '***'));
            $this->assertEquals('这是敏感词<mark>成人卡通</mark>', $handle->mark($badWord, '<mark>', '</mark>'));
            $this->assertEquals('成人卡通', $handle->getBadWord($badWord)[0]);
        } catch (PdsBusinessException|PdsSystemException $e) {
            $this->fail($e->getMessage());
        }
    }
}