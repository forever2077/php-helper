<?php

namespace Forever2077\PhpHelper;

class IpHelper
{
    /**
     * 获取客户的真实ip
     * @param bool $useProxy 是否使用代理的ip (有代理的情况下)
     * @return string
     */
    public static function remoteIp(bool $useProxy = false): string
    {
        return \Jsyqw\Utils\IpHelper::remoteIp($useProxy);
    }

    /**
     * 生成随机中国IP
     * @return string
     */
    public static function randChineseIp(): string
    {
        return \Jsyqw\Utils\IpHelper::randIp();
    }
}