<?php

use LanguageDetection\Tokenizer\TokenizerInterface;
use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\LanguageHelper;

class LanguageHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(LanguageHelper::Class, Helper::language()::class);
    }

    public function testDetection()
    {
        $this->assertIsArray(LanguageHelper::detection('你好中国', [
            'blacklist' => '',
            'offset' => 0, 'length' => 5,
        ]));
        $this->assertIsArray(LanguageHelper::detection('Mag het een onsje meer zijn?', [
            'bestResults' => true,
        ]));
    }

    public function testTrainer()
    {
        // 实际需放置 vendor/patrickschur/language-detection/resources
        LanguageHelper::trainer(dirname(__DIR__) . '/data/lang', [
            // 自定义标记器
            'tokenizer' => new class implements TokenizerInterface {
                public function tokenize(string $str): array
                {
                    return preg_split('/[^a-z0-9]/u', $str, -1, PREG_SPLIT_NO_EMPTY);
                }
            },
            'maxNgrams' => 9000,
        ]);
        $this->assertFileExists(dirname(__DIR__) . '/data/lang/zh-Hans/zh-Hans.php');
    }
}