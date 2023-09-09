## 字符串 Str

```php
// 生成唯一数字（日期+随机数）
StrHelper::uniqueDateNum();

// 过滤指定的字符集合（默认过滤键盘中常见符号集合）
StrHelper::filterSpecialCharacters(string $input, bool $removeSpaces = false, string $charactersToRemove = '~!@#$%^&*()_+`-={}|[]\\:";\'<>?,./＼＇');

// 全角转半角符号
StrHelper::fullToHalf(string $str);

// 半角转全角符号
StrHelper::halfToFull(string $str);

// 将数字转为汉字念法，支持人民币大写汉字，文档 https://github.com/wilon/php-number2chinese
StrHelper::number2chinese(string $number, bool $isRmb = false);

// 将数字转换为其单词表示形式，文档 https://github.com/kwn/number-to-words
StrHelper::number2words(int $number, string $language = 'en', string $currency = null, ?CurrencyTransformerOptions $options = null);
```
