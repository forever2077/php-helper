## 时间日期 Datetime

```php
// 创建实例
$carbon = DateTimeHelper::instance(new DateTime('2023-01-01 00:00:00'));
// 明天时间
$tomorrow = $carbon::now()->addDay();
// 最后一周
$lastWeek = $carbon::now()->subWeek();
// Rfc2822
$officialDate = DateTimeHelper::now()->toRfc2822String();
文档 https://github.com/briannesbitt/Carbon
```
