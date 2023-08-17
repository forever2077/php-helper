<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\AlipayHelper;
use Alipay\OpenAPISDK\Api\AlipayTradeApi;
use Alipay\EasySDK\Kernel\Factory;
use Alipay\EasySDK\Kernel\Payment;

class AlipayHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(AlipayHelper::class, Helper::alipay()::class);
    }

    public function testV3()
    {
        $this->assertInstanceOf(AlipayTradeApi::class, AlipayHelper::v3());
    }

    public function testEasy()
    {
        $this->assertEquals(Factory::class, AlipayHelper::easy()::class);
    }

    public function testEasyPayment()
    {
        try {
            $result = AlipayHelper::easy()::payment();
            $this->assertEquals(Payment::class, $result::class);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}