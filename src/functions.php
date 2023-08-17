<?php

use Carbon\Carbon;
use Forever2077\PhpHelper;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Intervention\Image\ImageManager;
use Noodlehaus\Config;
use PHPMailer\PHPMailer\PHPMailer;
use Sabre\Xml\Service;
use ZanySoft\Zip\Zip;
use ZanySoft\Zip\ZipManager;

/**
 * 支持多个参数，格式化打印数据
 * @return void
 */
if (!function_exists('dump')) {
    function dump(): void
    {
        $args = func_get_args();
        foreach ($args as $val) {
            if ('cli' !== php_sapi_name()) {
                echo '<pre style="font-size: 14px;">';
            }
            print_r($val);
            if ('cli' !== php_sapi_name()) {
                echo '</pre>';
            } else {
                echo PHP_EOL;
            }
        }
    }
}

/**
 * 支持多个参数，格式化打印数据 下断点
 * @return void
 */
if (!function_exists('dd')) {
    function dd(): void
    {
        call_user_func_array(__NAMESPACE__ . '\\dump', func_get_args());
        exit;
    }
}

function _algorithm(): PhpHelper\AlgorithmHelper
{
    return PhpHelper\AlgorithmHelper::instance();
}

function _array(mixed $args = null): PhpHelper\ArrayHelper
{
    return new PhpHelper\ArrayHelper($args);
}

function _bloom(mixed $args = null): PhpHelper\BloomHelper
{
    return new PhpHelper\BloomHelper($args);
}

function _cache(mixed $args = null): PhpHelper\CacheHelper
{
    return new PhpHelper\CacheHelper($args);
}

function _captcha(mixed $args = null): PhpHelper\CaptchaHelper
{
    return new PhpHelper\CaptchaHelper($args);
}

function _crypto(): PhpHelper\CryptoHelper
{
    return PhpHelper\CryptoHelper::instance();
}

function _csv(): PhpHelper\CsvHelper
{
    return PhpHelper\CsvHelper::instance();
}

function _dataStruct(mixed $args = null): PhpHelper\DataStructHelper
{
    return new PhpHelper\DataStructHelper($args);
}

function _dateTime(mixed $args = null): Carbon
{
    return PhpHelper\DateTimeHelper::instance($args);
}

function _dfa(mixed $args = null): PhpHelper\DfaHelper
{
    return new PhpHelper\DfaHelper($args);
}

function _email(mixed $args = null): PHPMailer
{
    return PhpHelper\EmailHelper::instance($args);
}

function _error(mixed $args = null): PhpHelper\ErrorHelper
{
    return new PhpHelper\ErrorHelper($args);
}

function _File(mixed $args = null): PhpHelper\FileHelper
{
    return new PhpHelper\FileHelper($args);
}

function _geo(mixed $args = null): PhpHelper\GeoHelper
{
    return new PhpHelper\GeoHelper($args);
}

function _http(array $args = []): Client
{
    return PhpHelper\HttpHelper::instance($args);
}

function _image(array $args = []): ImageManager
{
    return PhpHelper\ImageHelper::instance($args);
}

function _ip(mixed $args = null): PhpHelper\IpHelper
{
    return new PhpHelper\IpHelper($args);
}

function _json(): PhpHelper\JsonHelper
{
    return new PhpHelper\JsonHelper();
}

function _jwt(mixed $args = null): PhpHelper\JwtHelper
{
    return new PhpHelper\JwtHelper($args);
}

function _log(mixed $args = null): PhpHelper\LogHelper
{
    return new PhpHelper\LogHelper($args);
}

function _lruCache(mixed $args = null): PhpHelper\LruCacheHelper
{
    return new PhpHelper\LruCacheHelper($args);
}

function _map(mixed $args = null): PhpHelper\MapHelper
{
    return new PhpHelper\MapHelper($args);
}

function _math(mixed $args = null): PhpHelper\MathHelper
{
    return new PhpHelper\MathHelper($args);
}

function _net(mixed $args = null): PhpHelper\NetHelper
{
    return new PhpHelper\NetHelper($args);
}

function _office(): PhpHelper\OfficeHelper
{
    return new PhpHelper\OfficeHelper();
}

function _pay(mixed $args = null): PhpHelper\PayHelper
{
    return new PhpHelper\PayHelper($args);
}

function _random(mixed $args = null): PhpHelper\RandomHelper
{
    return new PhpHelper\RandomHelper($args);
}

function _runtime(): PhpHelper\RuntimeHelper
{
    return PhpHelper\RuntimeHelper::instance();
}

function _sms(mixed $args = null): PhpHelper\SmsHelper
{
    return new PhpHelper\SmsHelper($args);
}

function _str(): PhpHelper\StrHelper
{
    return new PhpHelper\StrHelper();
}

function _system(mixed $args = null): PhpHelper\SystemHelper
{
    return new PhpHelper\SystemHelper($args);
}

function _tools(mixed $args = null): PhpHelper\ToolsHelper
{
    return new PhpHelper\ToolsHelper($args);
}

function _validate(): PhpHelper\ValidateHelper
{
    return new PhpHelper\ValidateHelper();
}

function _version(mixed $args = null): PhpHelper\VersionHelper
{
    return new PhpHelper\VersionHelper($args);
}

function _xml(): Service
{
    return PhpHelper\XmlHelper::instance();
}

function _zip(bool $manager = false): Zip|ZipManager
{
    return PhpHelper\ZipHelper::instance($manager);
}

function _aliyun(): PhpHelper\AliyunHelper
{
    return PhpHelper\AliyunHelper::instance();
}

function _wechat(): PhpHelper\WechatHelper
{
    return PhpHelper\WechatHelper::instance();
}

function _dingtalk(mixed $args = null): PhpHelper\DingtalkHelper
{
    return new PhpHelper\DingtalkHelper($args);
}

function _baidu(mixed $args = null): PhpHelper\BaiduHelper
{
    return new PhpHelper\BaiduHelper($args);
}

function _config(array|string $values, string $parser = 'Json'): Config
{
    return PhpHelper\ConfigHelper::instance($values, $parser);
}

function _env(string $filePath, string $filename = ''): PhpHelper\EnvHelper
{
    return PhpHelper\EnvHelper::instance($filePath, $filename);
}

function _uuid(): PhpHelper\UuidHelper
{
    return PhpHelper\UuidHelper::instance();
}

function _uri(string $args = ''): Uri
{
    return PhpHelper\UriHelper::instance($args);
}

function _alipay(): PhpHelper\AlipayHelper
{
    return PhpHelper\AlipayHelper::instance();
}

function _tencentCloud(): PhpHelper\TencentCloudHelper
{
    return PhpHelper\TencentCloudHelper::instance();
}
