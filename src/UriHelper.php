<?php

namespace Forever2077\PhpHelper;

use GuzzleHttp\Psr7\Uri;

class UriHelper
{
    /**
     * 默认实例
     * @param string $url
     * @return Uri
     */
    public static function instance(string $url = ''): Uri
    {
        return self::uri($url);
    }

    /**
     * Uri实例
     * @param string $url
     * @return Uri
     */
    public static function uri(string $url = ''): Uri
    {
        return new Uri($url);
    }
}