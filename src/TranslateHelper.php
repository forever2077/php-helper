<?php

namespace Helpful;

use MouYong\Translate\Kernel\Contracts\TranslatorInterface;
use MouYong\Translate\Translator\{Baidu, Google\Google, Youdao, Jinshan};
use MouYong\Translate\LanguageRecognizer\{LanguageRecognizer, LanguageRecognizerClient};

class TranslateHelper
{
    public array $config = [];
    public string $translator = 'jinshan';

    public function __construct(?array $config = [], string $translator = 'jinshan')
    {
        $this->config = $config;
        $this->translator = strtolower($translator);
    }

    /**
     * 实例化配置
     * @param $translator
     * @return TranslatorInterface
     */
    private function setConfig($translator): TranslatorInterface
    {
        return match ($translator) {
            'baidu' => new Baidu($this->config),
            'youdao' => new Youdao($this->config),
            'google' => new Google($this->config),
            default => new Jinshan($this->config),
        };
    }

    /**
     * 翻译文本（默认：自动检查->英文）
     * @param string $q
     * @param string $from
     * @param string $to
     * @return array
     */
    public function translate(string $q, string $from = 'auto', string $to = 'en'): array
    {
        $app = $this->setConfig($this->translator);
        $result = $app->translate($q, $from, $to);
        if ($result) {
            return [
                'src' => $result->getSrc(),
                'dst' => $result->getDst(),
                'original' => $result->getOriginal(),
            ];
        }
        return [];
    }

    /**
     * 检测用户输入的内容是哪个国家的语言
     * @param string $q
     * @return LanguageRecognizer|null
     */
    public static function languageRecognizer(string $q): ?LanguageRecognizer
    {
        $languageRecognizerClient = new LanguageRecognizerClient();
        return $languageRecognizerClient->detect($q);
    }
}