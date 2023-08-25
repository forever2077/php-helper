<?php

use Forever2077\PhpHelper\CacheHelper;
use Forever2077\PhpHelper\EnvHelper;
use Phpfastcache\Drivers\Redis\Config as RedisConfig;
use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\Annotations\{After, Before, Cache, Log, Limit};

class AnnotationHelperTest extends TestCase
{
    public function testMain()
    {
        try {
            $rtn = Helper::annotation([$this, 'doAction'], ['a' => 1, 'b' => 2]);
            //dump($rtn);
            $this->assertIsArray($rtn);
        } catch (Exception $e) {
            $this->fail($e);
        }
    }

    public function testLoadRedisConfigByEnv()
    {
        EnvHelper::instance(dirname(__DIR__));
        $this->assertIsString(getenv('ANNOTATION_CACHE_REDIS_HOST'));
    }

    /**
     * @param int $a
     * @param int $b
     * @return string
     * @throws Exception
     */
    //#[Limit]
    #[Before("beforeAction", ['a' => 3, 'b' => 4])]
    #[After(['AnnotationHelperTest', 'afterAction'], ['a' => 5, 'b' => 6])]
    public static function doAction(int $a = 0, int $b = 0): string
    {
        try {
            Helper::annotation([__CLASS__, 'innerAction'], ['a' => 7, 'b' => 8]);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return "doAction：{$a}, {$b}";
    }

    public static function beforeAction($a = 0, $b = 0): string
    {
        return "beforeAction：{$a}, {$b}";
    }

    public function afterAction($a = 0, $b = 0): string
    {
        return "afterAction：{$a}, {$b}";
    }

    //#[Log]
    //#[Log('自定义日志信息')]
    //#[Cache] // 默认
    #[Cache(300, 'files', 'myDefined')] // 后续可通过自定义ID获取内容
    //#[Cache(300, 'redis', 'myDefined')]
    public function innerAction($a = 0, $b = 0): string
    {
        return "innerAction：{$a}, {$b} - " . date('Y-m-d H:i:s');
    }

    public function testGetTargetMethodCacheContentByFiles()
    {
        try {
            $cache = Helper::cache('files', CacheHelper::config([
                'path' => dirname(__DIR__, 1) . '/data/temp',
            ]));
            $this->assertIsString(unserialize($cache->get(md5('myDefined'))));
        } catch (Exception $e) {
            $this->fail($e);
        }
    }

    private function testGetTargetMethodCacheContentByRedis()
    {
        try {
            $config = new RedisConfig([
                'host' => getenv('ANNOTATION_CACHE_REDIS_HOST'),
                'port' => (int)getenv('ANNOTATION_CACHE_REDIS_PORT'),
                'password' => getenv('ANNOTATION_CACHE_REDIS_PASSWORD'),
                'database' => (int)getenv('ANNOTATION_CACHE_REDIS_DB'),
                'optPrefix' => getenv('ANNOTATION_CACHE_REDIS_PREFIX'),
            ]);
            $cache = Helper::cache('redis', $config);
            $this->assertIsString(unserialize($cache->get(md5('myDefined'))));
        } catch (\Exception $e) {
            $this->fail($e);
        }
    }
}