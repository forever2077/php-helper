## 运行时 Runtime

```php
// 启动计时 (单例)
Helper::runtime()->start();
// 结束计时并返回消耗的时间（单位 毫秒）
Helper::runtime()->stop();
// 重新开始计时
Helper::runtime()->reset();
// 获取当前毫秒时间
Helper::runtime()->getMicroTime();
// 计算消耗多长时间
Helper::runtime()->consumeTime
```