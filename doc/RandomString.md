## 随机字符串 RandomString

```php
// 生成32位随机字符串
RandomHelper::string(32)->generate();
// 生成指定配置的字符串
RandomHelper::string()::fromArray(['length' => 6, 'charset' => 'ABCD1234'])->generate();
// 使用StringConfig生成配置的随机字符串
RandomHelper::string(32,
    StringConfig::make()
        ->length(32)
        ->charset('~!@#$%^&*()_+85716253uygsdfdgfj')
)->generate();

文档 https://github.com/stfndamjanovic/php-random-string

// 生成随机UserAgent
RandomHelper::userAgent([
    'os_type' => 'Windows', 'device_type' => 'Mobile'
]);
文档 https://github.com/joecampo/random-user-agent
```