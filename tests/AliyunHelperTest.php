<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\EnvHelper;
use Forever2077\PhpHelper\AliyunHelper;
use AlibabaCloud\Client\Exception\ClientException;
use OSS\OssClient;

class AliyunHelperTest extends TestCase
{
    public function testAliyun()
    {
        $this->assertEquals(AliyunHelper::class, Helper::aliyun()::class);
    }

    private function testOpenapi()
    {
        try {
            AliyunHelper::accessKeyClient('foo', 'bar')
                ->regionId('cn-hangzhou')
                ->asDefaultClient();
            $this->assertEquals('AlibabaCloud\Ecs\V20140526\EcsApiResolver', AliyunHelper::ecs()::v20140526()::class);
        } catch (ClientException $e) {
            $this->fail($e->getErrorMessage());
        }
    }

    private function testOss()
    {
        $env = EnvHelper::instance(dirname(__DIR__));
        $this->assertInstanceOf(OssClient::class, AliyunHelper::oss(
            $env->get('OSS_ACCESSKEYID'),
            $env->get('OSS_ACCESSKEYSECRET'),
            $env->get('OSS_ENDPOINT')
        ));
    }
}