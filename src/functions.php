<?php

namespace Forever2077\PhpHelper;

/**
 * 支持多个参数，格式化打印数据
 * @return void
 */
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

/**
 * 支持多个参数，格式化打印数据 下断点
 * @return void
 */
function dd(): void
{
    call_user_func_array(__NAMESPACE__ . '\\dump', func_get_args());
    exit;
}

/**
 * @param mixed|null $args
 * @return AlgorithmHelper
 */
function AlgorithmHelper(mixed $args = null): AlgorithmHelper
{
    return new AlgorithmHelper($args);
}

/**
 * @param mixed|null $args
 * @return ArrayHelper
 */
function ArrayHelper(mixed $args = null): ArrayHelper
{
    return new ArrayHelper($args);
}

/**
 * @param mixed|null $args
 * @return BloomHelper
 */
function BloomHelper(mixed $args = null): BloomHelper
{
    return new BloomHelper($args);
}

/**
 * @param mixed|null $args
 * @return CacheHelper
 */
function CacheHelper(mixed $args = null): CacheHelper
{
    return new CacheHelper($args);
}

/**
 * @param mixed|null $args
 * @return CaptchaHelper
 */
function CaptchaHelper(mixed $args = null): CaptchaHelper
{
    return new CaptchaHelper($args);
}

/**
 * @param mixed|null $args
 * @return CryptoHelper
 */
function CryptoHelper(mixed $args = null): CryptoHelper
{
    return new CryptoHelper($args);
}

/**
 * @param mixed|null $args
 * @return CsvHelper
 */
function CsvHelper(mixed $args = null): CsvHelper
{
    return new CsvHelper($args);
}

/**
 * @param mixed|null $args
 * @return DataStructureHelper
 */
function DataStructureHelper(mixed $args = null): DataStructureHelper
{
    return new DataStructureHelper($args);
}

/**
 * @param mixed|null $args
 * @return DateTimeHelper
 */
function DateTimeHelper(mixed $args = null): DateTimeHelper
{
    return new DateTimeHelper($args);
}

/**
 * @param mixed|null $args
 * @return DfaHelper
 */
function DfaHelper(mixed $args = null): DfaHelper
{
    return new DfaHelper($args);
}

/**
 * @param mixed|null $args
 * @return EmailHelper
 */
function EmailHelper(mixed $args = null): EmailHelper
{
    return new EmailHelper($args);
}

/**
 * @param mixed|null $args
 * @return ErrorHelper
 */
function ErrorHelper(mixed $args = null): ErrorHelper
{
    return new ErrorHelper($args);
}

/**
 * @param mixed|null $args
 * @return FileHelper
 */
function FileHelper(mixed $args = null): FileHelper
{
    return new FileHelper($args);
}

/**
 * @param mixed|null $args
 * @return GeoHelper
 */
function GeoHelper(mixed $args = null): GeoHelper
{
    return new GeoHelper($args);
}

/**
 * @param mixed|null $args
 * @return HttpHelper
 */
function HttpHelper(mixed $args = null): HttpHelper
{
    return new HttpHelper($args);
}

/**
 * @param mixed|null $args
 * @return ImageHelper
 */
function ImageHelper(mixed $args = null): ImageHelper
{
    return new ImageHelper($args);
}

/**
 * @param mixed|null $args
 * @return IpHelper
 */
function IpHelper(mixed $args = null): IpHelper
{
    return new IpHelper($args);
}

/**
 * @param mixed|null $args
 * @return JsonHelper
 */
function JsonHelper(mixed $args = null): JsonHelper
{
    return new JsonHelper($args);
}

/**
 * @param mixed|null $args
 * @return JwtHelper
 */
function JwtHelper(mixed $args = null): JwtHelper
{
    return new JwtHelper($args);
}

/**
 * @param mixed|null $args
 * @return LogHelper
 */
function LogHelper(mixed $args = null): LogHelper
{
    return new LogHelper($args);
}

/**
 * @param mixed|null $args
 * @return LruCacheHelper
 */
function LruCacheHelper(mixed $args = null): LruCacheHelper
{
    return new LruCacheHelper($args);
}

/**
 * @param mixed|null $args
 * @return MapHelper
 */
function MapHelper(mixed $args = null): MapHelper
{
    return new MapHelper($args);
}

/**
 * @param mixed|null $args
 * @return MathHelper
 */
function MathHelper(mixed $args = null): MathHelper
{
    return new MathHelper($args);
}

/**
 * @param mixed|null $args
 * @return NetHelper
 */
function NetHelper(mixed $args = null): NetHelper
{
    return new NetHelper($args);
}

/**
 * @param mixed|null $args
 * @return OfficeHelper
 */
function OfficeHelper(mixed $args = null): OfficeHelper
{
    return new OfficeHelper($args);
}

/**
 * @param mixed|null $args
 * @return PayHelper
 */
function PayHelper(mixed $args = null): PayHelper
{
    return new PayHelper($args);
}

/**
 * @param mixed|null $args
 * @return RandomHelper
 */
function RandomHelper(mixed $args = null): RandomHelper
{
    return new RandomHelper($args);
}

/**
 * @param mixed|null $args
 * @return RuntimeHelper
 */
function RuntimeHelper(mixed $args = null): RuntimeHelper
{
    return new RuntimeHelper($args);
}

/**
 * @param mixed|null $args
 * @return SmsHelper
 */
function SmsHelper(mixed $args = null): SmsHelper
{
    return new SmsHelper($args);
}

/**
 * @param mixed|null $args
 * @return StrHelper
 */
function StrHelper(mixed $args = null): StrHelper
{
    return new StrHelper($args);
}

/**
 * @param mixed|null $args
 * @return SystemHelper
 */
function SystemHelper(mixed $args = null): SystemHelper
{
    return new SystemHelper($args);
}

/**
 * @param mixed|null $args
 * @return ToolsHelper
 */
function ToolsHelper(mixed $args = null): ToolsHelper
{
    return new ToolsHelper($args);
}

/**
 * @param mixed|null $args
 * @return ValidateHelper
 */
function ValidateHelper(mixed $args = null): ValidateHelper
{
    return new ValidateHelper($args);
}

/**
 * @param mixed|null $args
 * @return VersionHelper
 */
function VersionHelper(mixed $args = null): VersionHelper
{
    return new VersionHelper($args);
}

/**
 * @param mixed|null $args
 * @return XmlHelper
 */
function XmlHelper(mixed $args = null): XmlHelper
{
    return new XmlHelper($args);
}

/**
 * @param mixed|null $args
 * @return ZipHelper
 */
function ZipHelper(mixed $args = null): ZipHelper
{
    return new ZipHelper($args);
}

/**
 * @param mixed|null $args
 * @return AliyunHelper
 */
function AliyunHelper(mixed $args = null): AliyunHelper
{
    return new AliyunHelper($args);
}

/**
 * @param mixed|null $args
 * @return WechatHelper
 */
function WechatHelper(mixed $args = null): WechatHelper
{
    return new WechatHelper($args);
}

/**
 * @param mixed|null $args
 * @return DingtalkHelper
 */
function DingtalkHelper(mixed $args = null): DingtalkHelper
{
    return new DingtalkHelper($args);
}

/**
 * @param mixed|null $args
 * @return BaiduHelper
 */
function BaiduHelper(mixed $args = null): BaiduHelper
{
    return new BaiduHelper($args);
}
