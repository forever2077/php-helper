<?php

namespace Forever2077\PhpHelper;

use Alipay\OpenAPISDK\Api\AlipayTradeApi;
use Alipay\OpenAPISDK\Configuration;
use Alipay\OpenAPISDK\HeaderSelector;
use Alipay\OpenAPISDK\Util\AlipayConfigUtil;
use Alipay\EasySDK\Kernel\Factory;
use GuzzleHttp\ClientInterface;

class AlipayHelper
{
    /**
     * @return AlipayHelper
     */
    public static function instance(): AlipayHelper
    {
        return new self();
    }

    /**
     * 支付宝 通用版v3（使用于支付、小程序等）
     * @link https://open.alipay.com/
     * @link https://github.com/alipay/alipay-sdk-php-all/blob/master/v3/README.md
     * @param ClientInterface|null $client
     * @param Configuration|null $config
     * @param HeaderSelector|null $selector
     * @param int $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     * @param AlipayConfigUtil|null $alipayConfigUtil
     * @return AlipayTradeApi
     */
    public static function v3(ClientInterface  $client = null,
                              Configuration    $config = null,
                              HeaderSelector   $selector = null,
                              int              $hostIndex = 0,
                              AlipayConfigUtil $alipayConfigUtil = null): AlipayTradeApi
    {
        return new AlipayTradeApi($client, $config, $selector, $hostIndex, $alipayConfigUtil);
    }

    /**
     * 支付宝Easy版
     * @link https://opendocs.alipay.com/common/02nlge
     * @link https://github.com/alipay/alipay-easysdk/tree/master/php
     * @param array $config
     * @return Factory
     */
    public static function easy(array $config = []): Factory
    {
        return Factory::setOptions($config);
    }
}