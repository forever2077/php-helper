## 翻译 Translate

```php
// 翻译器
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

// 检测用户输入的内容是哪个国家的语言
$languageRecognizer = TranslateHelper::languageRecognizer('Словѣ́ньскъ/ⰔⰎⰑⰂⰡⰐⰠⰔⰍⰟ');
$this->assertEquals('MK', $languageRecognizer->getData()['countryCode']);
$languageRecognizer = TranslateHelper::languageRecognizer('中国你好');
$this->assertEquals('ZH', $languageRecognizer->getData()['countryCode']);
```
