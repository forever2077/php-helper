## 语言 Language

```php
// 检查语言属于哪国
LanguageHelper::detection('Mag het een onsje meer zijn?', [
    'blacklist' => [],      // 黑名单中的语言将被排除
    'whitelist' => [],      // 白名单中的语言将被优先考虑
    'offset' => 0,          // 结果数组的偏移量
    'length' => 5,          // 返回结果的最大数量
    'bestResults' => true,  // 如果为true，只返回最佳匹配结果
]);

// 训练生成目标语言数据
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

文档 https://github.com/patrickschur/language-detection#basic-usage
```
