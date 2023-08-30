<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\TranslateHelper;

class TranslateHelperTest extends TestCase
{
    public function testInstance()
    {
        $helper = Helper::translate();
        $this->assertInstanceOf(TranslateHelper::class, $helper);
    }

    private function testTranslate()
    {
        $translator = new TranslateHelper();

        // 金山翻译
        // @see https://www.iciba.com/
        $rtn = $translator->translate('你好');
        $this->assertEquals('hello', strtolower($rtn['dst']));

        // 百度翻译
        // @see http://api.fanyi.baidu.com/
        $translator->translator = 'baidu';
        $translator->config = [
            'app_id' => '*******************',
            'app_key' => '*******************',
        ];
        $rtn = $translator->translate('你好');
        $this->assertEquals('hello', strtolower($rtn['dst']));

        // 有道翻译
        // @see https://ai.youdao.com/
        $translator->translator = 'youdao';
        $translator->config = [
            'app_id' => '*******************',
            'app_key' => '*******************',
        ];
        $rtn = $translator->translate('你好');
        $this->assertEquals('hello', strtolower($rtn['dst']));

        // Google翻译
        // @see https://translate.google.com/
        $translator->translator = 'google';
        $translator->config = [
            'http' => [
                'verify' => false,
                'proxy' => 'http://127.0.0.1:7890',
            ],
        ];
        $rtn = $translator->translate('你好');
        $this->assertEquals('hello', strtolower($rtn['dst']));
    }

    private function testLanguageRecognizer()
    {
        $languageRecognizer = TranslateHelper::languageRecognizer('Словѣ́ньскъ/ⰔⰎⰑⰂⰡⰐⰠⰔⰍⰟ');
        $this->assertEquals('MK', $languageRecognizer->getData()['countryCode']);
        $languageRecognizer = TranslateHelper::languageRecognizer('中国你好');
        $this->assertEquals('ZH', $languageRecognizer->getData()['countryCode']);
    }
}