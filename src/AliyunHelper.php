<?php

namespace Forever2077\PhpHelper;

use AlibabaCloud\Client\AlibabaCloud;
use OSS\OssClient;

class AliyunHelper
{
    /**
     * @return AliyunHelper
     */
    public static function instance(): AliyunHelper
    {
        return new self();
    }

    /**
     * 阿里云开放API
     * @link https://next.api.aliyun.com/
     * @link https://github.com/aliyun/openapi-sdk-php
     * @return AlibabaCloud
     */
    public static function openapi(): AlibabaCloud
    {
        return new AlibabaCloud();
    }

    /**
     * 阿里云对象存储服务
     * @link https://help.aliyun.com/zh/oss/developer-reference/php-1/
     * @link https://github.com/aliyun/aliyun-oss-php-sdk
     * @link 访问域名和数据中心 https://help.aliyun.com/zh/oss/user-guide/regions-and-endpoints
     * @param $accessKeyId
     * @param $accessKeySecret
     * @param $endpoint
     * @param bool $isCName
     * @param $securityToken
     * @param $requestProxy
     * @return OssClient
     */
    public static function oss($accessKeyId, $accessKeySecret, $endpoint, bool $isCName = false, $securityToken = NULL, $requestProxy = NULL): OssClient
    {
        return new OssClient($accessKeyId, $accessKeySecret, $endpoint, $isCName, $securityToken, $requestProxy);
    }
}