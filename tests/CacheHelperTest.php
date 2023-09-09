<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\CacheHelper;
use Phpfastcache\Helper\Psr16Adapter;
use Phpfastcache\Core\Item\ExtendedCacheItemInterface;
use Phpfastcache\Core\Pool\ExtendedCacheItemPoolInterface;
use Phpfastcache\CacheManager;
use Helpful\EnvHelper;
use Phpfastcache\Drivers\Redis\Config as RedisConfig;

class CacheHelperTest extends TestCase
{
    public function testInstance()
    {
        try {
            $this->assertInstanceOf(Psr16Adapter::class, Helper::cache('files'));
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testConfig()
    {
        try {
            CacheManager::setDefaultConfig(CacheHelper::config(['path' => dirname(__DIR__, 1) . '/data/temp']));
            $this->assertTrue(true);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testFilesCache()
    {
        try {
            $uuid = Helper::uuid()::guid();
            $cache = Helper::cache('files');
            $cache->set('name', 'forever2077');
            $cache->set('uuid', $uuid, 300);
            $this->assertEquals($uuid, $cache->get('uuid'));
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testEvent()
    {
        CacheHelper::event()->onCacheGetItem(function (ExtendedCacheItemPoolInterface $itemPool, ExtendedCacheItemInterface $item) {
            $item->set('[HACKED BY EVENT] ' . $item->get());
        });
        try {
            $cache = Helper::cache('files');
            $cache->set('name', 'forever2077');
            $this->assertEquals('[HACKED BY EVENT] forever2077', $cache->get('name'));
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testManage()
    {
        try {
            $InstanceCache = CacheHelper::manage('files');
            $CachedString = $InstanceCache->getItem('name');
            if ($CachedString->isHit()) {
                $this->assertIsString($CachedString->get());
            }
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    /*public function testRedis()
    {
        try {
            $env = EnvHelper::instance(dirname(__DIR__));
            $config = new RedisConfig([
                'host' => $env->get('CACHE_REDIS_HOST'),          // 服务器地址
                'port' => (int)$env->get('CACHE_REDIS_PORT'),     // 端口号
                'password' => $env->get('CACHE_REDIS_PASSWORD'),  // 密码 (如果有)
                'database' => (int)$env->get('CACHE_REDIS_DB'),   // 数据库索引
                'optPrefix' => $env->get('CACHE_REDIS_PREFIX'),   // 前缀
            ]);
            $redisInstance = Helper::cache('redis', $config);
            $redisInstance->set('name', 'forever2077');
            $retrievedValue = $redisInstance->get('name');
            $this->assertEquals('[HACKED BY EVENT] forever2077', $retrievedValue);
            //$redisInstance->delete('name');
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }*/
}