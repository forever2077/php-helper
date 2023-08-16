<?php

namespace Forever2077\PhpHelper;

use TencentCloud\Common\CommonClient;
use TencentCloud\Common\Credential;
use TencentCloud\Common\Profile\ClientProfile;
use Qcloud\Cos\Client;

class TencentCloudHelper
{
    /**
     * @return TencentCloudHelper
     */
    public static function instance(): TencentCloudHelper
    {
        return new self();
    }

    /**
     * 腾讯云开放API(Common Client)
     * @link https://cloud.tencent.com/api/list
     * @link https://github.com/TencentCloud/tencentcloud-sdk-php
     * @param string $service
     * @param string $version
     * @param Credential $credential
     * @param string $region
     * @param ClientProfile|null $profile
     * @return CommonClient
     */
    public static function client(
        string        $service,
        string        $version,
        Credential    $credential,
        string        $region,
        ClientProfile $profile = null): CommonClient
    {
        return new CommonClient($service, $version, $credential, $region, $profile);
    }

    /**
     * 腾讯云对象存储服务
     * @link https://github.com/tencentyun/cos-php-sdk-v5
     * @param array $cosConfig
     * @return Client
     */
    public static function cos(array $cosConfig): Client
    {
        return new Client($cosConfig);
    }
}
