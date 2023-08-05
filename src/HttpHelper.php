<?php

namespace Forever2077\PhpHelper;

use GuzzleHttp\Client;

class HttpHelper
{
    /**
     * HTTP辅助类
     * @param array $config 配置
     * @return Client
     */
    public static function instance(array $config = []): Client
    {
        return self::guzzle($config);
    }

    /**
     * Guzzle实例
     * @param array $config 配置
     * @return Client
     */
    public static function guzzle(array $config = []): Client
    {
        return new Client($config);
    }
}
