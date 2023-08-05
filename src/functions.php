<?php

namespace Forever2077\PhpHelper;

/**
 * 快速实例化
 * @param string $name 类名(不分大小写) 可选的值有:
 * Algorithm [算法]、Array [数组处理]、
 * Bloom [布隆过滤器]、Cache [缓存]、
 * Captcha [验证码]、Crypto [加密解密与常用编码]、
 * Csv [CSV文件处理]、DataStructure [数据结构]、
 * DateTime [日期和时间]、Dfa [DFA字符串匹配算法]、
 * Email [邮件发送和验证]、Error [错误处理]、
 * File [文件操作]、Geo [地理国家省市]、
 * Http [HTTP]、Image [图片处理]、
 * Ip [IP地址]、Json [JSON相]、Jwt [JSON Web令牌(JWT)]、
 * Log [日志相关]、LruCache [LRU缓存]、
 * Map [地图相关]、Math [数学函数]、
 * Net [网络相关]、Office [Office文档处理]、
 * Pay [支付相关]、Random [随机字符串生成]、
 * Runtime [运行时和性能测量]、Sms [短信相关]、
 * Str [字符串操作]、System [系统相关]、Tools [其他工具]、
 * Validate [内容验证]、Version [版本比较和处理]、
 * Xml [XML解析和生成]、Zip [处理ZIP压缩文件]
 * @param mixed|null $arguments 参数
 * @return mixed
 * @throws \Exception
 */
function Q(string $name, mixed $arguments = null)
{
    $namespace = (new \ReflectionClass(__NAMESPACE__ . '\PhpHelper'))->getNamespaceName();
    $class = ucfirst($name) . 'Helper';
    $fullClassName = $namespace . '\\' . $class;
    try {
        return new $fullClassName($arguments);
    } catch (\Error $e) {
        throw new \Exception("Class $fullClassName does not exist");
    }
}

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
