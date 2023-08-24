<?php

namespace Forever2077\PhpHelper;

use Exception;
use Phpfastcache\CacheManager;
use Phpfastcache\EventManager;
use Phpfastcache\Helper\Psr16Adapter;
use Phpfastcache\Event\EventManagerInterface;
use Phpfastcache\Config\ConfigurationOption;
use Phpfastcache\Config\ConfigurationOptionInterface;
use Phpfastcache\Core\Pool\ExtendedCacheItemPoolInterface;

class CacheHelper
{
    /**
     * 缓存实例
     * @link https://github.com/PHPSocialNetwork/phpfastcache
     * @param string|ExtendedCacheItemPoolInterface $driver
     * @param ConfigurationOptionInterface|null $config
     * @return Psr16Adapter
     * @throws Exception
     */
    public static function instance(string|ExtendedCacheItemPoolInterface $driver, ConfigurationOptionInterface $config = null): Psr16Adapter
    {
        try {
            return new Psr16Adapter($driver, $config);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    /**
     * @param string $driver
     * @param ConfigurationOptionInterface|null $config
     * @param string|null $instanceId
     * @return ExtendedCacheItemPoolInterface
     * @throws Exception
     */
    public static function manage(string $driver, ?ConfigurationOptionInterface $config = null, ?string $instanceId = null): ExtendedCacheItemPoolInterface
    {
        try {
            return CacheManager::getInstance($driver, $config, $instanceId);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    /**
     * 缓存事件
     * @return EventManagerInterface
     */
    public static function event(): EventManagerInterface
    {
        return EventManager::getInstance();
    }

    /**
     * 缓存配置
     * @param array $parameters
     * @return ConfigurationOption
     * @throws Exception
     */
    public static function config(array $parameters = []): ConfigurationOption
    {
        try {
            return new ConfigurationOption($parameters);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}