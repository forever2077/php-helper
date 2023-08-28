## 版本号 Version

```php
// 版本号是否符合要求
VersionHelper::complies('^7.0', '7.0.0'); // true
VersionHelper::complies('^7.0', '6.4.34'); // false
VersionHelper::complies('~1.1.0', '1.1.4'); // true
// 版本号对比
$leftVersion = Helper::version('3.0.0-alpha.1');
$rightVersion = Helper::version('3.0.0-alpha.2');
$leftVersion->isGreaterThan($rightVersion);
$rightVersion->isGreaterThan($leftVersion);
文档 https://github.com/phar-io/version
```