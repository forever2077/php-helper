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

    public static function bloom(mixed $args = null): BloomHelper
    {
        return new BloomHelper($args);
    }

    public static function cache(mixed $args = null): CacheHelper
    {
        return new CacheHelper($args);
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

    public static function dfa(mixed $args = null): DfaHelper
    {
        return new DfaHelper($args);
    }

    public static function email(mixed $args = null): \PHPMailer\PHPMailer\PHPMailer
    {
        return EmailHelper::instance($args);
    }

    public static function error(mixed $args = null): ErrorHelper
    {
        return new ErrorHelper($args);
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

    public static function ip(mixed $args = null): IpHelper
    {
        return new IpHelper($args);
    }

    public static function json(): JsonHelper
    {
        return new JsonHelper();
    }

    public static function jwt(mixed $args = null): JwtHelper
    {
        return new JwtHelper($args);
    }

    public static function log(mixed $args = null): LogHelper
    {
        return new LogHelper($args);
    }

    public static function lruCache(mixed $args = null): LruCacheHelper
    {
        return new LruCacheHelper($args);
    }

    public static function map(mixed $args = null): MapHelper
    {
        return new MapHelper($args);
    }

    public static function math(mixed $args = null): MathHelper
    {
        return new MathHelper($args);
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

    public static function random(mixed $args = null): RandomHelper
    {
        return new RandomHelper($args);
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

    public static function tools(mixed $args = null): ToolsHelper
    {
        return new ToolsHelper($args);
    }

    public static function validate(): \Respect\Validation\Validator
    {
        return ValidateHelper::instance();
    }

    public static function version(mixed $args = null): VersionHelper
    {
        return new VersionHelper($args);
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

    public static function dingtalk(mixed $args = null): DingtalkHelper
    {
        return new DingtalkHelper($args);
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
}