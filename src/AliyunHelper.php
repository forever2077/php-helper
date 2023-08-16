<?php

namespace Forever2077\PhpHelper;

use AlibabaCloud\Client\SDK;
use AlibabaCloud\IdeHelper;
use AlibabaCloud\Client\Traits\LogTrait;
use AlibabaCloud\Client\Traits\MockTrait;
use AlibabaCloud\Client\Traits\ClientTrait;
use AlibabaCloud\Client\Traits\HistoryTrait;
use AlibabaCloud\Client\Traits\RequestTrait;
use AlibabaCloud\Client\Traits\EndpointTrait;
use AlibabaCloud\Client\Traits\DefaultRegionTrait;
use AlibabaCloud\Client\Exception\ClientException;
use OSS\OssClient;

/**
 * @mixin IdeHelper
 */
class AliyunHelper
{
    use ClientTrait;
    use DefaultRegionTrait;
    use EndpointTrait;
    use RequestTrait;
    use MockTrait;
    use HistoryTrait;
    use LogTrait;

    /**
     * @return AliyunHelper
     */
    public static function instance(): AliyunHelper
    {
        return new self();
    }

    /**
     * 阿里云开放API
     * @link https://github.com/aliyun/openapi-sdk-php-client/blob/master/docs/zh-CN/3-Request.md
     * @link https://github.com/aliyun/openapi-sdk-php
     * @link https://next.api.aliyun.com/
     * @param $product
     * @param $arguments
     * @return mixed
     * @throws ClientException
     */
    public static function __callStatic($product, $arguments)
    {
        $product = \ucfirst($product);

        $product_class = 'AlibabaCloud' . '\\' . $product . '\\' . $product;

        if (\class_exists($product_class)) {
            return new $product_class;
        }

        throw new ClientException(
            "May not yet support product $product quick access, "
            . 'you can use [Alibaba Cloud Client for PHP] to send any custom '
            . 'requests: https://github.com/aliyun/openapi-sdk-php-client/blob/master/docs/en-US/3-Request.md',
            SDK::SERVICE_NOT_FOUND
        );
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