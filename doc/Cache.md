## 缓存 Cache

```php
use Phpfastcache\CacheManager;
// 缓存配置(可选)
CacheManager::setDefaultConfig(CacheHelper::config(['path' => __DIR__ . '/tmp']));
// 创建本地文本缓存系统
$cache = Helper::cache('files');
$cache->set('name', 'forever2077');
$cache->get('name');
// 创建事件
CacheHelper::event()->onCacheGetItem(function (ExtendedCacheItemPoolInterface $itemPool, ExtendedCacheItemInterface $item) {
    $item->set('[HACKED BY EVENT] ' . $item->get());
});

// Redis 缓存
use Phpfastcache\Drivers\Redis\Config as RedisConfig;
$config = new RedisConfig([
    'host' => getenv('CACHE_REDIS_HOST'),          // 服务器地址
    'port' => (int)getenv('CACHE_REDIS_PORT'),     // 端口号
    'password' => getenv('CACHE_REDIS_PASSWORD'),  // 密码 (如果有)
    'database' => (int)getenv('CACHE_REDIS_DB'),   // 数据库索引
    'optPrefix' => getenv('CACHE_REDIS_PREFIX'),   // 前缀
]);
$cache = Helper::cache('redis', $config);
$cache->set('name', '......');
$cache->get('name');
$cache->delete('name');
文档 https://github.com/PHPSocialNetwork/phpfastcache
```