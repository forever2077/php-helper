## 调试器 Debugger

```php
// 默认开启调试器
DebugHelper::enable();
// 限制开发人员从特定IP地址访问
DebugHelper::enable('23.75.345.200');
// 记录异常
DebugHelper::log('Unexpected error');
文档 https://github.com/nette/tracy
```