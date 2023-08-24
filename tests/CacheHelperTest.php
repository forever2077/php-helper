<?php

use Phpfastcache\Config\ConfigurationOption;
use Phpfastcache\Core\Item\ExtendedCacheItemInterface;
use Phpfastcache\Core\Pool\ExtendedCacheItemPoolInterface;
use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\CacheHelper;
use Phpfastcache\Helper\Psr16Adapter;
use Phpfastcache\CacheManager;
use Phpfastcache\Drivers\Redis\Config;

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
            CacheManager::setDefaultConfig(CacheHelper::config([
                'path' => __DIR__ . '\tmp',
            ]));
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
            $redisConfig = new ConfigurationOption([
                'defaultTtl' => 3600,
                'defaultChmod' => 0777,
                'redis' => new Config([
                    'host' => '127.0.0.1', // Redis 服务器地址
                    'port' => 6379,        // 端口号
                    'password' => '',      // 密码 (如果有)
                    'database' => 0        // 数据库索引
                ])
            ]);
            $redisInstance = Helper::cache('redis', $redisConfig);
            $redisInstance->set('name', 'forever2077');
            $retrievedValue = $redisInstance->get('name');
            $redisInstance->delete('name');
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }*/
}