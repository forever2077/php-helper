## 布隆过滤器 BloomFilter

```php
$bf = Helper::bloom(100000, 0.001);
$bf->add('item1');
$bf->exists('item1');
文档 https://github.com/pleonasm/bloom-filter
```