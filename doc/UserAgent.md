## 用户代理 UserAgent

```php
// 生成随便UA
UserAgentHelper::random();

// 生成指定平台UA
UserAgentHelper::random([
	'os_type' => 'Windows', 'device_type' => 'Mobile'
]);

文档 https://github.com/joecampo/random-user-agent

// 解释用户UA
$uaInfo = UserAgentHelper::parser();
// Array ( [browser] => Chrome [platform] => Windows [browserVersion] => 116.0.0.0 )

文档 https://github.com/donatj/PhpUserAgent
```
