## 日志 Log

```php
$log = Helper::log();
$log->pushHandler(new TestHandler());
$log->warning('Foo');
$log->error('bar');
文档 https://seldaek.github.io/monolog/
```