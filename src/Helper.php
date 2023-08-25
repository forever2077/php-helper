<?php

namespace Forever2077\PhpHelper;

class Helper
{
    public static function algorithm(): AlgorithmHelper
    {
        return AlgorithmHelper::instance();
    }

    public static function array(mixed $args = null): ArrayHelper
    {
        return new ArrayHelper($args);
    }

    public static function bloom(int $approxSize, float $falsePosProb): \Pleo\BloomFilter\BloomFilter
    {
        return BloomHelper::instance($approxSize, $falsePosProb);
    }

    public static function cache(
        string|\Phpfastcache\Core\Pool\ExtendedCacheItemPoolInterface $driver,
        \Phpfastcache\Config\ConfigurationOptionInterface             $config = null
    ): \Phpfastcache\Helper\Psr16Adapter
    {
        try {
            return CacheHelper::instance($driver, $config);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public static function captcha(mixed $args = null): CaptchaHelper
    {
        return new CaptchaHelper($args);
    }

    public static function crypto(): CryptoHelper
    {
        return CryptoHelper::instance();
    }

    public static function csv(): CsvHelper
    {
        return CsvHelper::instance();
    }

    public static function dataStruct(mixed $args = null): DataStructHelper
    {
        return new DataStructHelper($args);
    }

    public static function dateTime(mixed $args = null): \Carbon\Carbon
    {
        return DateTimeHelper::instance($args);
    }

    public static function sensitive(mixed $args = null): SensitiveHelper
    {
        return new SensitiveHelper($args);
    }

    public static function email(mixed $args = null): \PHPMailer\PHPMailer\PHPMailer
    {
        return EmailHelper::instance($args);
    }

    public static function file(): FileHelper
    {
        return FileHelper::instance();
    }

    public static function geo(): GeoHelper
    {
        return GeoHelper::instance();
    }

    public static function http(array $args = []): \GuzzleHttp\Client
    {
        return HttpHelper::instance($args);
    }

    public static function image(array $args = []): \Intervention\Image\ImageManager
    {
        return ImageHelper::instance($args);
    }

    public static function ip(): IpHelper
    {
        return new IpHelper();
    }

    public static function json(): JsonHelper
    {
        return new JsonHelper();
    }

    public static function jwt(): JwtHelper
    {
        return JwtHelper::instance();
    }

    public static function log(string $name = 'default', array $handlers = [], array $processors = [], ?\DateTimeZone $timezone = null): \Monolog\Logger
    {
        return LogHelper::instance($name, $handlers, $processors, $timezone);
    }

    public static function lruCache(mixed $args = null): LruCacheHelper
    {
        return new LruCacheHelper($args);
    }

    public static function map(mixed $args = null): MapHelper
    {
        return new MapHelper($args);
    }

    public static function net(mixed $args = null): NetHelper
    {
        return new NetHelper($args);
    }

    public static function office(): OfficeHelper
    {
        return new OfficeHelper();
    }

    public static function pay(): PayHelper
    {
        return PayHelper::instance();
    }

    public static function random(): RandomHelper
    {
        return RandomHelper::instance();
    }

    public static function runtime(): RuntimeHelper
    {
        return RuntimeHelper::instance();
    }

    public static function sms(array $args): \Overtrue\EasySms\EasySms
    {
        return SmsHelper::instance($args);
    }

    public static function str(): StrHelper
    {
        return new StrHelper();
    }

    public static function system(mixed $args = null): SystemHelper
    {
        return new SystemHelper($args);
    }

    public static function validate(): \Respect\Validation\Validator
    {
        return ValidateHelper::instance();
    }

    public static function version(mixed $args = null): \PharIo\Version\Version
    {
        return VersionHelper::instance($args);
    }

    public static function xml(): \Sabre\Xml\Service
    {
        return XmlHelper::instance();
    }

    public static function zip(bool $manager = false): \ZanySoft\Zip\Zip|\ZanySoft\Zip\ZipManager
    {
        return ZipHelper::instance($manager);
    }

    public static function aliyun(): AliyunHelper
    {
        return AliyunHelper::instance();
    }

    public static function wechat(): WechatHelper
    {
        return WechatHelper::instance();
    }

    public static function baidu(): BaiduHelper
    {
        return BaiduHelper::instance();
    }

    public static function config(array|string $values, string $parser = 'Json'): \Noodlehaus\Config
    {
        return ConfigHelper::instance($values, $parser);
    }

    public static function env(string $filePath, string $filename = ''): EnvHelper
    {
        return EnvHelper::instance($filePath, $filename);
    }

    public static function uuid(): UuidHelper
    {
        return UuidHelper::instance();
    }

    public static function uri(string $args = ''): \GuzzleHttp\Psr7\Uri
    {
        return UriHelper::instance($args);
    }

    public static function alipay(): AlipayHelper
    {
        return AlipayHelper::instance();
    }

    public static function tencentCloud(): TencentCloudHelper
    {
        return TencentCloudHelper::instance();
    }

    public static function oauth2(): OAuth2Helper
    {
        return OAuth2Helper::instance();
    }

    public static function pinyin(): \Overtrue\Pinyin\Pinyin
    {
        return PinyinHelper::instance();
    }

    public static function terminal(): \League\CLImate\CLImate
    {
        return TerminalHelper::instance();
    }

    public static function identity(): IdentityHelper
    {
        return IdentityHelper::instance();
    }

    public static function debug(
        bool|string|array|null $mode = null,
        ?string                $logDirectory = null,
        string|array|null      $email = null
    ): void
    {
        DebugHelper::enable($mode, $logDirectory, $email);
    }

    public static function annotation(array $callback, array $args = []): mixed
    {
        try {
            return AnnotationHelper::process($callback, $args);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}