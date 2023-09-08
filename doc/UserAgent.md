## 用户代理 UserAgent

```php
// 生成随便UA
UserAgentHelper::random();

// 生成指定平台UA
UserAgentHelper::random([
	'os_type' => 'Windows', 'device_type' => 'Mobile'
]);

// 解释用户UA
$uaInfo = UserAgentHelper::parser();
//platform
//browser
//browserVersion
```
