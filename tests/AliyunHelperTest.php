<?php

use Forever2077\PhpHelper\EnvHelper;
use Forever2077\PhpHelper\AliyunHelper;
use OSS\OssClient;
use PHPUnit\Framework\TestCase;
use AlibabaCloud\Client\AlibabaCloud;

class AliyunHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(AliyunHelper::class, AliyunHelper::instance());
    }

    public function testOpenapi()
    {
        $this->assertInstanceOf(AlibabaCloud::class, AliyunHelper::openapi());
    }

    public function testOss()
    {
        $env = EnvHelper::instance(dirname(__DIR__));
        $this->assertInstanceOf(OssClient::class, AliyunHelper::oss(
            $env->get('OSS_ACCESSKEYID'),
            $env->get('OSS_ACCESSKEYSECRET'),
            $env->get('OSS_ENDPOINT')
        ));
    }

    public function testAliyun()
    {
        $this->assertInstanceOf(AliyunHelper::class, _aliyun());
    }
}