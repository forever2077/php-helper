<?php

use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;
use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\SmsHelper;

class SmsHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals('Overtrue\EasySms\EasySms', SmsHelper::instance([])::class);
    }

    public function testEasySms()
    {
        $this->assertEquals('Overtrue\EasySms\EasySms', SmsHelper::easySms([])::class);
    }

    public function testPhoneNumber()
    {
        $this->assertEquals('+8613500000001', SmsHelper::phoneNumber('13500000001', '86')->getUniversalNumber());
    }

    public function testSend()
    {
        $config = [
            'timeout' => 5.0,
            'default' => [
                'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,
                'gateways' => [
                    'yunpian', 'aliyun',
                ],
            ],
            'gateways' => [
                'errorlog' => [
                    'file' => '/tmp/easy-sms.log',
                ],
                'yunpian' => [
                    'api_key' => '824f0ff2f71cab52936axxxxxxxxxx',
                ],
                'aliyun' => [
                    'access_key_id' => '',
                    'access_key_secret' => '',
                    'sign_name' => '',
                ],
            ],
        ];

        try {
            SmsHelper::instance($config)->send('13500000001', [
                'content' => '您的验证码为: 6379',
                'template' => 'SMS_001',
                'data' => [
                    'code' => 6379
                ]
            ]);
        } catch (\Overtrue\EasySms\Exceptions\InvalidArgumentException|NoGatewayAvailableException $e) {
            $this->assertIsString($e->getMessage());
        }
    }
}