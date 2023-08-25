<?php

namespace Forever2077\PhpHelper\Annotations\Handler;

use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\CacheHelper;
use Forever2077\PhpHelper\Annotations\Interface\Handler;
use ReflectionClass;
use Phpfastcache\Drivers\Redis\Config as RedisConfig;

class Cache implements Handler
{
    /**
     * @param ReflectionClass $class
     * @param object $annotationInstance
     * @param mixed|null $targetMethodRtn
     * @return mixed
     * @throws \Exception
     */
    public static function run(ReflectionClass $class, object $annotationInstance, mixed $targetMethodRtn = null): mixed
    {
        try {
            switch ($annotationInstance->driver) {
                case 'redis':
                    $config = new RedisConfig([
                        'host' => getenv('ANNOTATION_CACHE_REDIS_HOST'),
                        'port' => (int)getenv('ANNOTATION_CACHE_REDIS_PORT'),
                        'password' => getenv('ANNOTATION_CACHE_REDIS_PASSWORD'),
                        'database' => (int)getenv('ANNOTATION_CACHE_REDIS_DB'),
                        'optPrefix' => getenv('ANNOTATION_CACHE_REDIS_PREFIX'),
                    ]);
                    $cache = Helper::cache('redis', $config);
                    break;
                default:
                    $cache = Helper::cache('files', CacheHelper::config([
                        'path' => dirname(__DIR__, 3) . '/data/temp',
                    ]));
                    break;
            }
        } catch (\Exception $e) {
            throw new \Exception('annotation run', 0, $e);
        }

        $keyName = $annotationInstance->key ?? "{$targetMethodRtn['__className']}{$targetMethodRtn['__methodName']}";
        $keyName = md5($keyName);

        if ($cache->has($keyName)) {
            return unserialize($cache->get($keyName));
        } else {
            if (isset($targetMethodRtn[$targetMethodRtn['__methodName']])) {
                $cache->set($keyName, serialize($targetMethodRtn[$targetMethodRtn['__methodName']]), $annotationInstance->ttl);
                return true;
            }
            return false;
        }
    }
}