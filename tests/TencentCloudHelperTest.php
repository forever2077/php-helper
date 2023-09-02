<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\EnvHelper;
use Forever2077\PhpHelper\TencentCloudHelper;
use TencentCloud\Common\Credential;
use TencentCloud\Common\Exception\TencentCloudSDKException;
use TencentCloud\Common\Profile\ClientProfile;
use TencentCloud\Common\Profile\HttpProfile;

class TencentCloudHelperTest extends TestCase
{
    private function testInstance()
    {
        $this->assertInstanceOf(TencentCloudHelper::class, TencentCloudHelper::instance());
    }

    private function testClient()
    {
        $env = EnvHelper::instance(dirname(__DIR__));
        $cred = new Credential(
            $env->get('TENCENTCLOUD_SECRET_ID'),
            $env->get('TENCENTCLOUD_SECRET_KEY')
        );
        $HttpProfile = new HttpProfile();
        $HttpProfile->setProtocol('http://');
        $HttpProfile->setReqTimeout(1);
        $ClientProfile = new ClientProfile('TC3-HMAC-SHA256', $HttpProfile);
        $client = TencentCloudHelper::client("cvm", "2017-03-12", $cred, "ap-guangzhou", $ClientProfile);
        $headers = array();
        $body = [
            "Filters" => [
                [
                    "Name" => "zone",
                    "Values" => ["ap-guangzhou-1", "ap-guangzhou-2"]
                ]
            ]
        ];
        try {
            $resp = $client->callJson(
                "DescribeInstances",
                json_encode($body),
                $headers,
            );
        } catch (TencentCloudSDKException $e) {
            $this->assertIsString($e->getMessage());
        }
    }

    private function testCos()
    {
        $env = EnvHelper::instance(dirname(__DIR__));
        $cosConfig = [
            'region' => $env->get('COS_REGION'),
            'credentials' => [
                'secretId' => $env->get('COS_SECRET_ID'),
                'secretKey' => $env->get('COS_SECRET_KEY'),
                //'token' => $env->get('COS_SECURITY_TOKEN'),//临时密钥
            ],
        ];
        try {
            $cosClient = TencentCloudHelper::cos($cosConfig);
            $result = $cosClient->listBuckets();
            $this->assertIsArray($result);
        } catch (Exception $e) {
            $this->assertIsString($e->getMessage());
        }
    }

    private function testTencentCloud()
    {
        $this->assertInstanceOf(TencentCloudHelper::class, Helper::tencentCloud());
    }
}