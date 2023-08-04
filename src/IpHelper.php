<?php

namespace Forever2077\PhpHelper;

class IpHelper
{
    /**
     * 获取客户端真实IP
     * @param bool $useProxy 是否使用代理的ip (有代理的情况下)
     * @return string
     */
    public static function remoteIp(bool $useProxy = false): string
    {
        return \Jsyqw\Utils\IpHelper::remoteIp($useProxy);
    }

    /**
     * 生成随机中国IP（爬虫伪造ip）
     * @return string
     */
    public static function randChineseIp(): string
    {
        return \Jsyqw\Utils\IpHelper::randIp();
    }
}