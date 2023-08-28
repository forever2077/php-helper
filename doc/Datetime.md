## 时间日期 Datetime

```php
// 创建实例
$carbon = DateTimeHelper::carbon();
// 明天时间
$tomorrow = $carbon::now()->addDay();
// 最后一周
$lastWeek = $carbon::now()->subWeek();
// Rfc2822
$officialDate = DateTimeHelper::carbon()::now()->toRfc2822String();
文档 https://github.com/briannesbitt/Carbon
```