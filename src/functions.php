<?php

use Forever2077\PhpHelper;

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

/**
 * @param mixed|null $args
 * @return PhpHelper\AlgorithmHelper
 */
function _algorithm(mixed $args = null): PhpHelper\AlgorithmHelper
{
    return new PhpHelper\AlgorithmHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\ArrayHelper
 */
function _array(mixed $args = null): PhpHelper\ArrayHelper
{
    return new PhpHelper\ArrayHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\BloomHelper
 */
function _bloom(mixed $args = null): PhpHelper\BloomHelper
{
    return new PhpHelper\BloomHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\CacheHelper
 */
function _cache(mixed $args = null): PhpHelper\CacheHelper
{
    return new PhpHelper\CacheHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\CaptchaHelper
 */
function _captcha(mixed $args = null): PhpHelper\CaptchaHelper
{
    return new PhpHelper\CaptchaHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\CryptoHelper
 */
function _crypto(mixed $args = null): PhpHelper\CryptoHelper
{
    return new PhpHelper\CryptoHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\CsvHelper
 */
function _csv(mixed $args = null): PhpHelper\CsvHelper
{
    return new PhpHelper\CsvHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\DataStructureHelper
 */
function _dataStructure(mixed $args = null): PhpHelper\DataStructureHelper
{
    return new PhpHelper\DataStructureHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\DateTimeHelper
 */
function _dateTime(mixed $args = null): PhpHelper\DateTimeHelper
{
    return new PhpHelper\DateTimeHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\DfaHelper
 */
function _dfa(mixed $args = null): PhpHelper\DfaHelper
{
    return new PhpHelper\DfaHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\EmailHelper
 */
function _email(mixed $args = null): PhpHelper\EmailHelper
{
    return new PhpHelper\EmailHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\ErrorHelper
 */
function _error(mixed $args = null): PhpHelper\ErrorHelper
{
    return new PhpHelper\ErrorHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\FileHelper
 */
function _File(mixed $args = null): PhpHelper\FileHelper
{
    return new PhpHelper\FileHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\GeoHelper
 */
function _geo(mixed $args = null): PhpHelper\GeoHelper
{
    return new PhpHelper\GeoHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\HttpHelper
 */
function _http(mixed $args = null): PhpHelper\HttpHelper
{
    return new PhpHelper\HttpHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\ImageHelper
 */
function _image(mixed $args = null): PhpHelper\ImageHelper
{
    return new PhpHelper\ImageHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\IpHelper
 */
function _ip(mixed $args = null): PhpHelper\IpHelper
{
    return new PhpHelper\IpHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\JsonHelper
 */
function _json(mixed $args = null): PhpHelper\JsonHelper
{
    return new PhpHelper\JsonHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\JwtHelper
 */
function _jwt(mixed $args = null): PhpHelper\JwtHelper
{
    return new PhpHelper\JwtHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\LogHelper
 */
function _log(mixed $args = null): PhpHelper\LogHelper
{
    return new PhpHelper\LogHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\LruCacheHelper
 */
function _lruCache(mixed $args = null): PhpHelper\LruCacheHelper
{
    return new PhpHelper\LruCacheHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\MapHelper
 */
function _map(mixed $args = null): PhpHelper\MapHelper
{
    return new PhpHelper\MapHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\MathHelper
 */
function _math(mixed $args = null): PhpHelper\MathHelper
{
    return new PhpHelper\MathHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\NetHelper
 */
function _net(mixed $args = null): PhpHelper\NetHelper
{
    return new PhpHelper\NetHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\OfficeHelper
 */
function _office(mixed $args = null): PhpHelper\OfficeHelper
{
    return new PhpHelper\OfficeHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\PayHelper
 */
function _pay(mixed $args = null): PhpHelper\PayHelper
{
    return new PhpHelper\PayHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\RandomHelper
 */
function _random(mixed $args = null): PhpHelper\RandomHelper
{
    return new PhpHelper\RandomHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\RuntimeHelper
 */
function _runtime(mixed $args = null): PhpHelper\RuntimeHelper
{
    return new PhpHelper\RuntimeHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\SmsHelper
 */
function _sms(mixed $args = null): PhpHelper\SmsHelper
{
    return new PhpHelper\SmsHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\StrHelper
 */
function _str(mixed $args = null): PhpHelper\StrHelper
{
    return new PhpHelper\StrHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\SystemHelper
 */
function _system(mixed $args = null): PhpHelper\SystemHelper
{
    return new PhpHelper\SystemHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\ToolsHelper
 */
function _tools(mixed $args = null): PhpHelper\ToolsHelper
{
    return new PhpHelper\ToolsHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\ValidateHelper
 */
function _validate(mixed $args = null): PhpHelper\ValidateHelper
{
    return new PhpHelper\ValidateHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\VersionHelper
 */
function _version(mixed $args = null): PhpHelper\VersionHelper
{
    return new PhpHelper\VersionHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\XmlHelper
 */
function _xml(mixed $args = null): PhpHelper\XmlHelper
{
    return new PhpHelper\XmlHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\ZipHelper
 */
function _zip(mixed $args = null): PhpHelper\ZipHelper
{
    return new PhpHelper\ZipHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\AliyunHelper
 */
function _aliyun(mixed $args = null): PhpHelper\AliyunHelper
{
    return new PhpHelper\AliyunHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\WechatHelper
 */
function _wechat(mixed $args = null): PhpHelper\WechatHelper
{
    return new PhpHelper\WechatHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\DingtalkHelper
 */
function _dingtalk(mixed $args = null): PhpHelper\DingtalkHelper
{
    return new PhpHelper\DingtalkHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\BaiduHelper
 */
function _baidu(mixed $args = null): PhpHelper\BaiduHelper
{
    return new PhpHelper\BaiduHelper($args);
}

/**
 * @param mixed|null $args
 * @return PhpHelper\ConfigHelper
 */
function _config(mixed $args = null): PhpHelper\ConfigHelper
{
    return new PhpHelper\ConfigHelper($args);
}