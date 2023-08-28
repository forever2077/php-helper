## 缓存 LruCache

```php
ini_set("memory_limit", "128M");

// 缓存算法（本地内存版）
$size = 500000;
$lruCache = new LruCacheHelper($size);

for ($i = 0; $i < $size; $i++) {
	$lruCache->set("k{$i}", str_repeat('1', 10));
}

$this->assertIsString((string)$lruCache->get('k1000'));
$this->assertEquals($size, $lruCache->count());

$lruCache->remove('k1');
$this->assertEquals($size - 1, $lruCache->count());

// 内存消耗 100MB左右
dump(Helper::system()::getMemoryUsage());
```
